<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <!-- https://cs4640.cs.virginia.edu/ttk4ey/flickvault/ -->

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Alec McCue, Ethan Haller">
  <meta name="description" content="FlickVault Login">
  <meta name="keywords" content="FlickVault Login">
  <meta property="og:title" content="FlickVault Login">
  <meta property="og:type" content="website">
  <meta property="og:image" content="">
  <meta property="og:url" content="https://cs4640.cs.virginia.edu/vgn2bh/flickvault/login">
  <meta property="og:description" content="FlickVault Login">
  <meta property="og:site_name" content="CS4640">

  <title>FlickVault | Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/login.css">
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
  <div class="container mt-5">
		<h1 class="text-center pt-5 mb-5">Welcome to FlickVault</h1>
		<form id="login-form" class="col-lg-6 mx-auto" method="post" action="?command=login">
    <h2 class="mt-5 mb-3">Login</h2>
				<input id="email-input" type="text" placeholder="Email" name="email" />
				<input id="password-input" type="password" placeholder="Password" name="passwd" />
			<button type="submit" class="btn mt-3 mb-5">Login</button>
      <p>Don't have an account?</p>
      <a href="?command=showSignup" class="mb-5">Create an account</a>
		</form>
    <?= $errorMessage ?>
	</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>