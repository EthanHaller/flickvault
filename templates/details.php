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
    <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-title" aria-current="page" href="?command=home">
                <h1>FlickVault</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="?command=watchlist">Watch List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="?command=history">Watch History</a>
                    </li>
                </ul>
                <form id="nav-search-form" class="d-flex" role="search" action="" method="get">
                    <input type="hidden" name="command" value="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                    <button class="btn nav-search" type="submit">Search</button>
                </form>

                <div class="nav-item active ms-5">
                    <a href="?command=logout" class="btn btn-danger rounded-circle p-2" style="width: 40px; height: 40px;">
                        <i class="fa fa-sign-out text-white" style="font-size: 1.3rem; margin-left: 0.1rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

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
                    <!-- add to watchlist button -->
                    <form method="post" action="?command=addToWatchlist&movieId=<?= $_SESSION['movieDetails']['id']; ?>&movieTitle=<?= $_SESSION['movieDetails']['title']; ?>&movieLength=<?= $_SESSION['movieDetails']['runtime']; ?>&moviePoster=https://image.tmdb.org/t/p/original/<?= $_SESSION['movieDetails']['poster_path']; ?>">
                        <button type="submit">Add to Watchlist</button>
                    </form>
                </div>
            </div>
        </div>

    <?php endif ?>
</body>

</html>