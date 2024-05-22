<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clubs</title>
    <link rel="stylesheet" href="path/to/style.css">
</head>
<body>
    <?php
    include_once("header.php");
    require_once(__DIR__ . '/../Model/Club.php');
    require_once(__DIR__ . '/../Model/GestionClub.php');

    $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';
    try {
        $cnx = new PDO($dsn);
    } catch (PDOException $e) {
        echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        exit();
    }

    $gestionClub = new GestionClub($cnx);
    $listeClubs = $gestionClub->getListeClub();
    ?>

    <div class="container">
        <table>
            <br>
            <tr>
                <th>Nom du club</th>
                <th>Ville</th>
                <th>Manager</th>
            </tr>
            <?php foreach ($listeClubs as $club) : ?>
                <tr>
                    <td><?= htmlspecialchars($club->getNomClub()) ?></td>
                    <td><?= htmlspecialchars($club->getVille()) ?></td>
                    <td><?= htmlspecialchars($club->getManagerClub()) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
