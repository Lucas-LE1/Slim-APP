<?php

namespace App\Controllers;

use App\Services\TaskService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;

class TaskController
{

    /**
     * __invoke
     *
     * @param  mixed $request
     * @param  mixed $response
     * @param  mixed $args
     * @return Response
     */
    public function __invoke($request, $response, $args): Response
    {
        return $response;
    }

    /**
     * getAllTasks
     *
     * @param  mixed $request
     * @param  mixed $response
     * @param  mixed $args
     * @return Response
     */
    public function getAllTasks(Request $request, Response $response, $args): Response
    {
        $list = TaskService::getAllTask();
        $payload = json_encode($list);

        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json');
    }



    /**
     * getTaskById
     *
     * @param  mixed $request
     * @param  mixed $response
     * @param  mixed $args
     * @return Response
     */
    public function getTaskById(Request $request, Response $response, $args): Response
    {
        $id = $args['id'];
        $list = TaskService::getTaskById($id);
        $payload = json_encode($list);

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');

    }

    /**
     * addTask
     * 
     * @param mixed $request
     * @param mixed $response
     * @param mixed $args
     * @return Response
     */

    public function addTask(Request $request, Response $response, $args): Response
    {

        $array = $request->getParsedBody();

        if (array_key_exists('context', $array)) {
            $context = $array['context'];
            TaskService::addTask($context);
            $text = "Inserção de dados concluidas!";
        } else {
            $text = "Inserção de dados incorretas!";
        }
        $response->getBody()->write(json_encode([
            'message' => $text
        ]));
        return $response->withHeader('Content-Type', 'application/json');

    }

    public function alterTask(Request $request, Response $response, $args)
    {
        $array = $request->getParsedBody();

        if (array_key_exists('context', $array) && array_key_exists('id', $array)) {
            $context = $array['context'];
            $id = $array['id'];

            TaskService::alterTask($context, $id);
            $text = "Inserção de dados concluidas!";

        } else {
            $text = "Inserção de dados incorretas!";
        }
        $response->getBody()->write(json_encode([
            'message' => $text
        ]));
        return $response->withHeader('Content-Type', 'application/json');

    }

    public function deleteTask(Request $request, Response $response, $args)
    {
        $taskId = $args['id'];

    }
}