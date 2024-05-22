<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br><br>
    <div class="container">
        <h1>Profil Utilisateur</h1>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($user->getNom()); ?></p>
        <p><strong>Prénom:</strong> <?php echo htmlspecialchars($user->getPrenom()); ?></p>
        <h2>Clubs Abonnés</h2>
        <ul>
            <?php foreach ($clubsFavoris as $club) : ?>
                <li><?php echo htmlspecialchars($club->getNomClub()); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
