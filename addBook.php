<?php
    session_start();

    include "./model/book.php";
    include "./model/category.php";
    include "./utils/tool.php";
    include "./model/user.php";

    $message = "";
    $category = findAllCategory();

    if(isset($_POST["submit"])){
        if(!empty($_POST["title"]) AND !empty($_POST["description"]) AND !empty($_POST["author"]) AND !empty($_POST["category"])){
            if(findUserByEmail($_SESSION["email"])==true){
                $title = sanitize($_POST["title"]);
                $description = sanitize($_POST["description"]);
                $author = sanitize($_POST["author"]);
                if(is_numeric($_POST["category"])){
                    $idCategory = sanitize($_POST["category"]);
                    $user = $_SESSION["id"];
                    addBook($title,$description,$author,$idCategory,$user);
                    $message = "Le livre a bien été rajouté";
                    header("Refresh:2 url=/evaluation_php_laurent_loick//addBook.php");
                } else {
                    $message = "Veuillez selectionner une catégorie";
                }
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
    <title>Ajouter un livre</title>
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
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Ajouter un livre</h2>
            <input type="text" name="author" placeholder="Saisir le nom de l'auteur">
            <input type="text" name="title" placeholder="Saisir le titre du livre">
            <textarea name="description" id="description" minlength="1" placeholder="Description du livre"></textarea>
            <select name="category" id="category">
                <option>Selectionner une catégorie:</option>
                <?php
                foreach($category as $c){
                ?>
                <option value="<?= $c["id_category"]?>"><?= $c["name"]?></option>
                <?php
                }
                ?>
            </select>
            <input type="submit" value="Ajouter" name="submit">
            <p class="error"><?= $message ?></p>
        </form>
    </main>
</body>
</html>
<?php
else :
header("Location: /evaluation_php_laurent_loick/");
endif;
?>
