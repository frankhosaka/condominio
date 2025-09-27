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

    public static function criarSchema() {
        try {
            // Conecta sem especificar o banco de dados
            $pdo = new PDO("mysql:host=" . HOST, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verifica se o banco 'condominio' existe
            $stmt = $pdo->query("SHOW DATABASES LIKE 'condominio'");
            if ($stmt->rowCount() === 0) {
                // Cria o banco se não existir
                $pdo->exec("CREATE DATABASE condominio CHARACTER SET utf8mb4 
                    COLLATE utf8mb4_unicode_ci");
                $pdo = new PDO("mysql:host=" . HOST . ";dbname=condominio", USER, PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("CREATE TABLE `usuarios` (
                    `id` int NOT NULL AUTO_INCREMENT,
                    `nome` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
                    PRIMARY KEY (`id`)) 
                    ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 
                    COLLATE=utf8mb4_general_ci;");
                $pdo->exec("INSERT INTO `usuarios` VALUES (1,'João')");
                echo "Banco de dados 'condominio' criado com sucesso.";
            } else {
                echo "Banco de dados 'condominio' já existe.";
            }
        } catch (PDOException $e) {
            die("Erro ao criar o schema: " . $e->getMessage());
        }
    }

    public static function instancia() {
        if (!self::$pdo) {
            self::$pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);
        }
        return self::$pdo;
    }

    function delete($sql) {
        return $this->instancia()->query("DELETE FROM $sql");
    }

    function insert($sql) {
        return $this->instancia()->query("INSERT INTO $sql");
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

    function select($sql) {
        $stmt = $this->instancia()->query("SELECT $sql");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function update($sql) {
        try {
            return $this->instancia()->query("UPDATE " . $sql);
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}
