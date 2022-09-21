<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- <link rel="stylesheet" href="../../assets/web/css/style-login.css"> -->
  
  <link rel="stylesheet" href="<?= url("assets/web/css/style-login.css") ?>">
  <link rel="icon" href="<?= url("assets/web/images/img/logos/6.png") ?>">
  <!-- <script src=" url("assets/web/scripts/script-login.js")?>" defer> </script> -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->

  <title> Peres Imóveis </title>
</head>
<body>

  <main>
    
    <section class="login">

      <form id="form-user" class="wrapper">
        <img src="<?= url("assets/web/images/img/logos/2.png")?>" class="login__logo">
        <h1 class="login__title">Fazer login</h1>
        
        <label class="login__label">
          <span>email de usuario</span>
          <input type="text" name="email" id="email" value="" class="input">
        </label>

        <label class="login__label">
          <span>senha</span>
          <input type="password" name="password" id="password" class="input">
        </label>
        <label class="login__label--checkbox">
          <!-- <input type="checkbox" class="input--checkbox">
          Manter login -->
        </label>
        <div class="wrapper">

        <button class="login__button" type="submit" disabled> 
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z"/>
          </svg>
        </button>

        <div id="message">
          
        </div>
  
        <a href="#" class="login__link">não consegue iniciar sessão?</a>
        <a href="cadastrar" class="login__link">criar conta</a>
      </div>
      </form> 
    </section>

    <section class="wallpaper">
      <img src="<?= url("assets/web/images/img/jason-dent-w3eFhqXjkZE-unsplash.jpg") ?>" alt="wallpaper">
    </section>
  </main>

  <!-- 
    Javascript for Login User
   -->

   <script type="text/javascript" async>
   const inputs = document.querySelectorAll('.input');
   const button = document.querySelector('.login__button');
   const handleFocus = ({ target }) => {
    const span = target.previousElementSibling;
    span.classList.add('span-active');
  }
  const handleFocusOut = ({ target }) => {
    if (target.value === '') {
      const span = target.previousElementSibling;
      span.classList.remove('span-active');
    }
  }
  const handleChange = () => {
    const [username, password] = inputs;
    if (username.value && password.value.length >= 2) {
      button.removeAttribute('disabled');
    } else {
      button.setAttribute('disabled', '');
    }
  }
  inputs.forEach((input) => input.addEventListener('focus', handleFocus));
  inputs.forEach((input) => input.addEventListener('focusout', handleFocusOut));
  inputs.forEach((input) => input.addEventListener('input', handleChange));
  const form = document.querySelector("#form-user");
  const message = document.querySelector("#message");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dataUser = new FormData(form);
    const data = await fetch("<?= url("login"); ?>",{
      method: "POST",
      body: dataUser,
    });
    const user = await data.json();
    console.log(user);
  });
  </script>
  </body>
  </html>