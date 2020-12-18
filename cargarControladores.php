<?php

    function cargarControladores ($classname) {
        include 'controllers/'.$classname.'.php';
    }


    spl_autoload_register('cargarControladores');