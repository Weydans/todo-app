<?php

namespace App\Controller;

use \Exception;
use App\Model\Tarefa;

class TarefaController
{
    /** @var Tarefa */
    private $task;
    
    private $response;


    /**
     * __construct()
     * 
     * Inicializa objeto Tarefa e 
     * configura response error default como false
     */
    public function __construct()
    {
        $this->task = new Tarefa();
        $this->response = ['error' => 'false'];
    }


    /**
     * create()
     * 
     * Cadastra nova tarefa no banco de dados
     */
    public function create()
    {
        try {                            
            $result = $this->task->storeNew($_POST);

            if (!$result) {
                $this->response['error'] = 'true';
            }
                
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * all()
     * 
     * Busca todas as tarefas cadastradas no banco
     */
    public function all()
    {
        try {            
            $result = $this->task->select()->orderBy('createdAt', 'DESC')->get();
    
            if (!$result) {
                $this->response['error'] = 'true';
            } else {
                $this->response['tasks'] = $result;
            }
    
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * delete(int $id)
     * 
     * Remove uma tarefa do banco
     * @param int $id Id do registro 
     */
    public function delete(int $id)
    {
        try {    
            $result = $this->task->where('id', $id)->delete();
    
            if (!$result) {
                $this->response['error'] = 'true';
            }
    
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
