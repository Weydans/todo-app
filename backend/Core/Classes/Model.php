<?php

namespace Core\Classes;

use \PDO;
use Core\Classes\Conn;

/**
 * Model
 * 
 * Classe genérica de Modelos do sistema
 * Fornece interfaces comuns para acesso a dados da aplicação
 * @author Weydans Barros
 * Data de criação: 27/12/2019
 */

abstract class Model
{        
    protected $query;
    protected $table;    
    
    private $command;
    private $params;
    private $where = '';
    private $limit;
    private $offset;
    private $orderBy;
    
    /**@var Conn */
    private $conn;

    /**@var Model */
    private $instance = null;


    /**
     * getInstance()
     * 
     * @return Model
     */
    private function getInstance() : Model
    {
        if (empty($this->instance)) {
            $this->instance = $this;
            $this->conn     = Conn::getInstance();
            $this->params   = [];
        }

        return $this->instance;
    }


    /**
     * select(string $columns = null)
     * 
     * @param  string $columns
     * @return Model
     */
    public function select(string $columns = null) : Model
    {   
        $this->getInstance();

        if ($columns) {
            $this->command = 'SELECT ' . $columns . ' FROM ' . $this->table;
        } else {
            $this->command = 'SELECT * FROM ' . $this->table;
        }

        return $this;
    }


    /**
     * insert(array $data)
     * 
     * @param  array $data
     * @return Model
     */
    public function insert(array $data) : Model
    {
        $this->getInstance();

        $columns = $this->getInsertCulumns($data);
        $params  = $this->getInsertParams($data);
        
        $this->command = 'INSERT INTO ' . $this->table . '(' . $columns . ') VALUES(' . $params . ')';

        return $this;
    }


    /**
     * update(array $data)
     * 
     * @param  array $data
     * @return Model
     */
    public function update(array $data) : Model
    {
        $this->getInstance();
        
        if (!empty($this->where)) {

            $params  = $this->getUpdateParams($data);
            
            $this->command = 'UPDATE ' . $this->table . ' SET ' . $params;
        } 
        
        return $this;
    }


    /**
     * delete()
     * 
     * @return Model
     */
    public function delete() : bool
    {        
        if (!empty($this->where)) {
            $this->conn    = Conn::getInstance();
    
            $this->command = 'DELETE FROM ' . $this->table;
    
            $query     = $this->getQuery(); // var_dump($query); die;
            $statement = $this->conn->prepare($query);        
            $result    = $statement->execute($this->params);

        } else {
            $result = false;
        }

        return $result;
    }


    /**
     * where(string $column, string $condition, $value = null)
     * 
     * @param  string $colum
     * @param  string $condition
     * @param  $value 
     * @return Model
     */
    public function where(string $column, string $condition, $value = null) : Model
    {
        if ($value) {
            $this->params[$column] = $value;

            if ($this->where == '') {
                $this->where = ' WHERE ' . $column . ' ' . $condition . ' :' . $column;
            } else {
                $this->where .= ' AND ' . $column . ' ' . $condition . ' :' . $column;
            }
            
        } else {
            $this->params[$column] = $condition;

            if ($this->where == '') {
                $this->where = ' WHERE ' . $column . ' = :' . $column;
            } else {
                $this->where .= ' AND ' . $column . ' = :' . $column;
            }
        }

        return $this;
    }


    /**
     * orderBy(string $column, string $order)
     * 
     * @param  string $colum
     * @param  string $order
     * @return Model
     */
    public function orderBy(string $column, string $order = null) : Model
    {
        if ($order) {
            $this->orderBy = ' ORDER BY ' . $column . ' ' . $order;            
        } else {
            $this->orderBy = ' ORDER BY ' . $column . ' ASC';
        }

        return $this;
    }


    /**
     * get()
     * 
     * @return array
     */
    public function get() : array
    {
        $query     = $this->getQuery(); //var_dump($query); die;
        $statement = $this->conn->prepare($query);
        $statement->execute($this->params);
        $result    = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * first()
     * 
     * @return array
     */
    public function first() : array
    {
        $query     = $this->getQuery(); //var_dump($query); die;
        $statement = $this->conn->prepare($query);
        $statement->execute($this->params);
        $result    = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * save()
     * 
     * @return bool
     */
    public function save() : bool
    {
        $query     = $this->getQuery(); //var_dump($query); die;
        $statement = $this->conn->prepare($query);
        $result    = $statement->execute($this->params);

        return $result;
    }


    /**
     * getQuery()
     * 
     * @return string
     */
    public function getQuery() : string
    {
        $this->query = $this->command . $this->where . $this->orderBy;

        return $this->query;
    }


    /**
     * getInsertCulumns(array $data)
     * 
     * @param  array $data
     * @return string
     */
    private function getInsertCulumns(array $data) : string
    {
        $columns = implode(', ', array_keys($data));

        return $columns;
    }


    /**
     * getInsertParams(array $data)
     * 
     * @param  array $data
     * @return string
     */
    private function getInsertParams(array $data) : string
    {
        $params       = ':' . implode(', :', array_keys($data));
        $this->params = array_merge($this->params, $data);

        return $params;
    }


    /**
     * getUpdateParams(array $data)
     * 
     * @param  array $data
     * @return string
     */
    private function getUpdateParams(array $data) : string
    {
        $params = '';
        $aux    = array_keys($data);

        for ($i = 0; $i < count($aux); $i++) {
            if ($i != count($aux) - 1) {
                $params .= $aux[$i] . ' = :' . $aux[$i] . ', ';
                continue;
            }

            $params .= $aux[$i] . ' = :' . $aux[$i];
        }
        
        $this->params = array_merge($this->params, $data);

        return $params;
    }

}
