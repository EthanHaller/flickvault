<!DOCTYPE html>
<html lang="en">

<head>
  <!-- https://cs4640.cs.virginia.edu/ttk4ey/flickvault/ -->

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Alec McCue, Ethan Haller">
  <meta name="description" content="FlickVault Home">
  <meta name="keywords" content="FlickVault Home">
  <meta property="og:title" content="FlickVault Home">
  <meta property="og:type" content="website">
  <meta property="og:image" content="">
  <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/">
  <meta property="og:description" content="FlickVault Home">
  <meta property="og:site_name" content="CS4640">

  <title>FlickVault | Home</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/home.css">
  <link rel="stylesheet" type="text/css" href="styles/theme.css">

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
            <li class="nav-item">
              <a class="nav-link active" href="?command=details">Details</a>
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
  </header>

  <div class="full-height-container">
    <div class="container text-center">
      <div class="home-title">
        <h2 class="display-4">Welcome to FlickVault</h2>
        <p class="lead">Organize Your Movie Watching Experience</p>
      </div>

      <section class="mb-5">
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="feature">
              <h3>Discover</h3>
              <p>Explore a vast library of movies and TV shows. Find something new to watch.</p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="feature">
              <h3>Watchlist</h3>
              <p>Keep track of movies and shows you want to watch. Never miss a title.</p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="feature">
              <h3>Review</h3>
              <p>Rate and review movies and shows. Share your thoughts with the community.</p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>