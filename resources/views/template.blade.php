<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    
    <title>Sticky Footer Navbar Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/mycss.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="json/manifest.json">
    <link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    
    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">
    
    <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">JobFinder</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="#">Offres</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="#">Emplois</a>
            </li>
          </ul>
          <form class="d-flex">
          <li class="nav-item">
              <a class="nav-link" href="#">Déconnexion</a>
            </li>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5">Bienvenue sur le site <b>JobFinder</b></h1>
      <p class="lead">Vous pouvez naviguer sur les différents onglets pour trouver des offres d'emplois</p>
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">Footer</span>
    </div>
  </footer>


      <script src="/public/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


  </body>
</html>