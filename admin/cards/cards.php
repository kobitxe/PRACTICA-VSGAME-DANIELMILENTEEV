<?php 

include './../../tcpdf/config/tcpdf_config.php';
include './../../tcpdf/tcpdf.php';
include './../../models/CartasBD.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdf = new TCPDF();
    $pdf->AddPage();

    $pdf->SetPrintHeader(false); 
    $pdf->SetPrintFooter(false);

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

        </style>
    
    <body>
        <h1>Informe de Cartas de VSGAME</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ATAQUE</th>
                <th>DEFENSA</th>
                <th>PODER ESPECIAL</th>
                <th>IMAGEN</th>
            </tr>';

    foreach ($cartas as $carta) {
        $html .= '<tr>';
        $html .= '<td>' . $carta['id'] . '</td>'; 
        $html .= '<td>' . $carta['nombre'] . '</td>'; 
        $html .= '<td>' . $carta['ataque'] . '</td>'; 
        $html .= '<td>' . $carta['defensa'] . '</td>'; 
        $html .= '<td>' . $carta['poder_especial'] . '</td>'; 
        $html .= '<td><img height="60px" src="./uploads/imagenes/' . $carta['img'] . '"></td>'; // Ajustar según sea necesario
        $html .= '</tr>';
    }

    $html .= '</table></body></html>';

    $pdf->writeHTML($html, true, false, true,'');

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

            
        <?php 
        
        $cartasDB = new CartasBD();
        $cartasDB->obtenerCartas();

        ?>

        <br><br>
        <form method="POST">
            <button type="submit">Descargar PDF</button>
        </form>
       


        </section>
    </main>
</body>
</html>