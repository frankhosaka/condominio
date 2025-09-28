<?php require_once 'layoutHeader.php'; ?>
    <div class="max-w-6xl mx-auto mt-20 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-center">Login do Sistema</h3>
                        <p class="text-center text-gray-600">Acesso restrito a moradores e equipe</p>
                        <?= $l->mensagem ?>
                        <form method="POST" class="mt-4">
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <input type="email" id="email" name="email" required 
                                    autocomplete="off"
                                    class="mt-1 block w-full px-3 py-2 border 
                                    border-gray-300 rounded-md shadow-sm focus:outline-none 
                                    focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="senha" class="block text-sm font-medium text-gray-700">
                                    Senha
                                </label>
                                <input type="password" id="senha" name="senha" required
                                    autocomplete="off"
                                    class="mt-1 block w-full px-3 py-2 border
                                    order-gray-300 rounded-md shadow-sm focus:outline-none 
                                    focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">Entrar</button>
                            <p class="text-center mt-4 text-sm text-gray-600">
                                <a href="?rota=Login_cadastroUsuario" 
                                    class="text-blue-600 hover:underline">
                                    Não tem uma conta? Cadastre-se.
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'layoutFooter.php'; ?>
</body>
</html>

