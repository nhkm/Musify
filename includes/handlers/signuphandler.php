<?php
function simplifyFormPassword($inputText){
    $inputText = strip_tags($inputText);
    return $inputText;
}

function simplifyFormUsername($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

function simplifyFormString($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}

function validateUsername($un){

}
function validateFirstname($fn){
    
}
function validateLastname($ln){
    
}
function validateEmail($em){
    
}
function validatePasswords($pw, $pw2){
    
}

if (isset($_POST['signupButton'])) {
    $username = simplifyFormUsername($_POST['username']);
    $firstName = simplifyFormString($_POST['firstName']);
    $lastName = simplifyFormString($_POST['lastName']);
    $email = simplifyFormString($_POST['email']);
    $password = simplifyFormPassword($_POST['password']);
    $password2 = simplifyFormPassword($_POST['password2']);

    validateUsername($username);
    validateFirstname($firstName);
    validateLastname($lastName);
    validateEmail($email);
    validatePasswords($password, $password2);

    $signupSuccessfull = $account->register($username, $firstName, $lastName, $email, $password, $password2);

    if($signupSuccessfull == true) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}

?>