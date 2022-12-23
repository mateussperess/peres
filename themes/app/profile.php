<?php

    use Source\Models\User;

    $this->layout("_theme");
?>

<link rel="stylesheet" href="<?= url("assets/app/css/style-perfil.css") ?>">

<!--<div class="container">-->
<!--<form enctype="multipart/form-data" method="post" id="formProfile">-->
<!--    <div class="mb-3">-->
<!--        <label for="name" class="form-label">Nome: </label>-->
<!--        <input type="text" name="name" class="form-control" id="name" value="--><?//=$user["name"];?><!--" placeholder="Seu Nome...">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="email" class="form-label">Email: </label>-->
<!--        <input type="email" name="email" class="form-control" id="email" value="--><?//=$user["email"];?><!--" placeholder="name@example.com">-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--        <label for="photo" class="form-label">Sua Foto: </label>-->
<!--        <input class="form-control" type="file" name="photo" id="photo">-->
<!--    </div> -->
<!--    <div class="mb-3">-->
<!--    <button type="submit" class="btn btn-primary" name="send">Alterar</button>-->
<!--    </div>-->
<!--    <div class="alert alert-primary" role="alert" id="message">-->
<!--        Mensagem de Retorno!-->
<!--    </div>-->
<!--    <div class="mb-3">-->
<!--    --><?php
//    var_dump($user);
//    ?>
<!--    </div>-->
<!--</form>-->
<!--</div>-->

<div class="container">
    <form enctype="multipart/form-data" method="post" id="formProfile">
        <div class="mb-3">
            <label for="name" class="form-label">Nome: </label>
            <input type="text" name="name" class="form-control" id="name" value="<?=$user["name"];?>" placeholder="Seu Nome...">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" class="form-control" id="email" value="<?=$user["email"];?>" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Sua Foto: </label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>

        <div style="
        width: 20rem;
        height: 20rem;
        object-fit: cover;
        border-radius: 20rem;
        ">
          <?php
          if(!empty($user["photo"])):
            ?>
              <img src="<?= url($user["photo"]); ?>" id="photoShow" alt="..." style="width: 100%">
          <?php
          else:
            ?>
              <img src="<?= url("assets/app/images/user-photo-null.jpg"); ?>"  id="photoShow" alt="..." style="width: 100%">
          <?php
          endif;
          ?>
        </div>

        <div class="alert alert-primary" style="display: none" role="alert" id="message">
            Mensagem de Retorno!
        </div>
    </form>
</div>

<script type="text/javascript" async>
    const form = document.querySelector("#formProfile");
    const message = document.querySelector("#message");
    // const photoShow = document.querySelector("#photoShow");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/profile"); ?>", {
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        if(user) {
            message.setAttribute("style","display");
            message.textContent = user.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${user.type}`);
            setTimeout(() => {
                message.setAttribute("style","display: none");
            },3000);
        }
    });
</script>