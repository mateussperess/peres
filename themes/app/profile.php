<?php

use Source\Models\User;

$this->layout("_theme");

?>

<link rel="stylesheet" href="<?= url("assets/app/css/style-perfil.css") ?>">

<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center">Atualizar Perfil</h2>
        <form enctype="multipart/form-data" method="post" id="formProfile" class="p-4 border rounded shadow">

          <div class="mb-3">
            <label for="first_name" class="form-label">Nome:</label>
            <input type="text" name="first_name" class="form-control" id="first_name" value="<?= $user->getFirstName(); ?>" placeholder="Seu Nome..." required>
          </div>

          <div class="mb-3">
            <label for="last_name" class="form-label">Sobrenome:</label>
            <input type="text" name="last_name" class="form-control" id="last_name" value="<?= $user->getLastName(); ?>" placeholder="Seu Sobrenome..." required>
          </div>

          <div class="mb-3">
            <label for="mail" class="form-label">Email:</label>
            <input type="email" name="mail" class="form-control" id="mail" value="<?= $user->getMail(); ?>" placeholder="name@example.com" required>
          </div>

          <div class="mb-3">
            <label for="profile_photo" class="form-label">Sua Foto: </label>
            <input class="form-control" type="file" name="profile_photo" id="profile_photo">
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Alterar</button>
          </div>

          <div style="
              width: 20rem;
              height: 20rem;
              object-fit: cover;
              border-radius: 20rem;
            ">
            <img src="<?= url($user->getProfilePhoto() ?: "assets/app/images/user-photo-null.jpg"); ?>" id="photoShow" alt="Foto de Perfil" style="width: 100%">
          </div>

          <div id="message" class="alert" style="display: none;"></div>

        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" async>
  const form = document.querySelector("#formProfile");
  const message = document.querySelector("#message");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const newUser = new FormData(form);

    const data = await fetch("<?= url('app/profile'); ?>", {
      method: "POST",
      body: newUser,
    });

    const response = await data.json();
    console.log(response);

    // Atualiza o elemento de mensagem com base na resposta
    message.textContent = response.message;
    message.className = "alert"; // Limpa classes anteriores e aplica a classe base
    message.classList.add(response.type); // Adiciona a classe de tipo (alert-success ou alert-danger)

    // Exibe a mensagem
    message.style.display = "block";


    if (response.profile_photo) {
      document.getElementById("photoShow").src = response.profile_photo;
    }
    // Oculta a mensagem após 5 segundos
    setTimeout(() => {
      message.style.display = "none";
    }, 5000);
  });
</script>