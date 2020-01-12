<?php

namespace App\Controller;

use \Exception;
use App\Model\Task;

class TaskController
{
    /** @var Task $task */
    private $task;
    
    private $response;


    /**
     * __construct()
     * 
     * Inicializa objeto Task e 
     * configura response error default como false
     */
    public function __construct()
    {
        $this->task = new Task();
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
                throw new Exception('Erro ao cadastrar tarefa.');
            }
                
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            $this->response['error'] = 'true';
            $this->response['message'] = $e->getMessage();

            echo json_encode($this->response);
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
            $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
            
            if (!empty($search)) {
                $result = $this->task->select()
                                    ->where('description', 'LIKE', '%' . $search . '%')
                                    ->orderBy('createdAt', 'DESC')
                                    ->get();

            } else {
                $result = $this->task->select()->orderBy('createdAt', 'DESC')->get();
            }
    
            if (!$result) {
                $this->response['error'] = 'true';
            } else {
                $this->response['tasks'] = $result;
            }
    
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            $this->response['error']   = 'true';
            $this->response['message'] = $e->getMessage();
            
            echo json_encode($this->response);
        }
    }


    /**
     * update(int $id)
     * 
     * @param int $id Id do registro a ser atualizado
     */
    public function update(string $id)
    {
        try {
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (is_numeric($id) && $this->task->validateTask($data)) {
                $result = $this->task->update($data)->where('id', $id)->save();

                if (!$result) {
                    throw new Exception('Erro ao atualizar tarefa.');
                }       
            }

            echo json_encode($this->response);

        } catch (Exception $e) {
            $this->response['error']   = 'true';
            $this->response['message'] = $e->getMessage();
            
            echo json_encode($this->response);
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
                throw new Exception('Erro ao remover tarefa.');
            }
    
            echo json_encode($this->response);
    
        } catch (Exception $e) {
            $this->response['error']   = 'true';
            $this->response['message'] = $e->getMessage();
            
            echo json_encode($this->response);
        }
    }
}
