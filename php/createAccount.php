
<?php include("../Scripts/validateUser.php");?> <!--Brings methods like validateUser and userExists-->
<!DOCTYPE html>
<html lang="en">
<?php include("./Utility/headHTML.php");?>

<body>
    <!--Header-->
    <?php include("./Utility/header.php"); ?>
    <div id="main">
        <?php include("./Utility/sidemenu.php"); ?>
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
                            $login_file = fopen("../TextFiles/loginFile.txt", "a");
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

    <?php include("./Utility/footer.php"); ?>
</body>

</html>