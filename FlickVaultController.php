<?php

class FlickVaultController {

    // File paths for docker and server deployments
    private $filePath = "/opt/src"; // dev
    // private $filePath = "/students/vgn2bh/students/vgn2bh/private"; // server Alec
    // private $filePath = "/students/ttk4ey/students/ttk4ey/private"; // server Ethan

    private $db;
    private $input;

    // An error message to display on the welcome page
    private $errorMessage = "";

    /**
     * Constructor
     */
    public function __construct($input) {
        // We should always start (or join) a session at the top
        // of execution of PHP -- the constructor is the best place
        // to do that.
        session_start();

        // Connect to the database by instantiating a
        // Database object (provided by CS4640).  You have a copy
        // in the src/example directory, but it will be below as well.
        $this->db = new Database();

        // Set input
        $this->input = $input;

        // Loading questions no longer necessary, as they are
        // in the database
        //$this->loadQuestions();
    }

    /**
     * Run the server
     * 
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {

        $command = "home";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        if (isset($this->input["movieId"]))
            $movieId = $this->input["movieId"];

        if (!isset($_SESSION["email"]) && $command !== "login") {
            $command = "";
        }

        switch ($command) {
            case "details":
                $this->getMovie($movieId);
                $this->showDetails();
                break;
            case "history":
                $this->getHistory();
                $this->showHistory();
                break;
            case "home":
                $this->showHome();
                break;
            case "login":
                $this->loginDatabase();
                break;
            case "search":
                $this->searchMovies();
                $this->showSearch();
                break;
            case "watchlist":
                $this->getWatchlist();
                $this->showWatchlist();
                break;
            case "addToWatchlist":
                $this->addToWatchlist($this->input["movieId"], $this->input["movieTitle"], $this->input["movieLength"], $this->input["moviePoster"]);
                header("Location: ?command=watchlist");
                break;
            case "addToHistory":
                $this->addToHistory($this->input["movieId"], $this->input["movieTitle"], $this->input["movieLength"], $this->input["moviePoster"]);
                header("Location: ?command=history");
                break;
            case "removeFromWatchlist":
                $this->removeFromWatchlist($this->input['movieId']);
                header("Location: ?command=watchlist");
                break;
            case "removeFromHistory":
                $this->removeFromHistory($this->input['movieId']);
                header("Location: ?command=history");
                break;
            case "moveToWatchlist":
                $this->addToWatchlist($this->input["movieId"], $this->input["movieTitle"], $this->input["movieLength"], $this->input["moviePoster"]);
                $this->removeFromHistory($this->input['movieId']);
                header("Location: ?command=watchlist");
                break;
            case "moveToHistory":
                $this->addToHistory($this->input["movieId"], $this->input["movieTitle"], $this->input["movieLength"], $this->input["moviePoster"]);
                $this->removeFromWatchlist($this->input['movieId']);
                header("Location: ?command=history");
                break;
            case "getUser":
                $this->getUserData();
                break;
            case "logout":
                $this->logout();
                // no break; logout will also show the login page.
            default:
                $this->showLogin();
                break;
        }
    }

    /**
     * Alternate Login Function
     *
     * **NEW**: we can replace the function above with this function which
     * will check the user's credentials against their information in the
     * database's users table to see if their password is correct.
     *
     * 1) if the user is not in the table, it automatically adds them and saves
     * the 1-way hash of their password to the table (so that they can log in again later)
     * 2) if the user is in the table, then it verifies that the password they
     * provided is correct.   If so, it allows them to continue playing, reading their
     * score out of the database.
     *
     * NOTE: you should **not** save passwords in clear text -- only the hashed passwords
     * are stored in the database.
     */
    public function loginDatabase() {
        // User must provide a non-empty email, and password to attempt a login
        if (
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["passwd"]) && !empty($_POST["passwd"])
        ) {
            // Check if user is in database, by email
            $res = $this->db->query("select * from users where email = $1;", $_POST["email"]);
            if (empty($res)) {
                // User was not there (empty result), so insert them
                $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';
                if (preg_match($passwordPattern, $_POST["passwd"])) {
                    // Insert new user into DB
                    $this->db->query(
                        "insert into users (email, password) values ($1, $2);",
                        $_POST["email"],
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT) // Use the hashed password!
                    );

                    $res = $this->db->query("select id from users where email = $1", $_POST['email']);
                    $_SESSION['userId'] = $res[0]['id'];

                    // Save email to session
                    $_SESSION["email"] = $_POST["email"];

                    // Send user to the appropriate page (home)
                    header("Location: ?command=home");

                    // figure out how to set userId to session for new user
                    // $newUser = $this->db->query("select * from users where email = $1;", $_POST["email"]);
                    // $_SESSION['userId'] = $newUser['id'];
                    return;
                } else {
                    $this->errorMessage = "Password must have upper-case, lower-case, number, and special character";
                }
            } else {
                // User was in the database, verify password is correct
                // Note: Since we used a 1-way hash, we must use password_verify()
                // to check that the passwords match.
                if (password_verify($_POST["passwd"], $res[0]["password"])) {
                    // Password was correct, save their information to the
                    // session and send them to the home page
                    $_SESSION["email"] = $res[0]["email"];
                    $_SESSION["userId"] = $res[0]["id"];
                    header("Location: ?command=home");
                    return;
                } else {
                    // Password was incorrect
                    $this->errorMessage = "Incorrect password.";
                }
            }
        } else {
            $this->errorMessage = "Name, email, and password are required.";
        }
        // If something went wrong, show the welcome page again
        $this->showLogin();
    }


    /**
     * Logout
     *
     * Destroys the session, essentially logging the user out.  It will then start
     * a new session so that we have $_SESSION if we need it.
     */
    public function logout() {
        session_destroy();
        session_start();
    }

    public function getWatchlist() {
        $watchlist = $this->db->query("select * from watchlist where user_id = $1", $_SESSION['userId']);
        $_SESSION['watchlist'] = $watchlist;
    }

    public function getHistory() {
        $history = $this->db->query("select * from history where user_id = $1 order by date_watched desc", $_SESSION['userId']);
        $_SESSION['history'] = $history;
    }

    public function addToWatchlist($movieId, $movieTitle, $movieLength, $moviePoster) {
        // check if in watchlist first
        $res = $this->db->query("select * from watchlist where user_id = $1 and movie_id = $2", $_SESSION['userId'], $movieId);
        if (empty($res)) {
            $res = $this->db->query("insert into watchlist (user_id, movie_id, title, length, posterpath, order_id) values ($1, $2, $3, $4, $5, $6)", $_SESSION['userId'], $movieId, $movieTitle, $movieLength, $moviePoster, count($_SESSION['watchlist']) + 1);
        }
    }

    /* */
    public function removeFromWatchlist($movieId) {
        $res = $this->db->query("select * from watchlist where user_id = $1 and movie_id = $2", $_SESSION['userId'], $movieId);

        // Shift the order_id of all movies after current up one
        $this->db->query("update watchlist set order_id = order_id - 1 where user_id = $1 and order_id > $2", $_SESSION['userId'], $res[0]['order_id']);

        $this->db->query("delete from watchlist where user_id = $1 and movie_id = $2", $_SESSION['userId'], $movieId);
    }

    public function addToHistory($movieId, $movieTitle, $movieLength, $moviePoster) {
        // check if in history first
        $res = $this->db->query("select * from history where user_id = $1 and movie_id = $2", $_SESSION['userId'], $movieId);
        if (empty($res)) {
            $res = $this->db->query("insert into history (user_id, movie_id, title, length, posterpath) values ($1, $2, $3, $4, $5)", $_SESSION['userId'], $movieId, $movieTitle, $movieLength, $moviePoster);
        }
    }

    public function removeFromHistory($movieId) {
        $res = $this->db->query("delete from history where user_id = $1 and movie_id = $2", $_SESSION['userId'], $movieId);
        // what do we do after removing
    }

    /* Helper function to convert minutes to Xh Xm format */
    public function formatMovieLength($minutes) {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;
        return $hours . 'h ' . $mins . 'm';
    }

    /* Queries TMDB API for movies based on search keywords */
    public function searchMovies() {
        $url = 'https://api.themoviedb.org/3/search/movie?query=' . urlencode($_GET['query']) . '&include_adult=true&language=en-US&sort_by=popularity.desc&page=1';

        $options = [
            'http' => [
                'header' => "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhZDMwYWE1ZmE5NjA4Y2YyMmMyMzdiMmE0ODQ1OTgwMiIsInN1YiI6IjY2MGEwZjFjNWFhZGM0MDE2MzYyNDliNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Di-tc-QndzycIwaPXsTPCAvuv1Si8GRDi7M4EtWQFlQ\r\n" .
                    "accept: application/json\r\n",
                'method' => 'GET'
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        $_SESSION['query'] = $this->input["query"];
        $_SESSION['searchResults'] = $data['results'];
    }


    /* Queries TMDB API for movie details based on the movie ID */
    public function getMovie($movieId) {
        $url = 'https://api.themoviedb.org/3/movie/' . urlencode($movieId) . '?language=en-US';

        $urlCredits = 'https://api.themoviedb.org/3/movie/' . urlencode($movieId) . '/credits?language=en-US';

        $options = [
            'http' => [
                'header' => "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhZDMwYWE1ZmE5NjA4Y2YyMmMyMzdiMmE0ODQ1OTgwMiIsInN1YiI6IjY2MGEwZjFjNWFhZGM0MDE2MzYyNDliNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Di-tc-QndzycIwaPXsTPCAvuv1Si8GRDi7M4EtWQFlQ\r\n" .
                    "accept: application/json\r\n",
                'method' => 'GET'
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $movieJSON = json_decode($response, true);

        $_SESSION['query'] = $this->input["movieId"];
        $_SESSION['movieDetails'] = $movieJSON;
        $_SESSION['movieDetails']['runtime'] = $this->formatMovieLength($_SESSION['movieDetails']['runtime']);
        $_SESSION['movieDetails']['poster_path'] = 'https://image.tmdb.org/t/p/original' . $_SESSION['movieDetails']['poster_path'];
        $_SESSION['movieDetails']['backdrop_path'] = 'https://image.tmdb.org/t/p/original' . $_SESSION['movieDetails']['poster_path'];

        $responseCredits = file_get_contents($urlCredits, false, $context);
        $creditsJSON = json_decode($responseCredits, true);

        $directors = array_map(function ($director) {
            if (isset($director['job']) && $director['job'] === "Director") {
                return $director['name'];
            }
        }, $creditsJSON['crew']);
        $_SESSION['directors'] = $directors;

        $actors = array_slice($creditsJSON['cast'], 0, 3);
        $_SESSION['actors'] = $actors;
    }

    public function getUserData() {
        // Query DB for user data
        $res = $this->db->query("select id, email from users where id = $1", $_SESSION['userId']);

        $userData = json_encode($res[0]);

        // Set the Content-Type header
        header('Content-Type: application/json');

        echo $userData;
    }

    # SHOW PAGES SECTION 

    /* Show the details page to the user. */
    public function showDetails() {
        $filePath = $this->filePath;
        include($filePath . "/flickvault/templates/details.php");
    }

    /* Show the history page to the user. */
    public function showHistory() {
        $filePath = $this->filePath;
        include($filePath . "/flickvault/templates/history.php");
    }

    /* Show the home page to the user. */
    public function showHome() {
        $filePath = $this->filePath;
        include($filePath . "/flickvault/templates/home.php");
    }

    /* Show the search page to the user. */
    public function showSearch() {
        $filePath = $this->filePath;
        include($filePath . "/flickvault/templates/search.php");
    }

    /* Show the watchlist page to the user. */
    public function showWatchlist() {
        $filePath = $this->filePath;
        include($filePath . "/flickvault/templates/watchlist.php");
    }

    /* Show the welcome page to the user. */
    public function showLogin() {
        $filePath = $this->filePath;
        // Show an optional error message if the errorMessage field is not empty.
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger col-lg-6 mx-auto mt-3'>{$this->errorMessage}</div>";
        }
        include($filePath . "/flickvault/templates/login.php");
    }
}
