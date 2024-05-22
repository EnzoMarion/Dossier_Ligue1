<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Connexion - Ligue de Football</title>
</head>
<body>
    <br><br>
    <div class="container">
        <h1>Connexion</h1>
        <form action="C_Connexion" method="POST">

            <label for="email">Adresse mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
