<?php
class Polo {

    public $cadastro,$portaria,$visitante;
    public $modal=[]; // 0=>Seleciona visitante, 1=> Cadastro novo v.

    function inicio() {
        $this->modal[0]=true;
        $this->modal[1]=false;
        global $mysqli;
        $this->cadastro=$mysqli->query("select * from tb_cadastro order by nome")
            ->fetch_all(MYSQLI_ASSOC);
        $this->portaria=$mysqli->query("select * from tb_portaria 
            join tb_cadastro on tb_cadastro.id = tb_portaria.id_cadastro
            order by data desc limit 10")
            ->fetch_all(MYSQLI_ASSOC);
        return view('poloView',['polo'=>$this]);
    }

    function novoCadastro($visitante = null) {
        $this->modal[0]=false;
        $this->modal[1]=true;
        if($visitante) {
            $this->visitante = $visitante;
            global $mysqli;
            $mysqli->query("insert into tb_cadastro (nome) values ('$this->visitante')");
            return $this->inicio();
        }
        return view('poloView',['polo'=>$this]);
    }

    function registrar($visitante,$direcao) { 
        global $mysqli;
        $id_cadastro=$mysqli->query("select id from tb_cadastro where nome='$visitante'")
            ->fetch_assoc()['id']; 
        $agora=date('Y-m-d H:i');
        $mysqli->query("insert into tb_portaria (id_cadastro,data,direcao)
            values ($id_cadastro,'$agora',$direcao)");
        return header('location:'.dirname($_SERVER['PHP_SELF']));
    }

    function selecionado ($visitante) {
        if($visitante=="Novo") { return $this->novoCadastro(); }
        $this->visitante=$visitante;
        return $this->inicio();
    }

}