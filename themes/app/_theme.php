<?php
use League\Plates\Engine;
use Source\Models\Category;
use Source\Models\Propertie;
//use Source\Models\User;
//?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Peres Imóveis </title>

    <link rel="stylesheet" href="<?= url("assets/web/css/style-home.css") ?>">

    <link rel="shortcut icon" href="<?= url("assets/web/images/img/logos/4.png") ?>" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar bg-light fixed-top">
      <div class="container-fluid">
        <img src="<?= url("assets\web")?> \images\img\logos\6.png" alt="">
        <a class="navbar-brand" href="<?= url("app")?>">Peres Imóveis</a>
        <button id="btn-menu" class="navbar-toggler position-absolute bottom-15 end-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body" id="menu-nav">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" id="menu-nav-list">
              <li class="nav-item" id="nav-list-item">
                <a href="<?= url("app/profile/{id}"); ?>" > Minha Conta </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= url("app"); ?>"> Home </a>
              </li>
              <li class="nav-item">
                <a href="<?= url("sobre")?>" style="color: black; text-decoration: none;"> Sobre </a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                  Filtrar
                </a>

                  <ul class="dropdown-menu">
                    <?php
                    //                var_dump($categories);
                    foreach ($categories as $category){
                      ?>
                        <li>
                            <a class="dropdown-item active" href="<?= url("imoveis/{$category->id}"); ?>" style="color:black; background-color: white; text-decoration: none;">
                              <?= $category->type; ?>
                            </a>
                            </a>
                        </li>
                      <?php
                    }
                    ?>
                  </ul>

              <li class="nav-item">
                <a href="<?= url("app/anunciado")?>" style="color: black; text-decoration: none;"> Anuncie aqui! </a>
              </li>

              <li class="nav-item">
                <a href="<?= url("app/sair")?>" style="color: black; text-decoration: none;"> Sair </a>
              </li>

<!--              <form class="d-flex mt-3" role="search">-->
<!--                <input class="form-control me-2" type="search" placeholder="Digite aqui..." aria-label="Search">-->
<!--                <button class="btn btn-outline-success" type="submit"> Pesquisar </button>-->
<!--              </form>-->
          </div>
        </div>
      </div>
    </nav>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  
    <!-- CONTEUDO -->
    <?php echo $this->section("content");?>
    <!-------------->

  </body>
</html>