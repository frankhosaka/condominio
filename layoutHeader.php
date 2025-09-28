<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-gray-900 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
        <a href="<?= isset($_SESSION['usuario_id']) ? 'painel.php' : 'index.php' ?>" class="text-white font-bold text-lg">
            System 2025 - Controle de Portarias
        </a>
        <button class="text-white lg:hidden focus:outline-none" onclick="document.getElementById('navbarNav').classList.toggle('hidden')">
            ☰
        </button>
        <div id="navbarNav" class="hidden lg:flex lg:items-center lg:space-x-6">
            <ul class="flex flex-col lg:flex-row lg:items-center lg:space-x-6 text-white">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <?php if (isset($_SESSION['usuario_tipo']) && strcasecmp($_SESSION['usuario_tipo'], 'Administrador') === 0): ?>
                        <li class="relative group">
                            <a href="#" class="hover:text-gray-300">Controle de Cadastros ▾</a>
                            <ul class="absolute hidden group-hover:block bg-gray-800 text-white mt-2 rounded shadow-lg z-10">
                                <li><a href="?rota=Login_cadastroVisitante.php" class="block px-4 py-2 hover:bg-gray-700">Cadastrar Visitante</a></li>
                                <li><a href="?rota=Login_gerenciarVisitantes.php" class="block px-4 py-2 hover:bg-gray-700">Gerenciar Visitantes</a></li>
                                <li><a href="?rota=Login_gerarCredenciais.php" class="block px-4 py-2 hover:bg-gray-700">Gerar Credencial</a></li>
                                <li><a href="?rota=Login_cadastroUsuario" class="block px-4 py-2 hover:bg-gray-700">Cadastrar Usuário</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li><a href="?rota=Login_entradaVisitante" class="hover:text-gray-300">Controle de Entradas</a></li>
                    <li><a href="?rota=Login_painelTempoReal" class="hover:text-gray-300">Controle de Saídas</a></li>

                    <?php if (isset($_SESSION['tipo_usuario']) && strcasecmp($_SESSION['tipo_usuario'], 'Administrador') === 0): ?>
                        <li class="relative group">
                            <a href="#" class="hover:text-gray-300">Relatórios ▾</a>
                            <ul class="absolute hidden group-hover:block bg-gray-800 text-white mt-2 rounded shadow-lg z-10">
                                <li><a href="?rota=Login_relatorioMovimentacoes" class="block px-4 py-2 hover:bg-gray-700">Movimentações Diárias</a></li>
                                <li><a href="?rota=Login_relatorioVisitantes" class="block px-4 py-2 hover:bg-gray-700">Visitantes Cadastrados</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li><a href="?rota=Login_logout" class="hover:text-gray-300">Sair</a></li>
                <?php else: ?>
                    <li><a href="?rota=Login_login" class="hover:text-gray-300">Login</a></li>
                    <li><a href="?rota=Login_cadastroUsuario" class="hover:text-gray-300">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>