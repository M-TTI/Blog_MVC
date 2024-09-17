<small>Bonjour <?= $_SESSION['user_name'] ?></small>

<h1>Tous les articles</h1>

<?php foreach($articles as $a) { ?>
    <h2><?= $a->title?> le <small><?= $a->publish_date ?></small></h2>
    <p><?= $a->content ?></p>
    <?php if ($a->id_user == $_SESSION['user_id']) { ?>
            <form action="index.php" method="post">
                <input type="hidden" value="<?= $a->id ?>" name="article_edit_id">
                <input type="submit" value="edit">
            </form>
            <form action="index.php" method="post" id="deleteForm">
                <input type="hidden" value="<?= $a->id ?>" name="article_delete_id">
                <input type="button" value="delete" onclick="deleteAlerte()">
            </form>
        <?php }?>
    <hr>
<?php } ?>
<script>
    function deleteAlerte()
    {
        let res = confirm("Are you sure you want to delete this article ?");
        if(res)
        {
            document.forms["deleteForm"].submit();
        }
    }
</script>
<a href="index.php?deco">Déconnexion</a>