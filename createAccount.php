
<?php include("./scripts/validateUser.php");?> <!--Brings methods like validateUser and userExists-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styleproject.css">

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <!-- JS scripts-->
    <script src="app.js" async></script>
</head>

<body>
    <!--Header-->
    <?php include("header.php"); ?>
    <div id="main">
        <?php include("sidemenu.php"); ?>
        <div id="maincontent" class="maincreate">
            <div class="content" id="homecontent">

                <div style="margin-left:20px;">
                    <h1>Create Account</h1>
                    <form method="POST">
                        <label>Username:</label>
                        <input type="text" name="username"><br>
                        <label>Password:</label>
                        <input type="password" name="password"><br>
                        <p>Username can only contain letters and digits.
                            <br>
                            Password must be at least 4 characters long
                            <br>
                            and contain at least one letter and one digit.
                        </p>
                        <input type="submit" value="Create Account">
                    </form>
                </div>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"]; //Get forms username and password
                    $password = $_POST["password"];

                    $validMessage = validateUser($username, $password);
                    if ($validMessage===true) { //If validate is true
                        if (usernameExists($username)) {
                            $message = "Username already exists"; //If username already exists
                        } else {
                            $login_file = fopen("loginFile.txt", "a");
                            fwrite($login_file,  $username . ":" . $password . "\n");
                            fclose($login_file);
                            $message = "Account created successfully. You can now log in.";
                        }
                    }
                    else if($validMessage !==true) {
                        $message = $validMessage;//set message to whatever the error was
                    } 
                }               
                ?>
                <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>