<?php include("../Scripts/validateUser.php") ?>

<!DOCTYPE html>
<html lang="en">

<?php include("./Utility/headHTML.php"); ?>


<body>
  <!--Header-->
  <?php include("./Utility/header.php"); ?>

  <div id="main">
    <?php include("./Utility/sidemenu.php"); ?>

    <div id="maincontent" class="find">
      <div class="content" id="findcontent">
        <h1>Have an animal to give away?</h1>
        <p style="margin-left: 20px">
          Simply fill the form below with the information of your animal
        </p>

        <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_name'] == 'loginForm') { //Runs if this is the form to login
          $username = $_POST['username'];
          $password = $_POST['password'];

          // assume the user is authenticated if the username and password are correct
          $valid = verifyUsernameAndPass($username, $password);
          if ($valid) {
            $_SESSION['loggedin'] = true;
            header('Location: ' . $_SERVER['REQUEST_URI']); // This resets the page such that  the php code reloads and the new form appears
            exit;
          } else {
            $error = 'Invalid username or password';
            echo $error;
          }
        }

        $formGiveAway = <<<EOD
        <form action="" method="post" class ="greenform" id="logoutForm">
        <input type="Submit"  value="Logout" name="logout" class = "logout" onclick ="logoutFunction()">
        </form>
<form  method="POST" action=giveaway.php onsubmit=" verifyGiveaway()" >
          <input type="hidden" name="validated" value="false">
          <input type="hidden" name="form_name" value="giveAwayForm">


          <div class="greenform"
            style="padding-bottom: 20px; padding-top: 20px">
            <div>
              <label for="animalName">Animal Name:</label>
              <input type="text" name="animalName" id="animalName" >
            </div>
            <table>
              <tr>
                <td>Animal:</td>
                <td>
                  <input type="radio" id="cat" name="animal" value ="cat">
                  <label for="cat">Cat</label><br >
                </td>
                <td>
                  <input type="radio" id="dog" name="animal" value ="dog">
                  <label for="dog">Dog</label><br >
                </td>
              </tr>
            </table>

            <div>
              <label for="breed">Breed</label>
              <input type="text" name="breed" id="breed" >
              <label for="mixedBreed"> Mixed Breed</label>
              <input type="checkbox" name="mixedBreed" id="mixedBreed" >

            </div>

            <div>
              <div>
                <label for="age">Please select age category</label>
                <select name="age" id="age">
                  <option value="0-1 year old">0-1 year</option>
                  <option value="1-3 years old">1-3 years</option>
                  <option value="3-6 years old">3-6 years</option>
                  <option value="6-9 years old">6-9 years</option>
                  <option value="9+ years old">9+ years</option>
                </select>
              </div>
            </div>

            <div>
              <table>
                <tr>
                  <td>Gender:</td>
                  <td>
                    <input type="radio" id="female" name="gender" value="female" >
                    <label for="female">Female</label><br >
                  </td>
                  <td>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label><br >
                  </td>
                </tr>
              </table>
            </div>

            <div>
              <label for="dogfriendly"> Dog friendly</label>
              <input type="checkbox" name="dogfriendly" id="dogfriendly"  >
            </div>
            <div>
              <label for="catfriendly"> Cat friendly</label>
              <input type="checkbox" name="catfriendly" id="catfriendly" >
            </div>
            <div>
              <label for="children"> Suitable for Children</label>
              <input type="checkbox" name="children" id="children" >
            </div>

            <div>
              <label for="comments">Comments:</label>
              <textarea
                id="comments"
                name="comments"
                rows="4"
                cols="30"
              ></textarea>
            </div>
</div>
          

          <div style="margin-left: 20px">
            <p style="font-size: larger">Owner information</p>
          </div>

          <div  class="greenform"
            style="padding-top: 10px; padding-bottom: 20px">
            <div>
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" >
          </div>

            <div>
              <label for="lastname">Last Name:</label>
              <input type="text" name="lastname" id="lastname" >
            </div>

            <div>
              <label for="owneremail">Email:</label>
              <input type="email" name="owneremail" id="owneremail" >
            </div>

            <div style="margin-bottom: 20px">
              <input type="submit" value="Submit" >
              <input type="submit" value="Clear" >
            </div>
            </div>
          </form>
EOD;

        $formLogin = <<<EOD
    <form method="POST" action="giveaway.php" >
    <input type="hidden" name="form_name" value="loginForm">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
    EOD;

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          $form = $formGiveAway;
        } else {
          // user is not logged in, display the login form
          $form = $formLogin;
        }
        echo $form;

        if (isset($_POST['logout'])) {
          unset($_SESSION['loggedin']);
          header('Location: ' . $_SERVER['PHP_SELF']);
          exit;
        }
        ?>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_name'] == 'giveAwayForm') { //Runs if this is the giveaway form
          $validatedForm = $_POST["validated"];
          if ($validatedForm == "true") { //Only runs if form was validated
            $animal = $_POST["animal"];
            $animalName = $_POST["animalName"];
            $breed = $_POST["breed"];
            $mixedBreed = $_POST["mixedBreed"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $dogFriendly = $_POST["dogfriendly"];
            $catFriendly = $_POST["catfriendly"];
            $childrenFriendly = $_POST["children"];
            $comments = $_POST["comments"];
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $email = $_POST["owneremail"];

            $counter = 0;
            if (file_exists('../TextFiles/AvailablePetInfo.txt')) { //Checks if there are any pets created yet
              $AvailablePet = fopen("../TextFiles/AvailablePetInfo.txt", "r");
              while (($line = fgets($AvailablePet)) !== false) {
                $counter++; //Counts number of lines
              }
              fclose($AvailablePet);
            }

            $AvailablePet = fopen("../TextFiles/AvailablePetInfo.txt", "a");
            if ($AvailablePet === false) {
              echo "Failed to open file";
            }
            fwrite($AvailablePet,  $counter . ":" . $firstName . ":" . $lastName . ":" . $animalName . ":" . $animal . ":" .
              $breed . ":" . $mixedBreed . ":" . $age . ":" . $gender . ":" . $dogFriendly . ":" . $catFriendly . ":" . $childrenFriendly . ":" .
              $comments . ":" . $email .
              "\n");
            fclose($AvailablePet);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
          }
        } ?>

      </div>
    </div>
  </div>

  <?php include("./Utility/footer.php"); ?>

</body>

</html>