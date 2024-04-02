<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alec McCue, Ethan Haller">
    <meta name="description" content="FlickVault Search Page">
    <meta name="keywords" content="FlickVault Search">
    <meta property="og:title" content="FlickVault Search">
    <meta property="og:type" content="website">
    <meta property="og:image" content="">
    <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/">
    <meta property="og:description" content="FlickVault Search Page">
    <meta property="og:site_name" content="CS4640">

    <title>FlickVault | Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/search.css">
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
        include('/opt/src/flickvault/templates/navbar.php');
        ?>
    </header>


    <div class="search-container filter">
        <!-- Search bar and button -->
        <div id="search-form-wrapper">
            <form id="search-form" role="search" action="" method="get">
                <input type="hidden" name="command" value="search">
                <input type="search" class="form-control" name="query" value="<?= !empty($_SESSION['query']) ? htmlspecialchars($_SESSION['query']) : "" ?>" placeholder="<?= empty($_SESSION['query']) ? "Search" : "" ?>">
                <button type="submit" class="btn nav-search">Search</button>
            </form>
        </div>

        <!-- Off-canvas Menu -->
        <div class="offcanvas offcanvas-end w-25 filter-menu" tabindex="-1" id="offcanvas" data-bs-theme="dark" data-bs-keyboard="false" data-bs-backdrop="false">
            <div class="offcanvas-header">
                <h2>Filter and Sort</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div id="filter-menu-body" class="offcanvas-body">
                <div class="filter-section">
                    <h3>Genre</h3>
                    <div class="checkbox-group">
                        <label for="action" class="checkbox-item"><input type="checkbox" id="action" name="genre" value="action"> Action</label>
                        <label for="adventure" class="checkbox-item"><input type="checkbox" id="adventure" name="genre" value="adventure"> Adventure</label>
                        <label for="comedy" class="checkbox-item"><input type="checkbox" id="comedy" name="genre" value="comedy"> Comedy</label>
                        <label for="crime" class="checkbox-item"><input type="checkbox" id="crime" name="genre" value="crime"> Crime</label>
                        <label for="family" class="checkbox-item"><input type="checkbox" id="family" name="genre" value="family"> Family</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Rating</h3>
                    <div class="checkbox-group">
                        <label for="g"><input type="checkbox" id="g" name="rating" value="g"> G</label>
                        <label for="pg"><input type="checkbox" id="pg" name="rating" value="pg"> PG</label>
                        <label for="pg-13"><input type="checkbox" id="pg-13" name="rating" value="pg-13"> PG-13</label>
                        <label for="r"><input type="checkbox" id="r" name="rating" value="r"> R</label>
                        <label for="nc-17"><input type="checkbox" id="nc-17" name="rating" value="pg-13"> NC-17</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Star Rating</h3>
                    <div id="star-rating">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="star-rating-dropdown-lower" data-bs-toggle="dropdown" aria-expanded="false">
                                Min Star
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="star-rating-dropdown-lower">
                                <li><a class="dropdown-item" href="#">1 star</a></li>
                                <li><a class="dropdown-item" href="#">2 stars</a></li>
                                <li><a class="dropdown-item" href="#">3 stars</a></li>
                                <li><a class="dropdown-item" href="#">4 stars</a></li>
                                <li><a class="dropdown-item" href="#">5 stars</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="star-rating-dropdown-upper" data-bs-toggle="dropdown" aria-expanded="false">
                                Max Star
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="star-rating-dropdown-upper">
                                <li><a class="dropdown-item" href="#">1 star</a></li>
                                <li><a class="dropdown-item" href="#">2 stars</a></li>
                                <li><a class="dropdown-item" href="#">3 stars</a></li>
                                <li><a class="dropdown-item" href="#">4 stars</a></li>
                                <li><a class="dropdown-item" href="#">5 stars</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Release Year</h3>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Min Year" aria-label="Min Year">
                        <input type="text" class="form-control" placeholder="Max Year" aria-label="Max Year">
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Sort button -->
        <button id="filter-button" class="btn nav-search" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" style="padding-right: 4rem;">
            <span>&#11164;</span> Filter & Sort
        </button>
    </div>

    <div class="search-results container">
        <h2 class="antiqua mb-3">Results</h2>
        <?php foreach ($_SESSION['searchResults'] as $movie) : ?>
            <form class="mb-4" method="post" action="?command=details&movieId=<?= $movie['id']; ?>">
                <button class="search-result card-clickable" style="background-image: url('https://image.tmdb.org/t/p/original<?= $movie['backdrop_path']; ?>');">
                    <div class="overlay"></div>
                    <div class="search-result-poster-wrapper">
                        <?php if ($movie['poster_path'] !== null) : ?>
                            <img class="search-result-poster" src="https://image.tmdb.org/t/p/original<?= $movie['poster_path']; ?>" alt="Movie Poster">
                        <?php else : ?>
                            <div class="search-result-poster" style="visibility: hidden;"></div>
                        <?php endif ?>
                    </div>
                    <div class="search-result-details">
                        <div class="result-title-year mb-1">
                            <h3 class="result-title antiqua"><?= $movie['title']; ?></h3>
                            <p class="result-year"><?= substr($movie['release_date'], 0, 4); ?></p>
                        </div>
                        <div class="result-stars">
                            <span class="star">&starf;</span>
                            <p><?= substr($movie['vote_average'], 0, 3); ?></p>
                        </div>
                        <p class="result-description mt-4"><?= $movie['overview'] ?></p>
                    </div>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>