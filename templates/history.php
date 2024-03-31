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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/watch-history.css">
    <link rel="stylesheet" href="styles/theme.css">

    <!-- Inter Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Inter:wght@100..900&display=swap"
          rel="stylesheet">

    <!-- Inknut Antiqua Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Inconsolata Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-title" href="index.html">
                <h1>FlickVault</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="watchlist.html">Watch List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="watch-history.html">Watch History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="details.html">Details</a>
                    </li>
                </ul>
                <form id="nav-search-form" class="d-flex" role="search" action="search.html" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                    <button class="btn nav-search" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid filter-bar">
        <div class="filter-bar-item">Filter</div>
        <div class="filter-bar-item">
            <div>Watch date <span>&#8657;</span></div>
            <div>Rating</div>
        </div>
    </div>

    <div class="container-fluid movie-card-grid">
        <div class="movie-card-container">
            <div class="card movie-card text-center">
                <img src="https://image.tmdb.org/t/p/w600_and_h900_bestv2/uXDfjJbdP4ijW5hWSBrPrlKpxab.jpg" class="card-img-top" alt="Interstellar">
                <div class="card-body">
                    <div class="movie-card-title">Toy Story</div>
                    <div class="star-rating">
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span>&#9733;</span>
                    </div>
                    <div class="movie-card-watch-date">Watched on 1/1/2024</div>
                </div>
            </div>
        </div>

        <div class="movie-card-container">
            <div class="card movie-card text-center">
                <img src="https://image.tmdb.org/t/p/w200/eHuGQ10FUzK1mdOY69wF5pGgEf5.jpg" class="card-img-top" alt="Interstellar">
                <div class="card-body">
                    <div class="movie-card-title">Finding Nemo</div>
                    <div class="star-rating">
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span>&#9733;</span>
                        <span>&#9733;</span>
                    </div>
                    <div class="movie-card-watch-date">Watched on 1/1/2024</div>
                </div>
            </div>
        </div>

        <div class="movie-card-container">
            <div class="card movie-card text-center">
                <img src="https://image.tmdb.org/t/p/w200/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg" class="card-img-top" alt="Interstellar">
                <div class="card-body">
                    <div class="movie-card-title">Interstellar</div>
                    <div class="star-rating">
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span>&#9733;</span>
                        <span>&#9733;</span>
                    </div>
                    <div class="movie-card-watch-date">Watched on 1/1/2024</div>
                </div>
            </div>
        </div>

        <div class="movie-card-container">
            <div class="card movie-card text-center">
                <img src="https://image.tmdb.org/t/p/w200/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg" class="card-img-top" alt="Interstellar">
                <div class="card-body">
                    <div class="movie-card-title">Interstellar</div>
                    <div class="star-rating">
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span>&#9733;</span>
                        <span>&#9733;</span>
                    </div>
                    <div class="movie-card-watch-date">Watched on 1/1/2024</div>
                </div>
            </div>
        </div>

        <div class="movie-card-container">
            <div class="card movie-card text-center">
                <img src="https://image.tmdb.org/t/p/w200/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg" class="card-img-top" alt="Interstellar">
                <div class="card-body">
                    <div class="movie-card-title">Interstellar</div>
                    <div class="star-rating">
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span class="star-filled">&#9733;</span>
                        <span>&#9733;</span>
                        <span>&#9733;</span>
                    </div>
                    <div class="movie-card-watch-date">Watched on 1/1/2024</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>