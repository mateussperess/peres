<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");
//$route = new Router('localhost/acme-tarde', ":"); // Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->get("/sobre","Web:about");
$route->get("/imoveis", "Web:properties");
$route->get("/anunciar", "Web:anunciar");

//$route->get("/projeto","Web:project");
// $route->get("/contato","Web:contact");
// $route->post("/contato","Web:contact");

$route->get("/cadastrar","Web:register");
$route->post("/cadastrar","Web:register");

$route->get("/login","Web:login");
$route->post("/login","Web:login");


// 
$route->get("/imoveis/{idCategory}","Web:properties");

/**
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/listar","App:list");
$route->get("/pdf","App:createPDF");
$route->group(null); // desagrupo do /app

$route->group("/admin"); // agrupa em /admin
$route->get("/","Adm:home");
$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();