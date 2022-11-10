<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="<?= url("assets\web\css\style-register.css") ?>">
  <link rel="icon" href="<?= url("assets/web/images/img/logos/5.png") ?>">

  <title> Cadastre-se em nosso site!</title>
</head>
<body>
  <main>

    <section class="main-box">

      <div class="img-logo">
      <img src="<?= url("assets/web/images/img/logos/3.png")?>" class="login__logo">
      </div>

      <form id="form-user-register" class="box-inputs" novalidate>
        <input type="text" name="name" placeholder="Nome Completo" value="" class="inputs" id="name">

        <!-- <input type="date" placeholder="Data de Nascimento" value="" class="inputs" id="date"> -->

        <input type="email" name="email" placeholder="Email" value="" class="inputs" id="email">

        <input type="password" name="password" placeholder="Crie uma senha" value="" class="inputs" id="passw">

        <div class="btn-confirm">
          <input type="submit" value="Cadastrar">
        </div>

        <div id="message">

        </div>

        <div id="back-to-login">
          <a href="login"> Voltar ao login </a>
        </div>

      </form>

    </section>
  </main>
  <script type="text/javascript" async>
        const form = document.querySelector("#form-user-register"); // id do formulário
        const message = document.querySelector("#message"); // id da div message
        form.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataUser = new FormData(form);
            console.log(dataUser);
            // enviar para a rota já definida
            const data = await fetch("<?= url("cadastrar"); ?>",{
                method: "POST",
                body: dataUser,
            });
            console.log(data);
            const user = await data.json();
                console.log(user);

            // tratamento da mensagem
            
            if(user) {
                message.innerHTML = user.message;
                message.classList.add("message");
                message.classList.add(`${user.type}`);
            }
        });
    </script>
</body>
</html>