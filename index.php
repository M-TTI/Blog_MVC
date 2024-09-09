<?php
require_once('model/UserDAO.php');
require_once('model/ArticleDAO.php');

$dao_user = new UserDAO();
$dao_article = new ArticleDAO();

$dao_user->connectUser('stays', 'lol');