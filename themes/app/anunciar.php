<?php
    $this->layout("_theme");
?>
<div class="container">
<form enctype="multipart/form-data" method="post" id="formProjectRegister">
    <div class="mb-3">
        <label for="title" class="form-label">Título do Projeto: </label>
        <input type="text" name="title" class="form-control" id="title" value="Título do Meu Projeto" placeholder="Título do Projeto...">
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">Resumo do Projeto: </label>
        <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="3">Resumo do meu projeto...</textarea>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Texto do Projeto: </label>
        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3">Texto do meu projeto...</textarea>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Categoria do Projeto: </label>
        <select name="category" class="form-select" aria-label="Default select example">
            <option selected>Selecione a Categoria do Projeto...</option>
            <?php
            if(!empty($categoriesList)){
                foreach ($categoriesList as $category){
                    echo "<option value=\"{$category->id}\">{$category->level} - {$category->field}</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="formFileMultiple" class="form-label">Imagens do Projeto:</label>
        <input name="images[]" class="form-control" type="file" id="formFileMultiple" multiple>
    </div>
    <!--<div class="mb-3">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="http://localhost/acme-tarde/storage/temp/imagem01.jpg">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="http://localhost/acme-tarde/storage/temp/imagem02.jpg">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="http://localhost/acme-tarde/storage/temp/imagem03.jpg">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>-->
    <!--<div class="mb-3">
        <label for="photo" class="form-label">Sua Foto: </label>
        <input class="form-control" type="file" name="photo" id="photo">
    </div>-->
    <div class="mb-3">
    <button type="submit" class="btn btn-primary" name="send">Registrar</button>
    </div>
    <div class="alert alert-primary" role="alert" id="message">
        Mensagem de Retorno!
    </div>
</form>
</div>

<script type="text/javascript" async>
    const form = document.querySelector("#formProjectRegister");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataProject = new FormData(form);
        const data = await fetch("<?= url("app/anunciado"); ?>",{
            method: "POST",
            body: dataProject,
        });
        const project = await data.json();
        console.log(project);
        /*if(project) {
            message.textContent = user.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${user.type}`);
        }*/
    });
</script>