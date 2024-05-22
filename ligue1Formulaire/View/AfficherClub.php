<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clubs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des clubs</h1>
    <table>
        <thead>
            <tr>
                <th>Nom du club</th>
                <th>Ligue du club</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($t as $club) {
                echo '<tr>';
                echo '<td>' . $club->getNomClub() . '</td>';
                echo '<td>' . $club->getLigueClub() . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>