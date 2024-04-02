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
        include('/opt/src/flickvault/templates/navbar.php');
        ?>
    </header>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>