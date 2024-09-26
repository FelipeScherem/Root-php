<?php

namespace App\Util;

class UtilErros {

    // Faz a tratativa e retorna um json
    public static function ErroSQL(array $array) {
        $data = array(
            "SQLSTATE" => $array[0],
            "Código do erro" => $array[1],
            "Mensagem de erro" => $array[2],
        );

        // Converte o array para JSON e retorna
        return json_encode($data);
    }
}