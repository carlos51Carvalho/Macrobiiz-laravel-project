<?php

namespace App\Classes;

    class minhaClasse{

        public static function criarCodigo()
        {
            $valor ='';
            $caracteres = 'abcdefghijklmnopqrstuvxz_ABCDEFGHIJKLMNOPQRSTUVXZ!?%&#';

            for ($i=0; $i < 10; $i++) { 
                $index = rand(0,strlen($caracteres));
                $valor .= substr($caracteres, $index,1);
            }
            return $valor;

        }
    }




?>