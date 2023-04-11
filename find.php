
<?php include("./Scripts/validateUser.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopt a cat/dog</title>
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

    <div id="maincontent" class="find">
      <div class="content" id="findcontent">
        <h1>Find a dog or cat</h1>
        <p style="margin-left: 20px">
          Simply fill the form below to display the perfect animal for you
        </p>
        <?php 
        
        $formFind = <<<EOD
    <form method="POST" class="greenform" onsubmit="verifyFind()" action="find.php" >
          <input type="hidden" name="validated" value="false">
          <input type="hidden" name="form_name" value="findForm">

    <table>
          <tr>
            <td>Animal:</td>
            <td>
              <input type="radio" id="cat" name="animal" value="cat">
              <label for="cat">Cat</label><br>
            </td>
            <td>
              <input type="radio" id="dog" name="animal" value="dog">
              <label for="dog">Dog</label><br>
            </td>
          </tr>
        </table>

        <div>
          <label for="breed">Breed</label>
          <input type="text" name="breed" id="breed">
          <label for="breedDoesntMatter"> Doesn't Matter</label>
          <input type="checkbox" name="breedMatter" id="breedDoesntMatter">
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
            <label for="ageDoesntMatter"> Doesn't Matter</label>
            <input type="checkbox" name="ageMatter" id="ageDoesntMatter">
          </div>
        </div>

        <div>
          <table>
            <tr>
              <td>Gender:</td>
              <td>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label><br>
              </td>
              <td>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label><br>
              </td>
              <td>
                <label for="genderDoesntMatter"> Doesn't Matter</label>
                <input type="checkbox" name="genderMatter" id="genderDoesntMatter">
              </td>
            </tr>
          </table>

        </div>

        <div>
          <label for="dogfriendly"> Dog friendly</label>
          <input type="checkbox" name="dogfriendly" id="dogfriendly">
        </div>
        <div>
          <label for="catfriendly"> Cat friendly</label>
          <input type="checkbox" name="catfriendly" id="catfriendly">
        </div>
        <div>
          <label for="children"> Suitable for Children</label>
          <input type="checkbox" name="children" id="children">
        </div>

        <div style="margin-bottom: 20px">
          <input type="submit" value="Submit">
        </div>
    </form>
    EOD;
     
        echo($formFind);

        //Check The available pets
        $finding; 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_name']=='findForm') {
          $validatedForm = $_POST["validated"];
          if($validatedForm =="true"){
            $animal = $_POST["animal"];
            $breed = $_POST["breed"];
            $breedMatter = $_POST["breedMatter"];
            $age = $_POST["age"];
            $ageMatter = $_POST["ageMatter"];
            $gender = $_POST["gender"];
            $genderMatter = $_POST["genderMatter"];
            $dogfriendly = $_POST["dogfriendly"];
            $catfriendly = $_POST["catfriendly"];
            $childrenfriendly = $_POST["children"];

            $finding = $animal.":".$breed.":".$breedMatter.":".
            $age.":".$gender.":".$genderMatter.":".$dogfriendly.":".
            $catfriendly.":".$childrenfriendly.":".$ageMatter;

          }
        }
       
        $validPetsArray = array();
        if (file_exists('AvailablePetInfo.txt')) {//Checks if there are any pets created yet
          $AvailablePet = fopen("AvailablePetInfo.txt", "r");
          while (($line = fgets($AvailablePet)) !== false) {
            $pet_info = explode(":", $line);
            $find_info = explode(":",$finding);
            $validPet = true;

            $NAME = $pet_info[3];
            $BREED= $pet_info[5];
            $TYPE = $pet_info[4];//Dog or Cat
            $AGE = $pet_info[7];
            $GENDER = $pet_info[8];
            $DOGFRIENDLY = ($pet_info[9] == "on")? "Yes":"No";
            $CATFRIENDLY = ($pet_info[10] == "on")? "Yes":"No";
            $CHILDRENFRIENDLY = ($pet_info[11] == "on")? "Yes":"No";
            $COMMENTS = $pet_info[12];

            //****CHECKING IF PET IS VALID ******/
            if ($TYPE != $find_info[0]) $validPet = false;
            if ($BREED != $find_info[1] && $find_info[2] =="") $validPet = false;
            if ($AGE != $find_info[3] && $find_info[9]=="") $validPet = false;
            if ($GENDER != $find_info[4] && $find_info[5]=="") $validPet = false;
            if ($DOGFRIENDLY =="No" && $find_info[6]=="on") $validPet = false;
            if ($CATFRIENDLY =="No" && $find_info[7]=="on") $validPet = false;
            if ($CHILDRENFRIENDLY =="No" && $find_info[8]=="on") $validPet = false;

            

            if($validPet==true){ //Creates a validPet box
              if($pet_info[6]=="on"){ //If Mixed breed was checked
                $BREED = $BREED . " Mixed breed" ;
              }
                $BREED = $BREED ." ". $TYPE;
               $animalDescription = <<<EOD
              <div class="greenform">
              <div class="animalDesc">
                <p>Name: $NAME </p>
                <p>Breed: $BREED </p>
                <p>Age: $AGE</p>
                <p>Gender: $GENDER</p>
                <p>Dog friendly: $DOGFRIENDLY , Cat friendly: $CATFRIENDLY</p>
                <p>Suitable for children: $CHILDRENFRIENDLY</p>
                <p>Comments: $COMMENTS</p>
                <button>Interested</button>
              </div>
              </div>
            EOD;
            echo $animalDescription;
            }

            }
            fclose($AvailablePet);
          }

        ?>
      </div>
    </div>
  </div>

  <?php include ("footer.php");?>

</body>

</html>