<?php
session_start();

include "utils/tool.php";
include "model/user.php";

$message = "";
if(isset($_POST["submit"])){
    if(!empty($_POST["email"]) AND !empty($_POST["password"])){
        $email = sanitize($_POST["email"]);
        $password = sanitize($_POST["password"]);
        if(isUserByEmailExist($email)==true){
            $userConnected = findUserByEmail($email);
            if(passwordVerify($password, $userConnected["password"])){
                $_SESSION["connected"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $userConnected["idUser"];
                header('Location: /evaluation_php_laurent_loick//');
            } else {
                $message = "Les informations de connexion ne sont pas correctes";
                header("Refresh:2; url=/evaluation_php_laurent_loick//connexion.php");
            }
        } else {
                $message = "Les informations de connexion ne sont pas correctes";
                header("Refresh:2; url=/evaluation_php_laurent_loick//connexion.php");
        }
    } else {
        $message = "Veuillez remplir tout les champs";
        header("Refresh:2; url=/evaluation_php_laurent_loick//connexion.php");
    }
}

if (isset($_SESSION["connected"])==false) :
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        <form action="" method="post">
            <h2>Se connecter</h2>
            <input type="email" name="email" placeholder="Saisir le mail">
            <input type="password" name="password" placeholder="Saisir le mot de passe">
            <input type="submit" value="Connexion" name="submit">
            <p class="error"><?= $message ?></p>
        </form>
    </main>
</body>
</html>
<?php
else :
header("Location: /evaluation_php_laurent_loick//");
endif;
?>
