<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style_Accueil.css">
</head>

<body>
    <?php
    include_once("Model/GestionCommentaire.php");
    include_once("Model/Commentaire.php");
    include_once("header.php");
    include_once("./view/Accueil.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_news']) && isset($_POST['nouveau_commentaire'])) {
        $id_news = $_POST['id_news'];
        $nouveau_commentaire = $_POST['nouveau_commentaire'];
        $nom_utilisateur = $_POST['nom_utilisateur'];

        $commentaire = new Commentaire(
            $nouveau_commentaire, 
            $nom_utilisateur,    
            null,                    
            $id_news,           
            1                   
        );
        $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';
        $cnx = new PDO($dsn);

        include_once("Model/GestionCommentaire.php");

        $gestionCommentaire = new GestionCommentaire($cnx);
        $gestionCommentaire->ajouterCommentaire($commentaire);
    }
    ?>
</body>

</html>
