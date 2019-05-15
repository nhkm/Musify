<?php
    include('includes/config.php');
    include('includes/classes/Account.php');
    include('includes/classes/Constants.php');
        $account = new Account($con);
        
    include_once('includes/handlers/signuphandler.php');
    include_once('includes/handlers/loginhandler.php');

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Musify App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/register.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
        if(isset($_POST['signupButton'])) {
            echo '<script>
                    $(document).ready(function() {
                        $(".loginForm").hide();
                        $(".signupForm").show();
                    });
                </script>';
        }
        else {
            echo '<script>
                    $(document).ready(function() {
                        $(".loginForm").show();
                        $(".signupForm").hide();
                    });
                </script>';
        }
    ?>
    
    <div class="background">
        <div class="loginContainer">
            <div class="inputContainer">
                <form action="register.php" method="POST" class="loginForm">
                    <h2>Login to your account!</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUser">Username</label>
                        <input type="text" id="loginUser" name="loginUser" value="<?php getInputValue('loginUser'); ?>" placeholder="e.g. bartSimpson" required>
                    </p>
                    <p>
                        <label for="loginPass">Password</label>
                        <input type="password" id="loginPass" name="loginPass" placeholder="your password" required>
                    </p>
                    <button typy="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Sign up here.</span>
                    </div>
                </form>

                <form action="register.php" method="POST" class="signupForm">
                    <h2>Create a free account!</h2>
                    <p>
                        <?php echo $account->getError(Constants::$userNameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php getInputValue('username'); ?>" placeholder="e.g. bartSimpson" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php getInputValue('firstName'); ?>" placeholder="e.g. Bart" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input type="text" id="lastName" name="lastName" value="<?php getInputValue('lastName'); ?>" placeholder="e.g. Simpson" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php getInputValue('email'); ?>" placeholder="e.g. bart@gmail.com" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNoAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="your password" required>
                    </p>
                    <p>
                        <label for="password2">Password</label>
                        <input type="password" id="password2" name="password2" placeholder="confirm password" required>
                    </p>
                    <button type="submit" name="signupButton">Signup</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already has account? Log in here.</span>
                    </div>
                </form>
            </div>

            <div class="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>