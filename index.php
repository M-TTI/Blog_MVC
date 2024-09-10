<?php
require_once('model/UserDAO.php');
require_once('model/ArticleDAO.php');

session_start();

$dao_user = new UserDAO();
$dao_article = new ArticleDAO();
$connexion_message = '';

if (isset($_GET['deco']))
{
    unset($_GET['user_id']);
    unset($_GET['user_name']);
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
        isset($_POST['image_path']) and $_POST['image_path'] != ''
    )
    {
        $article = new Article($title = $_POST['title'], $content = $_POST['content'], $image_path = $_POST['image_path'], $id_user = $_SESSION['user_id']);
        $dao_article->create($article);
    }

}

if ($connexion_message != '')
{
    if ($connexion_message != 'ok')
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
}

