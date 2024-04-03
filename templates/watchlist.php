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
</head>

<body>
    <header>
        <?php
        include($filePath . '/flickvault/templates/navbar.php');
        ?>
    </header>

    <div class="container-fluid movie-card-grid">
        <?php foreach ($_SESSION['watchlist'] as $movie) : ?>

            <form class="movie-card-container" method="post" action="?command=details&movieId=<?= $movie['movie_id']; ?>">
                <div class="card movie-card text-center">
                    <button class="card-clickable" type="submit">
                        <div class="movie-card-text"><?= $movie['order_id']; ?></div>
                        <img src="<?= $movie['posterpath']; ?>" alt="Interstellar">
                        <div class="card-body">
                            <div class="movie-card-title"><?= $movie['title']; ?></div>
                            <div class="movie-card-text"><?= $movie['length']; ?></div>
                        </div>
                    </button>
                    <div class="card-footer">
                        <form method="post" action="?command=moveToHistory&id=<?= $movie['movie_id']; ?>">
                            <button id="move-to-history-btn" class="card-action" type="submit">Move to History</button>
                        </form>
                        <form method="post" action="?command=removeFromWatchlist&movieId=<?= $movie['movie_id']; ?>">
                            <button id="remove-from-watchlist-btn" class="card-action" type="submit">Remove from Watchlist</button>
                        </form>
                    </div>
                </div>
            </form>

        <?php endforeach; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>