<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Adopt a cat/dog</title>
    <link rel="stylesheet" href="styleproject.css" >

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin >
    <link
      href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;700;900&display=swap"
      rel="stylesheet"
    >
    <!-- JS scripts-->
    <script src="app.js" async></script>
  </head>
  <body>

  <?php
  $filename = 'login.txt';
  $username = 'newuser';
  $password = 'newpass';

  $file = fopen($filename, 'a'); // open the file in 'append' mode
  fwrite($file, "$username:$password\n"); // write the new user info to the file
  fclose($file); // close the file
    ?>
    <!--Header-->
     <?php include("header.php");?>
    <div id="main">
      <?php include("sidemenu.php");?>
      <div id="maincontent">
        <div class="content" id="homecontent">
          <h1>More than a pet.</h1>
          <h1>Say hello to your new companion.</h1>
          <div class="textmessage">
            <p>Get a free visit and discover all our wonderful animals</p>
            <div>
              <p>
                In this page you can browse for our selection of pets, discover
                a wide variety of animals waiting to meet you. If you are
                looking for a specific breed you can go to our Find section .You
                can also find information on dog and cat care in their
                respective sections. At the moment we are open for recieving new
                pets by filling out the form in the give away section. Finally,
                feel free to contact us for any inquiries.
              </p>
              <p>
                Your privacy is important to us, to find out why, follow the
                link at the bottom of the page
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php include("footer.php");?>
  </body>
</html>
