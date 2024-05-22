<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Inscription - Ligue de Football</title>
</head>
<body>
    <br><br>
    <div class="container">
        <h1>Inscription</h1>
        <form action="C_Inscription" method="POST" enctype="multipart/form-data">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="" required>

            <label for="email">Adresse mail :</label>
            <input type="email" id="email" name="email" value="" required>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required>

            <label for="confirmpassword">Confirmer le mot de passe :</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required>


            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">Autre</option>
            </select>

            <label for="club">Clubs favoris :</label>
            <div class="checkbox-group">
                <?php foreach ($clubs as $club) : ?>
                    <div>
                        <input type="checkbox" id="<?= $club->getNomClub() ?>" name="clubs[]" value="<?= $club->getNomClub() ?>">
                        <label for="<?= $club->getNomClub() ?>"><?= $club->getNomClub() ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <h3>Clubs de ligue 1 et/ou 2 :</h3>
            <div class="checkbox-group">
                <div>
                    <input type="checkbox" id="Ligue1" name="clubs[]" value="Ligue 1">
                    <label for="Ligue1">Ligue 1</label>
                </div>
                <div>
                    <input type="checkbox" id="Ligue2" name="clubs[]" value="Ligue 2">
                    <label for="Ligue2">Ligue 2</label>
                </div>
            </div>

            <br><br><br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
<script>
        if (document.querySelector('form')) {
            document.querySelector('form').addEventListener('submit', function(event) {
                const motdepasse = document.getElementById('motdepasse').value;
                const confirmpassword = document.getElementById('confirmpassword').value;
                
                if (motdepasse !== confirmpassword) {
                    alert("Les mots de passe ne correspondent pas.");
                    event.preventDefault();
                }
            });
        }
    </script>
</body>
</html>
