<?php
//var_dump($properties);
//var_dump($categories);
$this->layout("_theme",["properties" => $properties, "categories" => $categories]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  foreach ($properties as $propertie)
  {
  ?>
  <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $propertie->image; ?>" alt="Card image cap">
      <div class="card-body">
        <p class="card-text">
          <?=$propertie->title;?>
        </p>
      </div>
    </div>
    <?php
    }
    ?>
</body>
</html>