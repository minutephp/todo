<?php

/** @var Router $router */
use Minute\Model\Permission;
use Minute\Routing\Router;

$router->get('/admin/todos', null, 'admin', 'm_todo_statuses[999] as statuses')
       ->setReadPermission('statuses', 'admin')->setDefault('statuses', '*');
$router->post('/admin/todos', null, 'admin', 'm_todo_statuses as statuses')
       ->setAllPermissions('statuses', 'admin');