<?php
require 'config.php';
$rota = $_GET['rota'] ?? 'Conn_criarSchema';
$segmentos = explode('_', $rota);
$nomeControle = $segmentos[0];
$metodo = $segmentos[1];
$parametros = array_slice($segmentos, 2);

$controle = new $nomeControle();
call_user_func_array([$controle, $metodo], $parametros);