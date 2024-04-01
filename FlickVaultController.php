<?php

class FlickVaultController {

    private $questions = [];


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

        if (!isset($_SESSION["email"])) {
            $command = "login";
        }

        switch ($command) {
            case "details":
                $this->getMovie($movieId);
                $this->showDetails();
                break;
            case "history":
                $this->showHistory();
                break;
            case "home":
                $this->showHome();
                break;
            case "login":
                $this->loginDatabase();
                break;
            case "search":
                $this->searchMovies($this->input["query"]);
                $this->showSearch();
                break;
            case "watchlist":
                $this->showWatchlist();
                break;
            case "showSignup":
                $this->showSignup();
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
                    $this->db->query(
                        "insert into users (email, password) values ($1, $2);",
                        $_POST["email"],
                        password_hash($_POST["passwd"], PASSWORD_DEFAULT) // Use the hashed password!
                    );
                    $_SESSION["email"] = $_POST["email"];
                    // Send user to the appropriate page (home)
                    header("Location: ?command=home");
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
                    // session and send them to the question page
                    $_SESSION["email"] = $res[0]["email"];
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

    /**
     * Queries TMDB api for movies based on search keywords
     */
    public function searchMovies($title) {
        $url = 'https://api.themoviedb.org/3/search/movie?query=' . urlencode($title) . '&include_adult=true&language=en-US&sort_by=popularity.desc&page=1';

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

        $responseCredits = file_get_contents($urlCredits, false, $context);
        $creditsJSON = json_decode($responseCredits, true);

        // $directors = array_filter($creditsJSON['cast'], function ($person) {
        //     if(isset($person['job']) && $person['job'] === "Director") {
        //         return $person['name'];
        //     }
        // });
        $directors = array_map(function ($director) {
            if (isset($person['job']) && $person['job'] === "Director") {
                return $person['name'];
            }
        }, $creditsJSON['cast']);

        $actors = array_slice($creditsJSON['cast'], 0, 3);

        $_SESSION['directors'] = $directors;
        $_SESSION['actors'] = $actors;
    }

    /**
     * Our getQuestion function, now as a method!
     */
    // public function getQuestion($id=null) {

    //     // If $id is not set, then get a random question
    //     // We wrote this in class.
    //     if ($id === null) {
    //         // Read ONE random question from the database
    //         $qn = $this->db->query("select * from questions order by random() limit 1;");

    //         // The query function calls pg_fetch_all, which returns an **array of arrays**.
    //         // That means that if we only have one row in our result, it's an array at
    //         // position 0 of the array of arrays.
    //         // Note: we should check that $qn here is _not_ false first!
    //         return $qn[0];
    //     }

    //     // If an $id **was** passed in, then we should get that specific
    //     // question from the database.
    //     //
    //     // NOTE: We did **not** write this in class, but it is provided/updated
    //     // below:
    //     if (is_numeric($id)) {
    //         $res = $this->db->query("select * from questions where id = $1;", $id);
    //         if (empty($res)) {
    //             return false;
    //         }
    //         return $res[0];
    //     }

    //     // Anything else, just return false
    //     return false;
    // }

    # SHOW PAGES SECTION 

    /* Show the details page to the user. */
    public function showDetails() {
        include("/opt/src/flickvault/templates/details.php");
    }

    /* Show the history page to the user. */
    public function showHistory() {
        include("/opt/src/flickvault/templates/history.php");
    }

    /* Show the home page to the user. */
    public function showHome() {
        include("/opt/src/flickvault/templates/home.php");
    }

    /* Show the search page to the user. */
    public function showSearch() {
        include("/opt/src/flickvault/templates/search.php");
    }

    /* Show the watchlist page to the user. */
    public function showWatchlist() {
        include("/opt/src/flickvault/templates/watchlist.php");
    }

    /* Show the welcome page to the user. */
    public function showLogin() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger col-lg-6 mx-auto mt-3'>{$this->errorMessage}</div>";
        }
        include("/opt/src/flickvault/templates/login.php");
    }

    public function showSignup() {
        // Show an optional error message if the errorMessage field
        // is not empty.
        $errorMessage = "";
        if (!empty($this->errorMessage)) {
            $errorMessage = "<div class='alert alert-danger col-lg-6 mx-auto mt-3'>{$this->errorMessage}</div>";
        }
        include("/opt/src/flickvault/templates/signup.php");
    }

    /**
     * Check the user's answer to a question.
     */
    // public function answerQuestion() {
    //     $message = "";
    //     if (isset($_POST["questionid"]) && is_numeric($_POST["questionid"])) {

    //         $question = $this->getQuestion($_POST["questionid"]);

    //         if (strtolower(trim($_POST["answer"])) == strtolower($question["answer"])) {
    //             $message = "<div class=\"alert alert-success\" role=\"alert\">
    //                 Correct!
    //                 </div>";
    //             // Update the score in the session
    //             $_SESSION["score"] += 10;

    //             // **NEW**: We'll update the user's score in the database, too!
    //             $this->db->query("update users set score = $1 where email = $2;", 
    //                                 $_SESSION["score"], $_SESSION["email"]);
    //         }
    //         else {
    //             $message = "<div class=\"alert alert-danger\" role=\"alert\">
    //                 Incorrect! The correct answer was: {$question["answer"]}
    //                 </div>";
    //         }
    //     }

    //     $this->showQuestion($message);
    // }

}
