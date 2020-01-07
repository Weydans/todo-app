<?php

namespace Core\Classes;

use \PDO;
use \Exception;

/**
 * Conn
 * 
 * Responsável por realizar conxão com o banco de dados utilizado padrão Singleton
 * @author Weydans Barros
 * Data de criação: 27/12/2019
 */

class Conn
{
    /** @var PDO */
    private static $conn = null;


    /**
     * Connect()
     * 
     * Realiza conexão com o banco de dados no padrão Singleton
     * @return PDO $conn instancia de conexão
     */
    private static function Connect()
    {
        try {
            if (self::$conn == null) {
                $dsn     = SGBD . ':host=' . HOST . ';dbname=' . BASE;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
    
                self::$conn = new PDO($dsn, USER, PASS, $options);
    
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
    
            return self::$conn;

        } catch (Exception $e) {
            throw new Exception($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }


    /**
     * getInstance()
     * 
     * @var PDO $conn Objeto de conexão com o banco de dados
     */
    public static function getInstance()
    {
        return self::Connect();
    }
}
