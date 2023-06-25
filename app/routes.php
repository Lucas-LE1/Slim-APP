<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\TaskController;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/to-do', function (Group $group) {
        $group->get('/',TaskController::class . ":getAllTasks");
        $group->get('/{id}', TaskController::class . ':getTaskById');
        $group->post('/add', TaskController::class . ':addTask');
        $group->put('/alter/{id}', TaskController::class . ':alterTask');
        $group->delete('/delete/{id}', TaskController::class . ':deleteTask');
    });
};