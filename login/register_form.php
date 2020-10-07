<?php

require '../connection/connection.php';
require 'users.php';

$register = new Users();

$errorMsgRegistration = '';

if (!empty($_POST['submitReg'])) {
    $name = $_POST['nameReg'];
    $email = $_POST['emailReg'];
    $username = $_POST['usernameReg'];
    $password = $_POST['passwordReg'];
    $companyName = $_POST['companyReg'];
    $address = $_POST['addressReg'];
    $city = $_POST['cityReg'];
    $postalCode = $_POST['postalReg'];
    $country = $_POST['countryReg'];

    $emailCheck = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]){2,4}$~i', $email);
    $usernameCheck = preg_match('~^[a-zA-Z0-9_čćžšđČĆŽŠĐ]{3,20}$~i', $username);
    $passwordCheck = preg_match('~^[a-zA-Z0-9!@?#$%&_*()čćžšđČĆŽŠĐ]{6,40}$~i', $password);

    if ($emailCheck && $usernameCheck && $passwordCheck && strlen(trim($name)) > 0) {
        $id = $register->userRegister($name, $email, $username, $password, $companyName, $address, $city, $postalCode, $country);
        if ($id) {
            header('Location: ' . BASE_URL . 'login/login_form.php');
        } else {
            $errorMsgRegistration = 'Username or Email already exists. Please choose another.';
        }
    }
}
require '../templates/header.php';
?>
<form method="post" name="signup">
    <fieldset>
        <legend>Register</legend>
            <label>
                Full Name <input type="text" name="nameReg" placeholder="John Doe" required />
            </label><br/><br/>
            <label>
                Email <input type="text" name="emailReg" placeholder="email@host.com" required />
            </label><br/><br/>
            <label>
                Username <input type="text" name="usernameReg" placeholder="Username" required />
            </label><br/><br/>
            <label>
                Password <input type="password" name="passwordReg" placeholder="Password" required>
            </label><br/><br/>
            <label>
                Company Name <input type="text" name="companyReg" placeholder="Drava d.d." required>
            </label><br/><br/>
            <label>
                Address <input type="text" name="addressReg" placeholder="3rd Street 102a" required>
            </label><br/><br/>
            <label>
                City <input type="text" name="cityReg" placeholder="Zagreb" required>
            </label><br/><br/>
            <label>
                Postal Code <input type="number" name="postalReg" placeholder="10000" required>
            </label><br/><br/>
            <label>
                Country <input type="text" name="countryReg" placeholder="Croatia" required>
            </label><br/><br/>
            <input type="submit" name="submitReg" value="Register" />
    </fieldset>
</form>
<?php
require '../templates/footer.php';
