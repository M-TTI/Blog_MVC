<small>Bonjour <?= $_SESSION['user_name'] ?></small>

<h1>Tous les articles</h1>

<?php foreach($articles as $a) { ?>
    <h2><?= $a->title?> le <small><?= $a->publish_date ?></small></h2>
    <p><?= $a->content ?></p>
    <hr>
<?php } ?>
<a href="index.php?deco">Déconnexion</a>