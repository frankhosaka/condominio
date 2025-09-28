<?php require_once 'layoutHeader.php'; ?>
<div class="max-w-6xl mx-auto mt-10 px-4">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-center mb-4">Cadastro de Usuário</h3>
                    <?= $l->mensagem ?>
                    <form method="POST" enctype="multipart/form-data" class="space-y-4">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" id="nome" name="nome" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                            <input type="password" id="senha" name="senha" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="tipo_usuario" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
                            <select id="tipo_usuario" name="tipo_usuario" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="Usuario">Usuário</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                        </div>
                        <div>
                            <label for="foto_perfil" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
