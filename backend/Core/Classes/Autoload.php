<?php

namespace Core\Classes;

/**
 * Autoload
 * 
 * Responsável pelo carregamento de classes do sistema
 * @author Weydans Barros
 * Data de criação 29/12/2019
 */

abstract class Autoload
{
    public static function run() 
    {
        spl_autoload_register(function($class){

            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $res = false;
            
            if (file_exists($file) && !is_dir($file)) {
                require_once $file;
                $res = $file;
            }

            if (!$res) {
                echo "<b>Não foi possível incluir:</b> {$file}";
            }
        });
    }
}
