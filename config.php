<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');

defined('HOST') || define('HOST', 'localhost');
defined('DBNAME') || define('DBNAME', 'condominio');
defined('USER') || define('USER', 'root');
defined('PASSWORD') || define('PASSWORD', '');

spl_autoload_register(fn ($class) => 
    require str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class)) . '.php');

function view($arquivo, $array = null) {
    if (!is_null($array)) {
        foreach ($array as $var => $value){
            ${$var} = $value;
        }
    }
    ob_start();
    include $arquivo . ".php";
    ob_flush();
}

class Conn {

    private static $pdo;

    function criarSchema() {
        try {
            // Conecta sem especificar o banco de dados
            $pdo = new PDO("mysql:host=" . HOST, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verifica se o banco 'condominio' existe
            $stmt = $pdo->query("SHOW DATABASES LIKE '" . DBNAME . "'");
            if ($stmt->rowCount() === 0) {
                // Cria o banco se não existir
                $pdo->exec("CREATE DATABASE " . DBNAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            }

            // Recria a conexão com o banco já selecionado
            self::$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria a tabela se não existir
            $stmt = self::$pdo->query("SHOW TABLES LIKE 'usuarios'");
            if ($stmt->rowCount() === 0) {
                self::$pdo->exec("CREATE TABLE `usuarios` (
                    `id` int NOT NULL AUTO_INCREMENT,
                    `nome` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
                    `email` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
                    `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
                    `tipo_usuario` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
                    `foto_caminho` varchar(45) COLLATE utf8mb4_general_ci,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
            }
        } catch (PDOException $e) {
            die("Erro ao criar o schema: " . $e->getMessage());
        }
    }

    static function instancia() {
        if (!self::$pdo) {
            self::$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);
        }
        return self::$pdo;
    }

    function prepare($sql, $params = []) {
        $pdo = $this->instancia();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        if (strpos($sql, 'select') !== 0) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        return $stmt->rowCount();
    }
}