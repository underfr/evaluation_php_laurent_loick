<?php
    session_start();
    include "./model/user.php";
    $user = "";
    if(isset($_SESSION["connected"])==true){
        $user = findUserByEmail($_SESSION["email"]);
        $user = $user["firstname"];
    }
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./public/pico.min.css">
    <link rel="stylesheet" href="./public/style.css">
</head>
<body>
    <header class="container-fluid">
        <nav>
            <ul>
                <li><strong><a href="index.php" data-tooltip="Page Accueil">Accueil</a></strong></li>
            </ul>
            <?php if (isset($_SESSION["connected"])==true) :?>
            <ul>
                <li><a href="addBook.php">Ajouter un livre</a></li>
                <li><a href="showAllBook.php">Afficher la collection</a></li>
                <li><a href="deconnexion.php">Se deconnecter</a></li>
            </ul>
            <?php else :?>
            <ul>
                <li><a href="register.php" data-tooltip="Inscription">S'inscrire</a></li>
                <li><a href="connexion.php" data-tooltip="Connexion">Se connecter</a></li>
            </ul>
            <?php endif?>
        </nav>
    </header>
    <main>
        <h2>Bienvenue sur le site de gestion de livre <?=$user?></h2>
    </main>
</body>
</html>
