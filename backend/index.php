<?php

/**
 * Resolve problema de CORS
 * Atenção para a configuração: header('Access-Control-Allow-Origin: *');
 * substrituir * por endereços de IP liberados
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Accept, Access-Control-Allow-Headers, X-Requested-With");

require_once('./bootstrap.php');

use Core\Classes\Route;
use App\Controller\TaskController;


$route = new Route('/todo-app/backend');


$route->post('/', function() {
   $tarefa = new TaskController();
   $tarefa->create();
});


$route->get('/', function() {
    $tarefa = new TaskController();
    $tarefa->all();
});


$route->delete('/{id}/delete', function($id) {
    $tarefa = new TaskController();
    $tarefa->delete($id);
});


$route->put('/update/{id}', function($id) {
    $tarefa = new TaskController();
    $tarefa->update($id);
});


$route->run();
