<small>Bonjour <?= $_SESSION['user_name'] ?></small>

<h1>Tous les articles</h1>

<?php foreach($articles as $a) {
    if (isset($_POST['btnEdit']) and isset($_POST['article_edit_id']) and $a->id == $_POST['article_edit_id']) { ?>
        <form method="post" action="index.php">
            <input type="text" name="title" value="<?=$a->title?>">
            <br>
            <textarea name="content"><?=$a->content?></textarea>
            <br>
            <input type="hidden" value="<?= $a->id ?>" name="article_edit_id">
            <input type="submit" name="btnConfirmEdit" value="confirm">
            <button name="btnCancelEdit">cancel</button>
        </form>
    <?php } else {?>
        <h2><?= $a->title?> le <small><?= $a->publish_date ?> par <?= $dao_user->getByID($a->id_user)->username ?></small></h2>
        <p><?= $a->content ?></p>
        <img src="<?=$a->image_path?>">
    <?php if ($a->id_user == $_SESSION['user_id']) { ?>
            <form action="index.php" method="post">
                <input type="hidden" value="<?= $a->id ?>" name="article_edit_id">
                <input type="submit" name="btnEdit" value="edit">
            </form>
            <form action="index.php" method="post" id="deleteForm">
                <input type="hidden" value="<?= $a->id ?>" name="article_delete_id">
                <input type="button" value="delete" onclick="deleteAlerte()">
            </form>
        <?php }?>
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