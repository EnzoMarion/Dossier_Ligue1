<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="css/style_inscription.css">
</head>

<body>
    
    <?php
    
    include_once("Routeur.php");
    $router = new Router(); 
    $router->addRoute("/Inscription", "Controller/C_Inscription.php"); 
    $router->addRoute("/AfficherClub", "Controller/C_Club.php");
    $router->addRoute("/C_Classement", "Controller/C_Classement.php");
    $router->addRoute("/C_Inscription", "Controller/C_Inscription.php");
    $router->addRoute("/Connexion", "Controller/C_Connexion.php");
    $router->addRoute("/C_Connexion", "Controller/C_Connexion.php");
    $router->addRoute("/C_Deconnexion", "Controller/C_Deconnexion.php");
    $router->addRoute("/Profil", "Controller/C_Profil.php");
    $router->addRoute("/GestionCommentaire", "Controller/C_Commentaire.php");
    $router->addRoute("/Accueil", "Controller/C_Accueil.php");

    
    $router->addRoute("/Accueil", "Controller/C_Accueil.php");
    $router->addRoute("/", "Controller/C_Accueil.php");
    


    $currentURL = $_SERVER['REQUEST_URI'];

    $router->execute($currentURL);
    ?>

</body>

</html>
