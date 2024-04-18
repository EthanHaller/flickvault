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
        include($filePath . '/flickvault/templates/navbar.php');
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
                <button id="close-filter-menu-btn" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div id="filter-menu-body" class="offcanvas-body">
                <div class="filter-section">
                    <h3>Star Rating</h3>
                    <div id="star-rating" class="d-flex flex-column">
                        <label for="min-stars">Min Stars</label>
                        <select id="min-stars" class="form-select" aria-label="Min Stars">
                            <option selected value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                            <option value="6">6 Stars</option>
                            <option value="7">7 Stars</option>
                            <option value="8">8 Stars</option>
                            <option value="9">9 Stars</option>
                            <option value="10">10 Stars</option>
                        </select>

                        <label for="max-stars">Max Stars</label>
                        <select id="max-stars" class="form-select" aria-label="Max Stars">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                            <option value="6">6 Stars</option>
                            <option value="7">7 Stars</option>
                            <option value="8">8 Stars</option>
                            <option value="9">9 Stars</option>
                            <option selected value="10">10 Stars</option>
                        </select>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Release Year</h3>
                    <div class="d-flex flex-column gap-3">
                        <label for="min-year">Minimum Year</label>
                        <input class="form-control" type="number" id="min-year" name="min-year" min="1900" max="2024" value="1900">

                        <label for="max-year">Maximum Year</label>
                        <input class="form-control" type="number" id="max-year" name="max-year" min="1900" max="2024" value="2024">
                    </div>
                </div>
                <button class="btn" id="apply-filter-button">Apply</button>
            </div>
        </div>

        <!-- Filter & Sort button -->
        <button id="filter-button" class="btn nav-search" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" style="padding-right: 4rem;">
            <span>&#11164;</span> Filter & Sort
        </button>
    </div>

    <div class="search-results container">
        <h2 class="antiqua mb-3">Results</h2>
        <?php if (!isset($_SESSION['searchResults']) || empty($_SESSION['searchResults'])) : ?>
            <p class="result-title">No results matched your search.</p>
        <?php endif; ?>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#apply-filter-button').click(function() {

                var minStars = parseFloat($('#min-stars').val());
                var maxStars = parseFloat($('#max-stars').val());
                var minYear = parseInt($('#min-year').val());
                var maxYear = parseInt($('#max-year').val());

                $('.search-results').find('.search-result').each(function() {
                    var stars = parseFloat($(this).find('.result-stars p').text());
                    var year = parseInt($(this).find('.result-year').text());

                    if (stars >= minStars && stars <= maxStars && year >= minYear && year <= maxYear) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                $('#offcanvas').find('.btn-close').click();
            });
        });
    </script>
</body>

</html>