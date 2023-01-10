<?php
//var_dump($properties);
//var_dump($categories);
$this->layout("_theme",["properties" => $properties, "categories" => $categories]);
?>

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