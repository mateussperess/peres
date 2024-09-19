<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="<?= url("assets/web/css/style-login.css") ?>">
  <link rel="icon" href="<?= url("assets/web/images/img/logos/6.png") ?>">

  <title> Peres Imóveis - Registro </title>
</head>

<body>

  <main>

    <section class="login">

      <form id="form-user" class="wrapper">
        <img src="<?= url("assets/web/images/img/logos/2.png") ?>" class="login__logo">
        <h1 class="login__title">Criar Conta</h1>

        <label class="login__label">
          <span> Nome </span>
          <input type="text" name="first_name" id="first_name" class="input">
        </label>

        <label class="login__label">
          <span> Sobrenome </span>
          <input type="text" name="last_name" id="last_name" class="input">
        </label>

        <label class="login__label">
          <span>Email de usuário</span>
          <input type="email" name="mail" id="mail" class="input">
        </label>

        <label class="login__label">
          <span>Senha</span>
          <input type="password" name="password" id="password" class="input">
        </label>

        <label class="login__label">
          <span>Confirmar Senha</span>
          <input type="password" name="confirm_password" id="confirm_password" class="input">
        </label>

        <button class="login__button" type="submit" disabled>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M438.6 278.6l-160 160C272.4 444.9 264.2 448 256 448s-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L338.8 288H32C14.33 288 .0016 273.7 .0016 256S14.33 224 32 224h306.8l-105.4-105.4c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160C451.1 245.9 451.1 266.1 438.6 278.6z" />
          </svg>
        </button>

        <div id="message"></div>

        <a href="<?= url("login") ?> " class="login__link">Já tem uma conta? Fazer login</a>
      </form>
    </section>

    <section class="wallpaper">
      <img src="<?= url("assets/web/images/img/jason-dent-w3eFhqXjkZE-unsplash.jpg") ?>" alt="wallpaper">
    </section>
  </main>

  <!-- 
    Javascript for User Registration
   -->

  <script type="text/javascript" async>
    const inputs = document.querySelectorAll('.input');
    const button = document.querySelector('.login__button');
    const handleFocus = ({
      target
    }) => {
      const span = target.previousElementSibling;
      span.classList.add('span-active');
    }
    const handleFocusOut = ({
      target
    }) => {
      if (target.value === '') {
        const span = target.previousElementSibling;
        span.classList.remove('span-active');
      }
    }
    const handleChange = () => {
      const [firstName, lastName, email, password, confirmPassword] = inputs;
      if (firstName.value && lastName.value && email.value && password.value.length > 6 && password.value === confirmPassword.value) {
        button.removeAttribute('disabled');
      } else {
        button.setAttribute('disabled', '');
      }
    }

    inputs.forEach((input) => input.addEventListener('focus', handleFocus));
    inputs.forEach((input) => input.addEventListener('focusout', handleFocusOut));
    inputs.forEach((input) => input.addEventListener('input', handleChange));

    // sending data
    const form = document.querySelector("#form-user");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const dataUser = new FormData(form);
      let response;
      console.log("URL de registro:", "<?= url('cadastrar'); ?>");

      try {
        response = await fetch("<?= url('cadastrar'); ?>", {
          method: "POST",
          body: dataUser,
        });

        if (!response.ok) {
          throw new Error('Erro na resposta do servidor');
        }

        const user = await response.json();
        console.log(user);

        if (user) {
          if (user.type === "success") {
            window.location.href = "<?= url('login'); ?>";
          } else {
            message.innerHTML = user.message;
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${user.type}`);
          }
        }
      } catch (error) {
        console.error('Erro:', error);
        message.innerHTML = 'Ocorreu um erro ao processar a solicitação. Tente novamente mais tarde.';
        message.classList.add('error');
      }
    });
  </script>
</body>

</html>