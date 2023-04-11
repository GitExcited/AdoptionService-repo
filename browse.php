<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse</title>
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
    <div id="maincontent" style="background-position: top;">
      <div class="content" id="browsecontent">
        <div class="animal">
          <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Siberian_Husky_blue_eyes_Flickr.jpg" alt="">
          </div>
          <div class="greenform">
            <div class="animalDesc">
              <h2>Name: Kara</h2>
              <p>Breed: Dog Husky</p>
              <p>Age: 2 years old</p>
              <p>Gender: Female</p>
              <p>Dog friendly: Yes , Cat friendly: Yes</p>
              <p>Suitable for children: Yes</p>
              <p>Comments: he likes to eat duck treats</p>
              <button>Interested</button>
            </div>
          </div>

        </div>
        <div class="animal">
          <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Kangal_front_on.jpg/692px-Kangal_front_on.jpg?20210613000349" alt="">
          </div>
          <div class="greenform">
            <div class="animalDesc">
              <h2>Name: Mike</h2>
              <p>Breed: Dog Kangal</p>
              <p>Age: 5 years old</p>
              <p>Gender: male</p>
              <p>Dog friendly: Yes , Cat friendly: No</p>
              <p>Suitable for children: Yes</p>
              <p>Comments: Farm dog, requires lots of space </p>
              <button>Interested</button>
            </div>
          </div>

        </div>
        <div class="animal">
          <div>
            <img src="https://s.yimg.com/ny/api/res/1.2/WfAIcTxGIhQZIMOSjLPohw--/YXBwaWQ9aGlnaGxhbmRlcjt3PTY0MDtoPTg1Mw--/https://media.zenfs.com/en/homerun/feed_manager_auto_publish_494/f4130c376e8c1633b900e6006fea8d89" alt="">
          </div>
          <div class="greenform">
            <h2>Name: Pablo</h2>
            <p>Breed: Cat unknown breed</p>
            <p>Age: 12 years old</p>
            <p>Gender: male</p>
            <p>Dog friendly: No , Cat friendly: No</p>
            <p>Suitable for children: No</p>
            <p>Comments: Strange cat </p>
            <button>Interested</button>
          </div>

        </div>

      </div>
    </div>
  </div>

  <?php include ("footer.php");?>

</body>

</html>