<link rel="stylesheet" href="<?= url("assets/web/css/style-home.css") ?>">

<?php
//use Source\Models\Category;
$this->layout("_theme",["categories" => $categories]);

// var_dump($_SESSION["user"]["id"]);
?>

<div class="img-banner">
  <!-- <div class="img-banner-filter"></div> -->
  <div class="img-banner-text">
    <span> Um lugar para chamar de lar.</span>
  </div>
  <div class="img-banner-logo"> </div>
</div>



