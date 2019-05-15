<?php
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            $pw = md5($pw);

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

            if(mysqli_num_rows($query) == 1) {
                return true;
            }
            else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($un, $fn, $ln, $em, $pw, $pw2) {
            $this->validateUsername($un);
            $this->validateFirstname($fn);
            $this->validateLastname($ln);
            $this->validateEmail($em);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray) == true) {
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
            else{
                return false;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPW = md5($pw);
            $profilePic = "assets/images/profile_pics/img.jpeg";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPW', '$date', 'profilePic')");

            return $result;
        }

        private function validateUsername($un){
            if(strlen($un) > 18 || strlen($un) < 5){
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;
            }

            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) !=0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        private function validateFirstname($fn){
            if(strlen($fn) > 18 || strlen($fn) < 2){
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }
        private function validateLastname($ln){
            if(strlen($ln) > 18 || strlen($ln) < 2){
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }
        private function validateEmail($em){
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) !=0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }
        private function validatePasswords($pw, $pw2){
            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNoAlphanumeric);
                return;
            }

            if(strlen($pw) > 20 || strlen($pw) < 6){
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }
    }
?>