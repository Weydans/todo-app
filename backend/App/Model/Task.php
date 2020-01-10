<?php

namespace App\Model;

use \Exception;
use Core\Classes\Model;

/**
 * Task
 * 
 * Classe de Modelo responsável pela gestão de dados da entidade tarefa
 * @author Weydans Barros
 * Data de criação: 27/12/2019
 */

class Task extends Model
{
    protected $table = 'tarefa';

    public function storeNew(array $new) : bool
    {
        if (filter_var_array($new, FILTER_DEFAULT)) {
            $data = [
                'createdAt' => date('Y-m-d H:i:s'),
                'done'      => 'N'
            ];
            
            $data = array_merge($new, $data);

            $this->validateTask($data);

            $result = $this->insert($data)->save();

            return $result;
        }
        
        throw new Exception('O valor informado é Inválido');
    }


    /**
     * validateTask(array $task)
     * 
     * Valida dados de uma tarefa
     * @param array $task Task
     */
    public function validateTask(array $task)
    {
        $errors = '';
        $valid  = true;

        foreach ($task as $key => $value) {
            if ($key == 'id') {
                if (!is_numeric($value)) {
                    $errors .= 'O campo <b>id</b> deve ser numérico<br>';
                    $valid = false;
                }

            } elseif ($key == 'description') {
                if (empty($value)) {
                    $errors .= 'O campo <b>descrição</b> é obrigatório<br>';
                    $valid = false;
                }
            
            } elseif ($key == 'done') {
                if (!($value == 'S' || $value == 'N')) {
                    $errors .= 'O campo <b>done</b> deve ser preenchido com "S" ou "N"<br>';
                    $valid = false;
                }
            }
        }

        if (!$valid) {
            throw new Exception($errors);
        }

        return $valid;
    }

}