<?php
session_start();
include "./model/book.php";
include "./model/category.php";
include "./utils/tool.php";
include "./model/user.php";
$message = "";
$books = findAllBooks();
if(isset($_POST["submit"])){
    if(!empty($_POST["title"]) AND !empty($_POST["description"]) AND !empty($_POST["author"]) AND !empty($_POST["category"])){
        if(findUserByEmail($_SESSION["email"])==true){
            $title = sanitize($_POST["title"]);
            $description = sanitize($_POST["description"]);
            $author = sanitize($_POST["author"]);
            $idCategory = sanitize($_POST["category"]);
            $user = $_SESSION["id"];
            addBook($title,$description,$author,$idCategory,$user);
            $message = "Le livre a bien été rajouté";
            header("Refresh:2 url=/evaluation_php_laurent_loick//addBook.php");
        } else {
            $message = "Enregistrement impossible";
        }
    } else {
        $message = "Veuillez remplir tout les champs";
    }
}
if (isset($_SESSION["connected"])==true) :
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="public/pico.min.css">
    <link rel="stylesheet" href="public/style.css">
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
    <main class="container-fluid">
        <table class="striped">
            <thead data-theme="dark">
                <th>Title</th>
                <th>Description</th>
                <th>Date de publication</th>
                <th>Auteur</th>
                <th>Categories</th>
            </thead>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $book["title"] ?> </td>
                    <td>
                        <?= $book["description"] ?>
                    </td>
                    <td>
                        <?= $book["publication_date"]?>
                    </td>
                    <td>
                        <?= $book["author"]?>
                    </td>
                    <td>
                        <?= $book["name"]?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </main>
</body>
</html>
<?php
else :
header("Location: /evaluation_php_laurent_loick/");
endif;
?>
