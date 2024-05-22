<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement des Clubs</title>
    <link rel="stylesheet" href="path/to/style.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>
    <?php
    include_once("header.php");

    class C_Club {
        public function run($annee) {
            $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';
            try {
                $cnx = new PDO($dsn);
            } catch (PDOException $e) {
                echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
                exit();
            }

            if ($annee != 2023 && $annee != 2024) {
                echo "Année invalide. Veuillez choisir 2023 ou 2024.";
                exit();
            }

            if (isset($_POST['annee'])) {
                $annee = $_POST['annee'];
            }

            $query = "SELECT * FROM classement_par_annee(:annee)";
            $stmt = $cnx->prepare($query);
            $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class='container'>";
            echo "<form method='post'>";
            echo "<label><input type='radio' name='annee' value='2023' " . ($annee == 2023 ? "checked" : "") . "> 2023</label>";
            echo "<label><input type='radio' name='annee' value='2024' " . ($annee == 2024 ? "checked" : "") . "> 2024</label>";
            echo "<button type='submit'>Afficher</button>";
            echo "</form>";

            echo "<h1>Classement des clubs pour l'année $annee</h1>";
            echo "<table>";
            echo "<tr><th>Position</th><th>Nom du club</th><th>Matchs gagnés</th><th>Matchs perdus</th><th>Matchs nuls</th><th>Buts marqués</th><th>Buts encaissés</th><th>Différence de buts</th><th>Points</th></tr>";
            foreach ($result as $row) {
                echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['position_club']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nom_club']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['matchs_gagnes']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['matchs_perdus']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['matchs_nuls']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['buts_marques']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['buts_encaisse']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['difference_buts']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nb_points']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
    }

    $controller = new C_Club();
    $annee = isset($_POST['annee']) ? $_POST['annee'] : 2023; // Par défaut, l'année 2023 est affichée
    $controller->run($annee);
    ?>
</body>
</html>
