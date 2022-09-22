<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link rel="stylesheet" href="<?= url("assets/web/css/style-home.css") ?>">
  <link rel="icon" href="<?= url("assets/web/images/img/logos/4.png") ?>">
  <title>Peres Imóveis</title>
</head>
<body>
  <nav>
    <div class="menu-links">
      <a href="<?= url("anunciar")?>"> Anunciar </a>
    </div>

    <div class="menu-links">
      <a href="<?= url("imoveis")?>"> Imóveis </a>
    </div>

    <div class="menu-logo">
      <a href="<?= url()?>">
        <img src="<?= url("assets/web/images/img/logos/6.png") ?>" alt="logo">
      </a>
    </div>

    <div class="menu-links">
      <a href="<?= url("sobre")?>"> Sobre </a>
    </div>
    
    <div class="menu-links">
      <a href="<?= url("login"); ?>"> Entrar </a>
    </div>
  </nav>

  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Filtrar
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
  <?php
  foreach ($categories as $category){
    ?>
    <li>
      <a class="dropdown-item active" href="<?= url("imoveis/{$category->id}"); ?>">                          
      <?= $category->type; ?>
    </a>
  </a>
</li>
    <?php
    }
    ?>
  </ul>
</div>


  <!-- CONTEUDO -->
  <?php echo $this->section("content");?>
  <!-------------->

  
  <footer>
    <div class="footer-logo">
      <img src="<?= url("assets/web/images/img/logos/4.png") ?>" alt="">
    </div>

    <div class="footer-sections">
      <ul> Sobre Nós 
        <li> <span> "Quem somos?" </span> </li>
        <li> <span> <i> - Nós somos uma empresa de negócios imobiliários, aqui você pode encontrar um lugar para ser feliz. Ou, se desfazer de algo que não deseja, vendendo ou alugando. </i>  </span></li>
      </ul>
      
    </div>

    <div class="footer-sections">
      <ul> Contato 
        <li> Fone: 55 51 3658-3658 </li>
        <li> Endereço: Av. José Athanásio, 92 </li>
        <li> Email:peresimoveis@atendimento.com </li>
      </ul>
    </div>

    <div class="footer-sections">
      <ul> Redes Sociais 
        <li> Facebook </li>
        <li> Instagram </li>
        <li> Twitter </li>
      </ul>
    </div>
    
    <div class="footer-sections">
      <ul> CENTRAL
        <li> <a href="#"> FAQ </a> </li>
      </ul>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>
</body>
</html>