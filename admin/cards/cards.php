<?php 

require './../../vendor/autoload.php';
include './../../models/CartasBD.php';

use TCPDF;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdf = new TCPDF();
    $pdf->AddPage();

    $pdf->SetPrintHeader(false); 
    $pdf->SetPrintFooter(false);

    $pdf->Image('http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/img/logo.png', 10, 7, 35);

    $cartasDB = new CartasBD();
    $cartas = $cartasDB->obtenerArray(); 

    
    $html = '

        <style>
        
            body {
                margin: 0; 
                padding: 20px; 
            }
                
            h1 {
                text-align: center;
                color: #333; 
                margin: 20px; 
            }

            h4 {
                text-align: center;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                background-color: #ffffff; 
                
            }

            th, td {
                border: 1px solid gray; 
                padding: 12px; 
                background-color: #f4f4f4; 
                text-align: center;
            }

            img {
                max-height: 60px; 
            }

            .cabecera {
                background-color: #dba481;
            }


        </style>
    
    <body>

        <h1>Informe de Cartas de VSGAME</h1>
        <h4>';

        date_default_timezone_set('Europe/Madrid'); 
        $fecha_hora_actual = date('Y-m-d H:i:s'); 
        $html .= $fecha_hora_actual;
    
        $html .= '</h4>
            <table border="1">
                <tr>
                    <th class ="cabecera"><strong>ID</strong></th>
                    <th class ="cabecera"><strong>NOMBRE</strong></th>
                    <th class ="cabecera"><strong>ATAQUE</strong></th>
                    <th class ="cabecera"><strong>DEFENSA</strong></th>
                    <th class ="cabecera"><strong>PODER ESPECIAL</strong></th>
                    <th class ="cabecera"><strong>IMAGEN</strong></th>
                </tr>';

    foreach ($cartas as $carta) {
        $html .= '<tr>';
        $html .= '<td>' . $carta['id'] . '</td>'; 
        $html .= '<td>' . $carta['nombre'] . '</td>'; 
        $html .= '<td>' . $carta['ataque'] . '</td>'; 
        $html .= '<td>' . $carta['defensa'] . '</td>'; 
        $html .= '<td>' . $carta['poder_especial'] . '</td>'; 
        $html .= '<td><img height="50px" src="./uploads/imagenes/' . $carta['img'] . '"></td>'; 
        $html .= '</tr>';
    }

        $html .= '</table></body>
        
        <p>Número total de cartas: ';

        $html .= count($cartas);
        
        $html .= '</p> </html>';

    $pdf->writeHTML($html, true, false, true,);

    $pdf->Output('Informe de Cartas.pdf','I');
    exit(); 
}


include './../header.php'; 

?>

<main>
        <section class="dashboard-info">
          
            <h2>Listado de cartas</h2>

            <p><?php if(isset($_GET['mensaje'])){echo $_GET['mensaje'];}?></p>

            <button onclick="window.location.href='cardAdd.php'">Añadir Carta</button>
            <br><br>
            <form method="POST">
            <button type="submit">Descargar PDF</button>
            </form>

            
        <?php 
        
        $cartasDB = new CartasBD();
        $cartasDB->obtenerCartas();

        ?>

        <br><br>
        
       


        </section>
    </main>

<?php include './../footer.php'; ?>