<?php

namespace App;

class Document
{
    public function open()
    {
        var_dump("El documento esta abierto");
    }

    public function close()
    {
        var_dump("El documento se ha cerrado");
    }

    public function save()
    {
        var_dump("El documento se ha guardado");
    }
}
