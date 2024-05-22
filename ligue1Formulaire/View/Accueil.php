<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon Site de Football en Ligue</title>
    <link rel="stylesheet" href="../css/style_Accueil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <br>
        <br>
        <h1>L'Actualité du Foot</h1>
    </header>

    <div class="container">
        <h2>Voici ci-dessous tout l'actualité de la ligue 1</h2>
        <p>Découvrez les dernières actualités passionnantes de la ligue 1.</p>
        <p>Explorez notre site pour trouver des articles détaillés sur les matchs, les classements, et bien plus encore. Restez connectés avec le monde du football en ligue 1 !</p>
        <a href="/AfficherClub" class="btn">Liste des clubs</a>
    </div>

    <?php
    $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';
    $cnx = new PDO($dsn);

    $articlesQuery = $cnx->query("SELECT news.id_news, news.article_news, COUNT(commentaire.id_commentaire) AS comment_count
                                  FROM news
                                  LEFT JOIN commentaire ON news.id_news = commentaire.id_article
                                  GROUP BY news.id_news, news.article_news");

    foreach ($articlesQuery as $article) {
        echo '<div class="article_container">';
        echo '<h2>' . htmlspecialchars($article['article_news']) . '</h2>';

        $commentsQuery = $cnx->prepare("SELECT commentaire.id_commentaire, commentaire.str_commentaire, utilisateur.nom_uti AS nom
                                        FROM commentaire
                                        INNER JOIN utilisateur ON commentaire.id_uti = utilisateur.id_uti
                                        WHERE commentaire.id_news = :id_news
                                        LIMIT 3");
        $commentsQuery->bindParam(':id_news', $article['id_news'], PDO::PARAM_INT);
        $commentsQuery->execute();

        foreach ($commentsQuery as $comment) {
            echo '<div class="comment-container">';
            echo '<strong>' . htmlspecialchars($comment['nom']) . '</strong>';
            echo '<div class="comment">' . htmlspecialchars($comment['str_commentaire']) . '</div>';
            echo '</div><br>';
        }

        // Formulaire d'ajout de commentaire
        echo '<form class="comment-form" method="post">';
        echo '<input type="hidden" name="id_news" value="' . $article['id_news'] . '">';
        echo '<label for="nouveau_commentaire"><h1>Ajouter un commentaire :</h1></label><br>';
        echo '<textarea name="nouveau_commentaire" id="nouveau_commentaire" rows="3" required></textarea>';
        echo '<input type="submit" value="Ajouter commentaire">';
        echo '</form>';
        echo '</div>';
    }
    ?>

    <script>
        $(document).ready(function() {
            $('.comment-form').submit(function(event) {
                event.preventDefault();

                const form = $(this);
                const id_news = form.find('input[name="id_news"]').val();
                const nouveau_commentaire = form.find('textarea[name="nouveau_commentaire"]').val();

                $.ajax({
                    type: 'POST',
                    url: 'Controller/C_Commentaire.php',
                    data: {
                        id_news: id_news,
                        nouveau_commentaire: nouveau_commentaire
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            location.reload();
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Erreur lors de l\'ajout du commentaire: ' + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
