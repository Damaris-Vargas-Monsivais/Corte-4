<?php
//funcion que procesa los datos crudos
//retorna un arreglo asociativo con el histograma
function crear_histograma($path_arch)
{
    $handle = fopen($path_arch, 'r');
    //creacion del array
    $histograma = array(
        'cero'=> 0,
        'uno'=> 0,
        'dos'=> 0,
        'tres'=> 0,
        'cuatro'=> 0,
        'cinco'=> 0
    );
    //se lee los datos del archivo linea x linea
    while (!feof($handle)) 
    { 
        //funcion trim para eliminar los espacios
        //en el inicio y final de la cadena
        $temp = trim(fgets($handle));

        //llenamos el histograma
        if ($temp == '0') {
            $histograma['cero'] += 1;
        } elseif ($temp == '1') {
            $histograma['uno'] += 1;
        } elseif ($temp == '2') {
            $histograma['dos'] += 1;
        } elseif ($temp == '3') {
            $histograma['tres'] += 1;
        } elseif ($temp == '4') {
            $histograma['cuatro'] += 1;
        } elseif ($temp == '5') {
            $histograma['cinco'] += 1;
        }
    }
    fclose($handle);
    return $histograma;
}
//funcion para procesar el json
//se crea la version del histograma en el json
//retorna el histograma en formato json 
function crear_json($path_arch_json, $arreglo_histo)
{
    $handle=fopen($path_arch_json,'w');
    //se crea el json
    $histo_json=json_encode($arreglo_histo);
    //se escribe el json en el archivo
    fwrite($handle, $histo_json);
    fclose($handle);
    return $histo_json;
}
