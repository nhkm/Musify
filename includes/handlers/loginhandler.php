<?php
if (isset($_POST['loginButton'])) {
    $username = $_POST['loginUser'];
    $password = $_POST['loginPass'];

    $result = $account->login($username, $password);
    
    if($result == true) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
?>