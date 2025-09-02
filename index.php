<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');
spl_autoload_register(fn ($class) => 
    require str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.php');
function view($arquivo, $array = null) {
    if (!is_null($array)) {
        foreach ($array as $var => $value){ ${$var} = $value; }
    }
    ob_start(); include $arquivo . ".php"; ob_flush();
}
$mysqli=new mysqli("localhost","root","");
$mysqli->query("create database if not exists polo3 
    character set utf8mb4 collate utf8mb4_general_ci");
$mysqli=new mysqli("localhost","root","","polo3");
$mysqli->query("create table if not exists tb_cadastro 
    (id int auto_increment primary key, nome varchar(55))
    engine=innodb");
$mysqli->query("create table if not exists tb_portaria
    (id int auto_increment primary key, id_cadastro int, direcao int, data datetime)
    engine=innodb");
$rota = $_GET['rota'] ?? 'Polo_inicio';
$segmentos = explode('_', $rota);
$nomeControle = $segmentos[0];
$metodo = $segmentos[1];
$parametros = array_slice($segmentos, 2);

$controle = new $nomeControle();
call_user_func_array([$controle, $metodo], $parametros);
