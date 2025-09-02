<script src="https://cdn.tailwindcss.com"></script>
<title>Controle da Portaria</title>
<body class="w-[500px] m-0 m-auto">

    <?php if($polo->modal[0]) : ?>
        <h1 class="text-lg mt-5 mb-5">Controle de Entrada e Saída</h1>
        <select onchange="location.replace('?rota=Polo_selecionado_'+this.value)">
            <option value="">Selecione Visitante</option>
            <option>Novo</option>
            <?php foreach($polo->cadastro as $c) : ?>
                <option <?= $polo->visitante==$c['nome'] ? 'selected' : ''?>>
                    <?= $c['nome'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="mt-5">
            <?php if($polo->visitante) : ?>
                <button class="border rounded-lg px-1 py-1"
                    onclick="location.replace('?rota=Polo_registrar_<?=$polo->visitante?>_0')">
                    Registrar Entrada
                </buttton>
                <button class="border rounded-lg ml-2 px-1 py-1 text-red-500"
                    onclick="location.replace('?rota=Polo_registrar_<?=$polo->visitante?>_1')">
                    Registrar Saída
                </button>
            <?php endif; ?>
        </div>
        <div class="mt-5">
            <?php if(count($polo->portaria) !==0) : ?>
                <h1 class="text-lg">Relatório da Portaria de 
                    <?=date('d/m/y',strtotime($polo->portaria[0]['data']))?></h1>
                <div class="flex even:bg-gray-200">
                    <div class="w-[100px]">Hora</div>
                    <div class="w-[200px]">Entrada</div>
                    <div class="w-[200px]">Saída</div>
                </div>
                <?php foreach($polo->portaria as $p) : ?>
                    <div class="flex even:bg-gray-200">
                        <div class="w-[100px]"><?=date('H:i',strtotime($p['data']))?></div>
                        <?php if($p['direcao']==0) : ?>
                            <div class="w-[200px] truncate"><?=$p['nome']?></div>
                            <div class="w-[200px]"></div>
                        <?php else : ?>
                            <div class="w-[200px]"></div>
                            <div class="w-[200px] truncate"><?=$p['nome']?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($polo->modal[1]) : ?>
        <h1 class="text-g mt-5 mb-5 text-red-500">Cadastrar Novo Visitante</h1>
        <input placeholder="Nome" class="border rounded-lg px-1 py-1 focus:outline-gray-200" autofocus
            onchange="location.replace('?rota=Polo_novoCadastro_'+this.value)" />
    <?php endif; ?>
</body>