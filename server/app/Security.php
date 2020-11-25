<?php

class security{

    function crypt($mensage, $clave)
    {
        $textoEncriptado = '';
        settype($mensage, "string");
        $i = strlen($mensage) - 1;
        $j = strlen($clave);
        if (strlen($mensage) <= 0) {
            return '';
        }
        do {
            $textoEncriptado .= ($mensage{$i} ^ $clave{$i % $j});
        } while ($i--);
        $textoEncriptado = base64_encode(base64_encode(strrev($textoEncriptado)));
        return $textoEncriptado;
    }

    function decrypt($mensaje, $clave)
    {
        $textoPlano = '';
        settype($mensaje, "string");
        $mensaje = base64_decode(base64_decode($mensaje));
        $i = strlen($mensaje) - 1;
        $j = strlen($clave);
        if (strlen($mensaje) <= 0) {
            return '';
        }
        do {
            $textoPlano .= ($mensaje{$i} ^ $clave{$i % $j});
        } while ($i--);
        $textoPlano = strrev($textoPlano);
        return $textoPlano;
    }
}