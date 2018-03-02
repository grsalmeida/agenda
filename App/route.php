<?php

$route->get('/', 'Usuario@login');
$route->post('/login', 'Usuario@logar');
$route->post('/cadastro/user', 'Usuario@addUser');
$route->get('/loggoff', 'Usuario@addUser');

$route->get('/lista', 'Contato@listContato');
$route->get('/cadastro', 'Contato@cadastro');
$route->post('/cadastrar', 'Contato@addContato');
$route->post('/editar', 'Contato@editContato');
$route->post('/remover', 'Contato@removeContato');

$route->get('/hour', 'Contato@hour');
$route->get('/admin/dashboard', 'Contato@dashboard');