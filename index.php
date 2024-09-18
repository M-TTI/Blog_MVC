<?php
require_once('model/UserDAO.php');
require_once('model/ArticleDAO.php');

session_start();

$dao_user = new UserDAO();
$dao_article = new ArticleDAO();
$connexion_message = '';
$module = '';

if (isset($_GET['deco']))
{
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
}

if (isset($_POST['btn_connect']))
{
    if (isset($_POST['username']) and $_POST['username'] != '' and
        isset($_POST['password']) and $_POST['password'] != '')
    {
        $connexion_message = $dao_user->connectUser($_POST['username'], $_POST['password']);
    }
}
if (isset($_POST['btnCreate']))
{
    if
    (
        isset($_POST['title']) and $_POST['title'] != '' and
        isset($_POST['content']) and $_POST['content']
    )
    {
        if (isset($_FILES['fileToUpload'])) {
            $target_dir = "./uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
                if ($_FILES["fileToUpload"]["size"] > 1000000) {
                    $uploadOk = 0;
                }
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            }
            $image_path = $target_file;
        }
        else
        {
            $image_path = './img/default.jpg';
        }

        //$article = new Article($title = $_POST['title'], $content = $_POST['content']/*, $image_path = $_POST['image_path']*/, $id_user = $_SESSION['user_id']);
        $article = new Article(0, $_POST['title'], 'NOW()', $_POST['content'], $image_path, $_SESSION['user_id']); //Band-Aid fix for now, TODO: FIX THIS
        $dao_article->create($article);
    }
}

if (isset($_POST['btnConfirmEdit']))
{
    $article = new Article(0, $_POST['title'], 'NOW()', $_POST['content'], './img/default.jpg', $_SESSION['user_id']);
    $dao_article->update($_POST['article_edit_id'], $article);
    unset($_POST['article_edit_id']);
}

if (isset($_POST['article_delete_id']))
{
    $dao_article->delete($_POST['article_delete_id']);
    unset($_POST['article_delete_id']);
}


//Views
include ('view/header.php');
if(!isset($_SESSION['user_id']))
{
    echo $connexion_message;
    include('view/connection_form.php');
}
else
{
    $articles = $dao_article->getAll();
    include('view/create_article.php');
    include('view/article_display.php');
}