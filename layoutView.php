<?php
if (!isset($_SESSION['usuario_id'])) { 
    return header('Location:?rota=Login_login'); 
}
require 'layoutHeader.php';
?>
<div class="max-w-7xl mx-auto mt-20 text-center">
    <h1 class="text-3xl font-bold">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h1>
    <p class="text-xl mt-4">Você está logado no sistema como <strong><?= $_SESSION['usuario_tipo'] ?></strong>.</p>
    <hr class="my-6 border-gray-300">
    <p class="text-base text-gray-700">Use o menu acima para navegar no sistema.</p>
</div>
</body>
</html>
