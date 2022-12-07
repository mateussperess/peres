<?php
    $this->layout("_theme");
?>

<style>
  .container {
    margin-top: 10rem;
  }
</style>

<div class="container">
<form enctype="multipart/form-data" method="post" id="formProjectRegister">
    <div class="mb-3">
      <label for="title" class="form-label">Título: </label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Título do Imóvel...">
    </div>
    <div class="mb-3">
      <label for="abstract" class="form-label">Preço: </label>
      <input type="text" name="price" class="form-control" id="price" placeholder="Preço do Imóvel...">  
    </div>
    
    <div class="mb-3">
      <label for="formFileMultiple" class="form-label">Imagens do Imóvel: </label>
      <input name="images[]" class="form-control" type="file" id="formFileMultiple" multiple>
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">Categoria do Imóvel: </label>
        <select name="category" class="form-select" aria-label="Default select example">
            <option selected>Selecione a Categoria do Imóvel: </option>
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
      <label for="abstract" class="form-label">Descrição do Imóvel: </label>
      <input type="text" name="description" class="form-control" id="description" placeholder="Descrição do Imóvel...">  
    </div>

    <div class="mb-3">
      <button type="submit" class="btn btn-primary" name="send"> Cadastrar </button>
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