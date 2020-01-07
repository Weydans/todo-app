<?php

namespace App\Model;

use Exception;
use Core\Classes\Model;

/**
 * Tarefa
 * 
 * Classe de Modelo responsável pela gestão de dados da entidade tarefa
 * @author Weydans Barros
 * Data de criação: 27/12/2019
 */

class Tarefa extends Model
{
    protected $table = 'tarefa';

    public function storeNew(array $new) : bool
    {
        if (filter_var_array($new, FILTER_DEFAULT)) {
            $data = [
                'createdAt' => date('Y-m-d H:i:s'),
                'done'      => 'N'
            ];
            
            $data   = array_merge($new, $data);
            $result = $this->insert($data)->save();

            return $result;
        }
        
        throw new Exception('O valor informado é Inválido');
    }
}