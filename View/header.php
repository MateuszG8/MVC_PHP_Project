<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mateusz Guzowski" />
    <title>Przepisy</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container px-4">
        <a class="navbar-brand" href="../Controller/index.php">Strona Główna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav p-2 me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategorie</a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Model/kategorie/desery.php">Desery</a></li>
                        <li><a class="dropdown-item" href="../Model/kategorie/glowne.php">Dania Główne</a></li>
                        <li><a class="dropdown-item" href="../Model/kategorie/sniadania.php">Śniadania</a></li>
                        <li><a class="dropdown-item" href="../Model/kategorie/kolacje.php">Kolacje</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex m-1" method="GET">
                <input class="form-control me-2" type="search" name="czy" placeholder="Szukaj" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Szukaj</button>
            </form>
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Logowanie
            </button>
        </div>
    </div>
</nav>
<?PHP
include "Login_Modal.php";
?>
