<small>Bonjour <?= $_SESSION['user_name'] ?></small>

<h1>Tous les articles</h1>

<?php foreach($articles as $a) { ?>
    <h2><?= $a->title?> le <small><?= $a->publish_date ?></small></h2>
    <p><?= $a->content ?></p>
    <?php if ($a->id_user == $_SESSION['user_id']) { ?>
            <form action="index.php" method="post">
                <input type="hidden" value="<?= $a->id ?>" name="article_edit_id">
                <input type="submit" value="edit" name="article_edit_button">
            </form>
            <form action="index.php" method="post">
                <input type="hidden" value="<?= $a->id ?>" name="article_delete_id">
                <input type="submit" value="delete" name="article_delete_button">
            </form>
        <?php }?>
    <hr>
<?php } ?>
<a href="index.php?deco">Déconnexion</a>