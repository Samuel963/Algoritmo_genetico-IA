<?php
function gerarindividuos(){
    $quantidade_de_individuos = 1000;
    $individuos = array();
    for ($j = 0; $j <= $quantidade_de_individuos; $j++) {
        $individuos[$j]  = null;
        for ($i = 0; $i < 8; $i++) {
            $individuos[$j] .= rand(0, 1);
        }
    }
    return $individuos;
}
function selecao($resultado){
    $melhor_individuo = '111111111';
    $i=0;
    $geracoes = 1;
    while ($geracoes <= 10) {
        $i=0;
        while (isset($resultado[$i])) {
            if ($resultado[$i] == $melhor_individuo) {
                echo "melhor individuo: " . $i . "  " . $resultado[$i] . "\n";
                return 0;
            }
            $i++;
        }
        echo "\n\n\n\n\n***********************************************nova geração *************************************************\n\n\n\n\n";
        $resultado = analise($resultado);
        $geracoes++;
    }
}
function analise($individuos){
    $criterio_de_selecao = 4;            //numero < ou = a 8
        $aptos = array();
        $inaptos = array();
        $novosIndividuos_aptos = array();
        $novosIndividuos_inaptos = array();
        $novosIndividuos = array();
        $i = 0;
        while (isset($individuos[$i])){
            if (substr_count($individuos[$i], '1') > $criterio_de_selecao) {
                $aptos[$i] = $individuos[$i];
            }else{
                $inaptos[$i] = $individuos[$i];
            }
            $i++;
        }
        $total = count($aptos);
        $j = 0;
        for($i = 0; $i <= $total; $i++){
            if (isset($aptos[$i]) && isset($aptos[$i+1])) {
                    $novosIndividuos_aptos[$j] = substr($aptos[$i], 0, 4);
                    $novosIndividuos_aptos[$j] .= substr($aptos[$i + 1], -4);
                $j++;
                $i += 2;
            }
        }
        $total = count($inaptos);
        $j = 0;
        for($i = 0; $i <= $total; $i++){
            if (isset($inaptos[$i]) && isset($inaptos[$i+1])) {
                    $novosIndividuos_inaptos[$i] = substr($inaptos[$i], 0, 4);
                    $novosIndividuos_inaptos[$i] .= substr($inaptos[$i + 1], -4);
                $j++;
                $i += 2;
            }
        }
        $total = count($inaptos)+count($aptos);
        $j = 0;
        for($i = 0; $i <= $total; $i++){
            if (isset($inaptos[$i]) && isset($aptos[$i])) {
                $novosIndividuos[$i] = substr($inaptos[$i], 0, 4);
                $novosIndividuos[$i] .= substr($aptos[$i], -4);
                $j++;
                $i += 2;
            }
        }
        $individuosnovageracao = array_merge($novosIndividuos_aptos, $novosIndividuos_inaptos, $novosIndividuos);
        $total = count($individuosnovageracao);
        for ($i = 0; $i < $total; $i++){
            echo "INDIVIDUO: ". $i . "   CODIGO GENETICO: ".$individuosnovageracao[$i]."\n";
        }
        return $individuosnovageracao;
}
$individuos = gerarindividuos();
$i = 0;
echo "Geração Inicial\n";
        while (isset($individuos[$i])){
            echo "INDIVIDUO: ". $i . "   CODIGO GENETICO: ".$individuos[$i]."\n";
            $i++;
        }
echo "\n\n\n\n\n***********************************************nova geração *************************************************\n\n\n\n\n";
$resultado = analise($individuos);
selecao($resultado);
