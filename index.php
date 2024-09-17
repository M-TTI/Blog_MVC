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
        isset($_POST['content']) and $_POST['content'] != '' and
        isset($_POST['image_path'])
    )
    {
        if (isset($_POST['image_path']) == '')
        {
            $image_path = './img/default.jpg';
        } else {
            $image_path = $_POST['image_path'];
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
}

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

