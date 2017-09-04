<style>
#table-estatisticas {
    display: inline-block;
    margin-bottom: 50px;
}

#table-estatisticas td {
    text-align: center;
    vertical-align: middle;
    padding-left: 10px;
    padding-right: 10px;
}

#table-estatisticas tr {
    background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#table-estatisticas tr:first-child {
    font-weight: 700;
    background: #108AC0;
    color: white;
}

#usuarios {
    font-family: "Lato", "Helvetica Neue", "Helvetica", "Arial", "sans-serif";
    display: none;
    position: fixed;
    background-color: rgba(255, 255, 255, 1);
    border-radius: 5px;
    box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.4);
    width: 200px;
    height: 250px;
    left: 50%;
    margin-left: -100px;
    z-index: 9999;
}

#usuarios div:first-child {
    height: 15%;
    font-weight: 700;
    font-size: 20px;
    line-height: 35px;
    text-align: center;
    background: #108AC0;
    color: white;
}

#usuarios div:nth-child(2) {
    height: 75%;
    overflow-y: auto;
}

#usuarios div:last-child {
    height: 10%;
    line-height: 25px;
    text-align: center;
    background: #108AC0;
    color: white;
    cursor: pointer;
}

#usuarios table {
    width: 100%;
    border: 0;
    margin-bottom: 2px;
    border-spacing: 0;
}

#usuarios table td {
    width: 50%;
    padding-left: 5px;
    background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#usuarios table td:first-child {
    border-right: 1px solid #fff;
}

#usuarios table td:last-child {
    text-align: center;
}

#usuarios table:first-child td {
    width: 50%;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    padding-left: 5px;
    background: #bbb url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#mais-estatisticas {
    font-family: "Lato", "Helvetica Neue", "Helvetica", "Arial", "sans-serif";
    text-align: center;
    display: none;
}

td, th {
    text-align: center;
    padding: 5px;
    border: 1px solid black;
}
table {
    border: 1px solid black;
}
</style>
<div id="usuarios"></div>
<a href="grafico_instrumento.php?idDisciplina=<?= $_GET['idDisciplina']; ?>">Ver gráficos</a>
<table>
    <tr>
        <th rowspan="4" colspan="2">Competências</th>
        <th colspan="17">Níveis</th>
    </tr>
    <tr>
        <th colspan="5">Situação 1</th>
        <th colspan="5">Situação 2</th>
        <th colspan="5">Situação 3</th>
        <th rowspan="3">Média CHA - Turma</th>
        <th rowspan="3">Média da Competência - Geral da Turma</th>
    </tr>
    <tr>
        <th colspan="5">Média da turma</th>
        <th colspan="5">Média da turma</th>
        <th colspan="5">Média da turma</th>
    </tr>
    <tr>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
    </tr>
<?php
    //echo "<pre>";
    //var_dump($indices['usuarios_acessos']);
    ?>
<?php
	$carregamento = new Carregamento();
	$competencia = new Competencia;
    $instrumento_oa = new Instrumento;
    $instrumentos = $disciplina->getInstrumentos($_GET['idDisciplina']);
    foreach ($instrumentos as $instrumento) {
    	foreach ($disciplina->listaAlunosMatriculados($_GET['idDisciplina']) as $aluno) {
    		$user_resposta = $instrumento_oa->getRespostaByInstrumentoAndUsuario($instrumento['id'], $aluno['usuario_idusuario']);
        	$resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta1']);
        	$nao_possuo[0] = 0;
			$duvidas[0] = 0;
			$nocoes_basicas[0] = 0;
			$nao_tenho_certeza[0] = 0;
			$plena_certeza[0] = 0;
			$nao_possuo_habilidade[0] = 0;
			$duvidas_habilidade[0] = 0;
			$nocoes_basicas_habilidade[0] = 0;
			$nao_tenho_certeza_habilidade[0] = 0;
			$plena_certeza_habilidade[0] = 0;
			$nao_possuo_atitude[0] = 0;
			$duvidas_atitude[0] = 0;
			$nocoes_basicas_atitude[0] = 0;
			$nao_tenho_certeza_atitude[0] = 0;
			$plena_certeza_atitude[0] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[0]++;
                    break;
                case 1:
                    $duvidas[0]++;
                    break;
                case 2:
                    $nocoes_basicas[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza[0]++;
                    break;
                case 4:
                    $plena_certeza[0]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[0]++;
                    break;
                case 1:
                    $duvidas_habilidade[0]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[0]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[0]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[0]++;
                    break;
                case 1:
                    $duvidas_atitude[0]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[0]++;
                    break;
                case 4:
                    $plena_certeza_atitude[0]++;
                    break;
            }
            $resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta2']);
        	$nao_possuo[1] = 0;
			$duvidas[1] = 0;
			$nocoes_basicas[1] = 0;
			$nao_tenho_certeza[1] = 0;
			$plena_certeza[1] = 0;
			$nao_possuo_habilidade[1] = 0;
			$duvidas_habilidade[1] = 0;
			$nocoes_basicas_habilidade[1] = 0;
			$nao_tenho_certeza_habilidade[1] = 0;
			$plena_certeza_habilidade[1] = 0;
			$nao_possuo_atitude[1] = 0;
			$duvidas_atitude[1] = 0;
			$nocoes_basicas_atitude[1] = 0;
			$nao_tenho_certeza_atitude[1] = 0;
			$plena_certeza_atitude[1] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[1]++;
                    break;
                case 1:
                    $duvidas[1]++;
                    break;
                case 2:
                    $nocoes_basicas[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza[1]++;
                    break;
                case 4:
                    $plena_certeza[1]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[1]++;
                    break;
                case 1:
                    $duvidas_habilidade[1]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[1]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[1]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[1]++;
                    break;
                case 1:
                    $duvidas_atitude[1]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[1]++;
                    break;
                case 4:
                    $plena_certeza_atitude[1]++;
                    break;
            }
            $resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta3']);
        	$nao_possuo[2] = 0;
			$duvidas[2] = 0;
			$nocoes_basicas[2] = 0;
			$nao_tenho_certeza[2] = 0;
			$plena_certeza[2] = 0;
			$nao_possuo_habilidade[2] = 0;
			$duvidas_habilidade[2] = 0;
			$nocoes_basicas_habilidade[2] = 0;
			$nao_tenho_certeza_habilidade[2] = 0;
			$plena_certeza_habilidade[2] = 0;
			$nao_possuo_atitude[2] = 0;
			$duvidas_atitude[2] = 0;
			$nocoes_basicas_atitude[2] = 0;
			$nao_tenho_certeza_atitude[2] = 0;
			$plena_certeza_atitude[2] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[2]++;
                    break;
                case 1:
                    $duvidas[2]++;
                    break;
                case 2:
                    $nocoes_basicas[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza[2]++;
                    break;
                case 4:
                    $plena_certeza[2]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[2]++;
                    break;
                case 1:
                    $duvidas_habilidade[2]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[2]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[2]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[2]++;
                    break;
                case 1:
                    $duvidas_atitude[2]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[2]++;
                    break;
                case 4:
                    $plena_certeza_atitude[2]++;
                    break;
            }
    	}
        $soma_alunos_conhecimento[0] = ($nao_possuo[0]+$duvidas[0]+$nocoes_basicas[0]+$nao_tenho_certeza[0]+$plena_certeza[0]);
        $soma_alunos_conhecimento[1] = ($nao_possuo[1]+$duvidas[1]+$nocoes_basicas[1]+$nao_tenho_certeza[1]+$plena_certeza[1]);
        $soma_alunos_conhecimento[2] = ($nao_possuo[2]+$duvidas[2]+$nocoes_basicas[2]+$nao_tenho_certeza[2]+$plena_certeza[2]);

        if($soma_alunos_conhecimento[0] != 0) {
            $media_conhecimento[0] = ($duvidas[0]+$nocoes_basicas[0]*2+$nao_tenho_certeza[0]*3+$plena_certeza[0]*4)/$soma_alunos_conhecimento[0];
        }
        else {
            $media_conhecimento[0] = 0;
        }

        if($soma_alunos_conhecimento[1] != 0) {
            $media_conhecimento[1] = ($duvidas[1]+$nocoes_basicas[1]*2+$nao_tenho_certeza[1]*3+$plena_certeza[1]*4)/$soma_alunos_conhecimento[1];
        }
        else {
            $media_conhecimento[1] = 0;
        }

        if($soma_alunos_conhecimento[2] != 0) {
            $media_conhecimento[2] = ($duvidas[2]+$nocoes_basicas[2]*2+$nao_tenho_certeza[2]*3+$plena_certeza[2]*4)/$soma_alunos_conhecimento[2];
        }
        else {
            $media_conhecimento[2] = 0;
        }

        $soma_alunos_habilidade[0] = ($nao_possuo_habilidade[0]+$duvidas_habilidade[0]+$nocoes_basicas_habilidade[0]+$nao_tenho_certeza_habilidade[0]+$plena_certeza_habilidade[0]);
        $soma_alunos_habilidade[1] = ($nao_possuo_habilidade[1]+$duvidas_habilidade[1]+$nocoes_basicas_habilidade[1]+$nao_tenho_certeza_habilidade[1]+$plena_certeza_habilidade[1]);
        $soma_alunos_habilidade[2] = ($nao_possuo_habilidade[2]+$duvidas_habilidade[2]+$nocoes_basicas_habilidade[2]+$nao_tenho_certeza_habilidade[2]+$plena_certeza_habilidade[2]);

        if($soma_alunos_habilidade[0] != 0) {
            $media_habilidade[0] = ($duvidas_habilidade[0]+$nocoes_basicas_habilidade[0]*2+$nao_tenho_certeza_habilidade[0]*3+$plena_certeza_habilidade[0]*4)/$soma_alunos_habilidade[0];
        }
        else {
            $media_habilidade[0] = 0;
        }

        if($soma_alunos_habilidade[1] != 0) {
            $media_habilidade[1] = ($duvidas_habilidade[1]+$nocoes_basicas_habilidade[1]*2+$nao_tenho_certeza_habilidade[1]*3+$plena_certeza_habilidade[1]*4)/$soma_alunos_habilidade[1];
        }
        else {
            $media_habilidade[1] = 0;
        }

        if($soma_alunos_habilidade[2] != 0) {
            $media_habilidade[2] = ($duvidas_habilidade[2]+$nocoes_basicas_habilidade[2]*2+$nao_tenho_certeza_habilidade[2]*3+$plena_certeza_habilidade[2]*4)/$soma_alunos_habilidade[2];
        }
        else {
            $media_habilidade[2] = 0;
        }

        $soma_alunos_atitude[0] = ($nao_possuo_atitude[0]+$duvidas_atitude[0]+$nocoes_basicas_atitude[0]+$nao_tenho_certeza_atitude[0]+$plena_certeza_atitude[0]);
        $soma_alunos_atitude[1] = ($nao_possuo_atitude[1]+$duvidas_atitude[1]+$nocoes_basicas_atitude[1]+$nao_tenho_certeza_atitude[1]+$plena_certeza_atitude[1]);
        $soma_alunos_atitude[2] = ($nao_possuo_atitude[2]+$duvidas_atitude[2]+$nocoes_basicas_atitude[2]+$nao_tenho_certeza_atitude[2]+$plena_certeza_atitude[2]);

        if($soma_alunos_atitude[0] != 0) {
            $media_atitude[0] = ($duvidas_atitude[0]+$nocoes_basicas_atitude[0]*2+$nao_tenho_certeza_atitude[0]*3+$plena_certeza_atitude[0]*4)/$soma_alunos_atitude[0];
        }
        else {
            $media_atitude[0] = 0;
        }

        if($soma_alunos_atitude[1] != 0) {
            $media_atitude[1] = ($duvidas_atitude[1]+$nocoes_basicas_atitude[1]*2+$nao_tenho_certeza_atitude[1]*3+$plena_certeza_atitude[1]*4)/$soma_alunos_atitude[1];
        }
        else {
            $media_atitude[1] = 0;
        }

        if($soma_alunos_atitude[2] != 0) {
            $media_atitude[2] = ($duvidas_atitude[2]+$nocoes_basicas_atitude[2]*2+$nao_tenho_certeza_atitude[2]*3+$plena_certeza_atitude[2]*4)/$soma_alunos_atitude[2];
        }
        else {
            $media_atitude[2] = 0;
        }

        $media_conhecimento_turma = ($media_conhecimento[0]+$media_conhecimento[1]+$media_conhecimento[2])/3;
        $media_habilidade_turma = ($media_habilidade[0]+$media_habilidade[1]+$media_habilidade[2])/3;
        $media_atitude_turma = ($media_atitude[0]+$media_atitude[1]+$media_atitude[2])/3;

        $media_cha = ($media_conhecimento_turma+$media_habilidade_turma+$media_atitude_turma)/3;

?>

    <tr>
        <th rowspan="3"><?=$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome'];?></th>
        <th>C</th>
        <td><?php if(round($media_conhecimento[0] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[0] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[0] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[0] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[0] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[1] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[1] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[1] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[1] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[1] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[2] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[2] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[2] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[2] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_conhecimento[2] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_conhecimento_turma, 0, '.', ',');?></td>
        <td rowspan="3"><?= number_format($media_cha, 0, '.', ','); ?></td>
    </tr>
    <tr>
        <th>H</th>
        <td><?php if(round($media_habilidade[0] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[0] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[0] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[0] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[0] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[1] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[1] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[1] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[1] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[1] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[2] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[2] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[2] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[2] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_habilidade[2] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_habilidade_turma, 0, '.', ',');?></td>
    </tr>
    <tr>
        <th>A</th>
        <td><?php if(round($media_atitude[0] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[0] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[0] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[0] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[0] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[1] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[1] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[1] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[1] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[1] == 4)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[2] == 0)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[2] == 1)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[2] == 2)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[2] == 3)) echo "X"; ?></td>
        <td><?php if(round($media_atitude[2] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_atitude_turma, 0, '.', ',');?></td>
    </tr>
<?php
    }
?>
</table>

<br>
Legenda dos níveis:<br><br>
0 - Não possui<br>
1 - Tem noção, mas ainda tem dúvidas<br>
2 - Tem noções básicas<br>
3 - Não tem plena certeza<br>
4 - Tem plena certeza<br>



<?php
    //echo "<pre>";
    //var_dump($indices['usuarios_acessos']);
    ?>
<?php
    $carregamento = new Carregamento();
    $competencia = new Competencia;
    $instrumento_oa = new Instrumento;
    $instrumentos = $disciplina->getInstrumentos($_GET['idDisciplina']);
    foreach ($disciplina->listaAlunosMatriculados($_GET['idDisciplina']) as $aluno) {
        $user = new User($aluno['usuario_idusuario']);
        if($user->getName() != NULL) {
?>
<h1><?= $user->getName(); ?></h1>
<table>
    <tr>
        <th rowspan="4" colspan="2">Competências</th>
        <th colspan="17">Níveis</th>
    </tr>
    <tr>
        <th colspan="5">Situação 1</th>
        <th colspan="5">Situação 2</th>
        <th colspan="5">Situação 3</th>
        <th rowspan="3">Média CHA - Turma</th>
        <th rowspan="3">Média da Competência - Geral da Turma</th>
    </tr>
    <tr>
        <th colspan="5">Média da turma</th>
        <th colspan="5">Média da turma</th>
        <th colspan="5">Média da turma</th>
    </tr>
    <tr>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>0</th>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
    </tr>
<?php
        foreach ($instrumentos as $instrumento) {
            $user_resposta = $instrumento_oa->getRespostaByInstrumentoAndUsuario($instrumento['id'], $aluno['usuario_idusuario']);
            $resposta_nova[0] = $instrumento_oa->decodeResposta($user_resposta['resposta1']);
            $resposta_nova[1] = $instrumento_oa->decodeResposta($user_resposta['resposta2']);
            $resposta_nova[2] = $instrumento_oa->decodeResposta($user_resposta['resposta3']);
            $media_conhecimento = ($resposta_nova[0]['conhecimento']+$resposta_nova[1]['conhecimento']+$resposta_nova[2]['conhecimento'])/3;
            $media_habilidade = ($resposta_nova[0]['habilidade']+$resposta_nova[1]['habilidade']+$resposta_nova[2]['habilidade'])/3;
            $media_atitude = ($resposta_nova[0]['atitude']+$resposta_nova[1]['atitude']+$resposta_nova[2]['atitude'])/3;
            $media_cha = ($media_conhecimento+$media_habilidade+$media_atitude)/3;
?>
    <tr>
        <th rowspan="3"><?=$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome'];?></th>
        <th>C</th>
        <td><?php if(round($resposta_nova[0]['conhecimento'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['conhecimento'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['conhecimento'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['conhecimento'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['conhecimento'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['conhecimento'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['conhecimento'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['conhecimento'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['conhecimento'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['conhecimento'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['conhecimento'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['conhecimento'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['conhecimento'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['conhecimento'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['conhecimento'] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_conhecimento, 0, '.', ',');?></td>
        <td rowspan="3"><?= number_format($media_cha, 0, '.', ','); ?></td>
    </tr>
    <tr>
        <th>H</th>
        <td><?php if(round($resposta_nova[0]['habilidade'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['habilidade'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['habilidade'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['habilidade'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['habilidade'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['habilidade'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['habilidade'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['habilidade'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['habilidade'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['habilidade'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['habilidade'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['habilidade'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['habilidade'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['habilidade'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['habilidade'] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_habilidade, 0, '.', ',');?></td>
    </tr>
    <tr>
        <th>A</th>
        <td><?php if(round($resposta_nova[0]['atitude'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['atitude'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['atitude'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['atitude'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[0]['atitude'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['atitude'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['atitude'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['atitude'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['atitude'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[1]['atitude'] == 4)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['atitude'] == 0)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['atitude'] == 1)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['atitude'] == 2)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['atitude'] == 3)) echo "X"; ?></td>
        <td><?php if(round($resposta_nova[2]['atitude'] == 4)) echo "X"; ?></td>
        <td><?=number_format($media_atitude, 0, '.', ',');?></td>
    </tr>
<?php
        }
?>
</table>
<br>
Legenda dos níveis:<br><br>
0 - Não possui<br>
1 - Tem noção, mas ainda tem dúvidas<br>
2 - Tem noções básicas<br>
3 - Não tem plena certeza<br>
4 - Tem plena certeza<br>
<?php
    }
}
?>




<script language="javascript">
</script>
<!-- Don't touch this! -->


    <script class="include" type="text/javascript" src="js/jplot/jquery.jqplot.js"></script>
<!-- Additional plugins go here -->

  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.barRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.pieRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.categoryAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.pointLabels.js"></script>

<!-- End additional plugins -->