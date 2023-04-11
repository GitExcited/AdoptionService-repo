<?php
function validateUser($username, $password)
{
    if (empty($username) || empty($password)) {
        return "Username and password are required.";
    }
    if (!ctype_alnum($username)) {
        return "Username can only contain letters and digits.";
    }
    if (!ctype_alnum($password)) {
        return "Password can only contain letters and digits.";
    }
    if (strlen($password) < 4) {
        return "Password must be at least 4 characters long.";
    }
    if (!preg_match('/\d/', $password) || !preg_match('/[A-Za-z]/', $password)) {
        return "Password must contain at least one letter and one digit.";
    }
    return true;
}

function usernameExists($username)
{
    if (!file_exists('../TextFiles/loginFile.txt')) {//Checks if this is the first username
        return false;
    }
    $login_file = fopen("../TextFiles/loginFile.txt", "r");
    while (($line = fgets($login_file)) !== false) {
        $user_info = explode(":", $line);
        if ($user_info[0] == $username) {
            fclose($login_file);
            return true;
        }
    }
    fclose($login_file);
    return false;
}

function verifyUsernameAndPass($username,$password){
    if (!file_exists('../TextFiles/loginFile.txt')) {//Checks if there are any users created yet
        return false;
    }
    $login_file = fopen("../TextFiles/loginFile.txt", "r");
    while (($line = fgets($login_file)) !== false) {
        $user_info = explode(":", trim($line));
        if ($user_info[0] == $username && $user_info[1]==$password) {
            fclose($login_file);
            return true;
        }
    }
    fclose($login_file);
    return false;
}

function debug_to_console($data) { // Utility debugging function 
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>