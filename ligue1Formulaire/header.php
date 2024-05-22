<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div>
    <link rel="stylesheet" href="css/style_header.css">
    <script src="script/script.js"></script>
    <nav id="header">
        <li><a href="/Accueil">Accueil</a></li>
        <li><a href="/AfficherClub">Liste des clubs</a></li>
        <li><a href="/C_Classement">Classement</a></li>
        <?php if (!isset($_SESSION["user_id"])): ?>
            <li><a href="/Inscription">Inscription</a></li>
            <li><a href="/Connexion">Connexion</a></li>
        <?php else: ?>
            <li><a href="/C_Deconnexion">Déconnexion</a></li>
            <li><a href="/Profil">Bonjour, <?php echo htmlspecialchars($_SESSION["user_prenom"]) . " " . htmlspecialchars($_SESSION["user_nom"]); ?></a></li>
        <?php endif; ?>
    </nav>
</div>
<script>
let lastScrollTop = 0;
const header = document.querySelector("#header");

window.addEventListener("scroll", () => {
    const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScrollTop > lastScrollTop) {
        header.classList.add("hide");
    } else {
        header.classList.remove("hide");
    }

    lastScrollTop = currentScrollTop;
});
</script>
