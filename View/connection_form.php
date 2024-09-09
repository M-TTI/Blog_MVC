<?php

echo '
<form action="index.php" method="POST">
    <label for="username">Nom d\'utilisateur :</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Se connecter" name="btn_connect">
</form>
';