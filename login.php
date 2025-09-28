<?php

class Login {

    public $mensagem;

    function __call($nomeMetodo,$argumentos) {
        echo "O método '{$nomeMetodo}' ainda vai ser implementado";
    }

    function cadastroUsuario () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = $_POST['senha'];
            $tipo_usuario = filter_input(INPUT_POST, 'tipo_usuario');

            if ($nome && $email && $senha && $tipo_usuario) {
                $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
                $foto_caminho = null;
                if (isset($_FILES['foto_perfil']) && 
                    $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
                    $extensao = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
                    $foto_caminho = uniqid() . '.' . $extensao;
                }
                try {
                    (new Conn)->prepare("INSERT INTO usuarios 
                        (nome, email, senha, tipo_usuario, foto_caminho) VALUES (?, ?, ?, ?, ?)",
                        [$nome, $email, $senha_hashed, $tipo_usuario, $foto_caminho]);
                    $this->mensagem = '
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        <strong class="font-bold">Cadastro efetuado com sucesso, favor logar</strong>
                        </div>';
                    return $this->login();
                } catch (PDOException $e) {
                    $this->mensagem = '
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong class="font-bold">Erro: '.$e->getMessage().'</strong>
                        </div>';    
                }
            } else {
                $this->mensagem = '
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">Por favor, preencha todos os dados corretamente</strong>
                    </div>';

            }
        }
        return view('cadastroUsuario',['l'=>$this]);
    }

    function login() {
        (new Conn)->criarSchema();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = $_POST['senha'];
            // Usa prepared statement para buscar o usuário pelo email.
            $usuario = (new Conn)->prepare("SELECT * FROM usuarios 
                WHERE email = ?",[$email])[0];
            if ($usuario && password_verify($senha, $usuario->senha)) {
                // Se a senha estiver correta, inicia a sessão e redireciona.
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;
                $_SESSION['usuario_tipo'] = $usuario->tipo_usuario;
                return view('layoutView');
            } else {
                $this->mensagem = '
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">Email ou senha inválidos.</strong>
                    </div>';
            }
        }
        return view('loginView',['l'=>$this]);
    }
}