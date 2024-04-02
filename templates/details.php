<!DOCTYPE html>
<html lang="en">
<!-- We need some mark as watched button with a date select -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alec McCue, Ethan Haller">
    <meta name="description" content="FlickVault Movie Details Page">
    <meta name="keywords" content="FlickVault Movie Details">
    <meta property="og:title" content="FlickVault Movie Details">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/">
    <meta property="og:description" content="FlickVault Movie Details Page">
    <meta property="og:site_name" content="CS4640">

    <title>FlickVault | Details</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/details.css">
    <link rel="stylesheet" href="styles/theme.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        include($filePath . '/flickvault/templates/navbar.php');
    ?>

    <?php if (isset($_SESSION['movieDetails'])) : ?>
        <div class="container-fluid" style="padding-left: 0rem;">
            <div class="row">
                <div class="details-poster-wrapper col-lg-4">
                    <?php if ($_SESSION['movieDetails']['poster_path'] !== null) : ?>
                        <img class="details-poster" src="<?= $_SESSION['movieDetails']['poster_path']; ?>" alt="Movie Poster">
                    <?php else : ?>
                        <img class="details-poster" style="display: none;" src="" alt="No Poster">
                    <?php endif ?>
                </div>
                <div class="movie-details col-lg-8">
                    <h2 class="details-title mt-5"><?= $_SESSION['movieDetails']['title']; ?></h2>
                    <div class="details-stars mb-5">
                        <span class="star">&starf;</span>
                        <p><?= substr($_SESSION['movieDetails']['vote_average'], 0, 3); ?>/10</p>
                    </div>
                    <div class="details-year-rating-time mb-5">
                        <p><?= substr($_SESSION['movieDetails']['release_date'], 0, 4); ?></p>
                        <p>R</p>
                        <p><?= $_SESSION['movieDetails']['runtime']; ?></p>
                    </div>
                    <div class="details-description mb-3">
                        <p><?= $_SESSION['movieDetails']['overview']; ?></p>
                    </div>
                    <div class="details-genre mb-3">
                        <?php foreach ($_SESSION['movieDetails']['genres'] as $genre) : ?>
                            <p><?= $genre['name'] ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="details-people mb-3">
                        <p><strong>Directors: </strong></p>
                        <?php foreach ($_SESSION['directors'] as $director) : ?>
                            <?php if (!empty($director)) : ?>
                                <p class="details-actor"><?= $director ?></p>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="details-people mb-3">
                        <p><strong>Actors:</strong></p>
                        <?php foreach ($_SESSION['actors'] as $actor) : ?>
                            <p class="details-actor"><?= $actor['name'] ?></p>
                        <?php endforeach; ?>
                    </div>
                    <form method="post" action="?command=addToWatchlist&movieId=<?= $_SESSION['movieDetails']['id']; ?>&movieTitle=<?= $_SESSION['movieDetails']['title']; ?>&movieLength=<?= $_SESSION['movieDetails']['runtime']; ?>&moviePoster=https://image.tmdb.org/t/p/original/<?= $_SESSION['movieDetails']['poster_path']; ?>">
                        <button type="submit">Add to Watchlist</button>
                    </form>
                    <form method="post" action="?command=addToHistory&movieId=<?= $_SESSION['movieDetails']['id']; ?>&movieTitle=<?= $_SESSION['movieDetails']['title']; ?>&movieLength=<?= $_SESSION['movieDetails']['runtime']; ?>&moviePoster=https://image.tmdb.org/t/p/original/<?= $_SESSION['movieDetails']['poster_path']; ?>">
                        <button type="submit">Add to History</button>
                    </form>
                </div>
            </div>
        </div>

    <?php endif ?>
</body>

</html>