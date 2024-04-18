<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alec McCue, Ethan Haller">
    <meta name="description" content="FlickVault Watch History Page">
    <meta name="keywords" content="FlickVault Watch History">
    <meta property="og:title" content="FlickVault Watch History">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/">
    <meta property="og:description" content="FlickVault Watch History Page">
    <meta property="og:site_name" content="CS4640">

    <title>FlickVault | Watch History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/history.css">
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

    <div class="container-fluid filter-bar">
        <div class="filter-bar-item me-4">Sort by:</div>
        <div id="watch-date-filter" class="filter-bar-item">Watch date <span class="arrow-up"></span></div>
    </div>

    <div class="container-fluid movie-card-grid">
        <?php if (empty($_SESSION['history'])) : ?>
            <h4 class="text-center" style="color: #d9d9d9; grid-column: 1 / -1;">You currently have no movies in your history. Search for movies to add them!</h4>
        <?php endif ?>
        <?php foreach ($_SESSION['history'] as $movie) : ?>
            <div class="movie-card-container">
                <div class="card movie-card text-center">
                    <form method="post" action="?command=details&movieId=<?= $movie['movie_id']; ?>">
                        <button class="card-clickable" type="submit">
                            <img src="<?= $movie['posterpath']; ?>" class="card-img-top" alt="<?= $movie['title']; ?>">
                            <div class="card-body">
                                <div class="movie-card-title"><?= $movie['title']; ?></div>
                                <div class="movie-card-watch-date">Watched on <?= $movie['date_watched']; ?></div>
                            </div>
                        </button>
                    </form>
                    <div class="card-footer">
                        <form method="post" action="?command=moveToWatchlist&movieId=<?= $movie['movie_id']; ?>&movieTitle=<?= $movie['title']; ?>&movieLength=<?= $movie['length']; ?>&moviePoster=<?= $movie['posterpath']; ?>">
                            <button id="move-to-watchlist-btn" class="card-action" type="submit">Move to Watchlist</button>
                        </form>
                        <form method="post" action="?command=removeFromHistory&movieId=<?= $movie['movie_id']; ?>">
                            <button id="remove-from-history-btn" class="card-action" type="submit">Remove from History</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#watch-date-filter').click(function() {

                    $('.movie-card-grid').each(function() {
                        $(this).append($(this).children().get().reverse());
                    });

                    var arrow = $('#watch-date-filter').find('span');
                    arrow.toggleClass('arrow-up arrow-down');
                });
            });
        </script>
</body>

</html>