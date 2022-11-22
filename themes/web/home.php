<link rel="stylesheet" href="<?= url("assets/web/css/style-home.css") ?>">



<?php
$this->layout("_theme",["categories" => $categories]);
?>

<div class="img-banner">
  <!-- <div class="img-banner-filter"></div> -->
  <div class="img-banner-text">
    <span> Um lugar para chamar de lar.</span>
  </div>
  <div class="img-banner-logo"> </div>
</div>

<div class="title-home">
  <span> Veja algumas de nossas propriedades abaixo</span>
</div>

<div class="section-properties">

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

    <div class="card" style="width: 18rem; height: auto;">
    <img class="card-img-top" src="<?= $propertie->image; ?>" style="height: 15rem;" alt="Card image cap">
      <div class="card-body">
        <p class="card-text">
          <?= 
          $propertie->title;
          ?>
        </p>
        <p class="card-text"> R$:
          <?=
          $propertie->price;
          ?>
        </p>
        <p>
          <?=
          $propertie->description;
          ?>
        </p>
      </div>
    </div>
    <?php
    }
    ?>
</div>


