<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto final</title>
    <link rel="stylesheet" href="./css/chartist.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <script src="./js/chartist.min.js"></script>
</head>

<body>
    <div class="container">
        <header class="encabezado">
            <h1>Número de televisores/pantallas que hay en cada vivienda en una determinada ciudad</h1>
            <span class="subt">El estudio abarca a 25000 hogares</span>
        </header>
        <?php
        require_once('./procesar.php');
        //archivo con los datos crudos
        $archivo = './datosCrudos.txt';
        //creacion del histograma en un arreglo
        $arrHisto = crear_histograma($archivo);
        //se crea el archivo json 
        $miJson = crear_json('./json/histograma.json', $arrHisto);
        //dos arreglos para separar las etiquetas de los valores
        //dos listas diferentes 
        $lista_labels = array();
        $lista_valores = array();
        //recorrer para sacar los datos por separado
        //tenemos solo 6 datos
        foreach ($arrHisto as $nombre => $valor) {
            $lista_labels[] = $nombre;
            $lista_valores[] = $valor;
        }
        ?>
        <!-----ÁREA DE LA TABLA----->
        <div class="table-responsive">
            <table class="table table-hover marco_histo">
                <thead class="thead-dark">
                    <tr>
                        <th>Familias con 0 pantallas</th>
                        <th>Familias con 1 pantalla</th>
                        <th>Familias con 2 pantallas</th>
                        <th>Familias con 3 pantallas</th>
                        <th>Familias con 4 pantallas</th>
                        <th>Familias con 5 pantallas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $lista_valores[0]; ?></td>
                        <td><?php echo $lista_valores[1]; ?></td>
                        <td><?php echo $lista_valores[2]; ?></td>
                        <td><?php echo $lista_valores[3]; ?></td>
                        <td><?php echo $lista_valores[4]; ?></td>
                        <td><?php echo $lista_valores[5]; ?></td>
                    </tr>
                </tbody>
                <caption class="marco_histo">Histograma </caption>
            </table>
        </div>
        <!----------ÁREA DE LA GRÁFICA------->
        <div class="encabezado">
            <h1>Gráfica representativa</h1>
        </div>

        <div class="ct-chart ct-octave"></div>
        <script>
            //configuracion de datos
            var datos = {
                labels: [
                    '<?php echo $lista_labels[0]; ?> pantallas',
                    '<?php echo $lista_labels[1]; ?> pantalla',
                    '<?php echo $lista_labels[2]; ?> pantallas',
                    '<?php echo $lista_labels[3]; ?> pantallas',
                    '<?php echo $lista_labels[4]; ?> pantallas',
                    '<?php echo $lista_labels[5]; ?> pantallas'
                ],
                series: [
                    <?php echo $lista_valores[0]; ?>,
                    <?php echo $lista_valores[1]; ?>,
                    <?php echo $lista_valores[2]; ?>,
                    <?php echo $lista_valores[3]; ?>,
                    <?php echo $lista_valores[4]; ?>,
                    <?php echo $lista_valores[5]; ?>,
                ]
            };
            //configuracion de opciones
            var opciones = {
                fullWidth: true,
                distributeSeries: true,
                //showArea: true,
                seriesBarDistance: 30,
                showLine: false,
                showPoint: false,
                chartPadding: {
                    right: 35,
                    left: 10,
                    bottom: 20
                },
                axisX: {
                    //en el eje de las x, end significa abajo y start arriba
                    position: 'end',
                },
                axisY: {
                    type: Chartist.FixedScaleAxis,
                    ticks: [0, 1000, 3000, 5000, 7000, 9000, 11000, 13000],
                    //low: 20,
                    high: 13000
                }

            };
            var opcionesResponsive = [
                ['screen and (min-width: 641px) and (max-width: 1024px)', {
                    //seriesBarDistance: 10,
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            return value;
                        }
                    }
                }],
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function(value) {
                            return value[0];
                        }
                    }
                }]
            ];
            new Chartist.Bar('.ct-chart', datos, opciones, opcionesResponsive);
        </script>
        <footer>
            <p>Es notorio que la poblacion prefiere tener dos o tres pantallas,
                pocos son los que no tienen ninguna o una.
                Al mismo tiempo son aun menos los que cuentan con cuatro o hasta con cinco pantallas.
            </p>
        </footer>
    </div>
</body>

</html>