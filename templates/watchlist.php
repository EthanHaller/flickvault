<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alec McCue, Ethan Haller">
    <meta name="description" content="FlickVault Watch List Page">
    <meta name="keywords" content="FlickVault Watch List">
    <meta property="og:title" content="FlickVault Watch List">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/">
    <meta property="og:description" content="FlickVault Watch List Page">
    <meta property="og:site_name" content="CS4640">

    <title>FlickVault | Watch List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/watchlist.css">
    <link rel="stylesheet" href="styles/theme.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Inter Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Inknut Antiqua Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Inconsolata Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php
        include($filePath . '/flickvault/templates/navbar.php');
        ?>
    </header>

    <div class="container p-4 mt-4" style="background-color: #333333;">
        <div class="row">
            <div class="col-md-3 text-white">
                <h3>Reorder Watchlist</h3>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="movie" id="movie">
                    <option value="" disabled selected>Select a movie...</option>
                    <?php
                    // Check if $_SESSION['watchlist'] is set and is an array

                    if (isset($_SESSION['watchlist']) && is_array($_SESSION['watchlist'])) {
                        // Iterate through each item in the watchlist
                        foreach ($_SESSION['watchlist'] as $item) {
                            $serialized_item = htmlspecialchars(json_encode($item));
                            // Output each item as an option in the dropdown list
                            $movieTitle = $item['title'];
                            echo "<option value='$serialized_item'>$movieTitle</option>";
                        }
                    } else {
                        // If the watchlist is empty or not set, display a default option
                        echo "<option value=''>No items in watchlist</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="ranking" id="ranking">
                    <option value="" disabled selected>Select a ranking...</option>
                    <?php
                    // Generate options for ranking from 1 to the length of the watchlist
                    $watchlist_length = count($_SESSION['watchlist']);
                    for ($i = 1; $i <= $watchlist_length; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-secondary" id="watchlistReorderSubmit" type="submit">Reorder</button>
            </div>
        </div>
    </div>

    <div id="watchlistGrid" class="container-fluid movie-card-grid">
        <?php if (empty($_SESSION['watchlist'])) : ?>
            <h4 class="text-center" style="color: #d9d9d9; grid-column: 1 / -1;">You currently have no movies in your watchlist. Search for movies to add them!</h4>
        <?php endif ?> 
        <?php foreach ($_SESSION['watchlist'] as $movie) : ?>
            <div class="movie-card-container">
                <div class="card movie-card text-center">
                    <form method="post" action="?command=details&movieId=<?= $movie['movie_id']; ?>">
                        <button class="card-clickable" type="submit">
                            <div class="movie-card-text"><?= $movie['order_id']; ?></div>
                            <img src="<?= $movie['posterpath']; ?>" alt="Interstellar">
                            <div class="card-body">
                                <div class="movie-card-title"><?= $movie['title']; ?></div>
                                <div class="movie-card-text"><?= $movie['length']; ?></div>
                            </div>
                        </button>
                    </form>
                    <div class="card-footer">
                        <form method="post" action="?command=moveToHistory&movieId=<?= $movie['movie_id']; ?>&movieTitle=<?= $movie['title']; ?>&movieLength=<?= $movie['length']; ?>&moviePoster=<?= $movie['posterpath']; ?>">
                            <button id="move-to-history-btn" class="card-action" type="submit">Move to History</button>
                        </form>
                        <form method="post" action="?command=removeFromWatchlist&movieId=<?= $movie['movie_id']; ?>">
                            <button id="remove-from-watchlist-btn" class="card-action" type="submit">Remove from Watchlist</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
    $(() => {
        // Form to reorder watchlist
        $('#watchlistReorderSubmit').on('click', (event) => {
            event.preventDefault();

            console.log("running")
            // Get the form data
            let movie = $('#movie').val();
            let ranking = $('#ranking').val();

            const data = {
                movie: movie,
                ranking: ranking
            }

            // Send the AJAX request
            $.ajax({
                type: 'POST',
                // url: 'http://localhost:8080/flickvault/?command=reorderWatchlist',
                url: 'https://cs4640.cs.virginia.edu/vgn2bh/flickvault/?command=reorderWatchlist',
                data: data,
                success: (response) => {
                    reloadWatchlistGrid()
                },
                error: (xhr, status, error) => {
                    console.error(error);
                }
            });
        });

        const reloadWatchlistGrid = () => {
            // Make an AJAX call to fetch the updated watchlist content
            $.ajax({
                type: 'GET',
                // url: 'http://localhost:8080/flickvault/?command=getWatchlist',
                url: 'https://cs4640.cs.virginia.edu/vgn2bh/flickvault/?command=getWatchlist',
                success: (response) => {
                    location.reload();
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching watchlist content:', error);
                }
            });
        }
    })
</script>

</html>