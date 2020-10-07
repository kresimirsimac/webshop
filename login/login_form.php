<?php

require '../connection/connection.php';
require 'users.php';

$logIn = new Users();

$errorMsgLogin = '';

if (!empty($_POST['loginSubmit'])) {
    $usernameEmail = $_POST['usernameEmail'];
    $password = $_POST['password'];
    if (strlen(trim($usernameEmail)) > 1 && strlen(trim($password)) > 6) {
        $id = $logIn->userLogin($usernameEmail, $password);
        if ($id) {
            header('Location: ' . BASE_URL . 'index.php');
        } else {
            echo $errorMsgLogin = 'Incorrect Login info. Please, check you Login details.';
        }
    }
}
require_once '../templates/header.php';
?>
<form method="post" name="login" action="">
    <fieldset>
        <legend>Log In</legend>
        <label>
            Username or Email <input type="text" name="usernameEmail" placeholder="Username/Email" required autofocus/>
        </label><br/><br/>
        <label>
            Password <input type="password" name="password" placeholder="Password" required/>
        </label><br/><br/>
        <input type="submit" name="loginSubmit" value="Log In" />
    </fieldset>
</form>
<?php
require_once '../templates/footer.php';
