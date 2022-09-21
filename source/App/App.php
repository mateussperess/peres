<?php

namespace Source\App;

class App
{
    public function home () : void 
    {
        require __DIR__ . "/../../themes/app/home.php";
    }

    public function list () : void 
    {
        require __DIR__ . "/../../themes/app/list.php";
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }
}

?>