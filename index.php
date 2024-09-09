<?php
require_once('model/UserDAO.php');
require_once('model/ArticleDAO.php');

echo '
<html>
    <head>
        <title>Blog</title>
    </head>
    <body>
';
$dao_user = new UserDAO();
$dao_article = new ArticleDAO();

session_start();

include("View/connection_form.php");
if (isset($_POST['username']) and isset($_POST['password']))
{
    $dao_user->connectUser($_POST['username'], $_POST['password']);
}


echo '
    </body>
</html>
';
