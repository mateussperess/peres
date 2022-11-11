<link rel="stylesheet" href="<?= url("assets/app/css/style-home-app.css") ?>">

<?php
  $this->layout("_theme",["categories" => $categories]);
?>

<?php
foreach ($properties as $propertie)
{
  ?>
    <!-- <p>
    <?= $propertie->title; ?>
    </p> -->

    <!-- <p>
    <?= $propertie->price; ?>
    </p> -->

    <!-- <p>
    <?= $propertie->description; ?>
    </p> -->


    <!-- <img src="<?= $propertie->image; ?>" alt=""> -->


    <div class="container-cards">
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $propertie->image; ?>" alt="Card image cap">
      <div class="card-body">
        <p class="card-text"><?= 
        $propertie->title;
        ?>
        </p>
      </div>
    </div>
    </div>

    <?php
    }
?>

<style>
  .container-cards {
    background-color
  }
</style>