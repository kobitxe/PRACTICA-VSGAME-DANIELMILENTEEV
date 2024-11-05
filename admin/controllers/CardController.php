<?php 
 require_once __DIR__ . "/../models/Cards.php";
 require __DIR__ . '/../vendor/autoload.php';
 require_once __DIR__ . '/../config/config.php';

 Class CardController {

    public function cardList() {

        if(isset($_GET['mensaje'])){$mensaje =  $_GET['mensaje'];}
        
        include __DIR__ . "/../views/Cards/cards.php";

    }

    public function anyadircarta() {

        if(isset($_GET['mensaje'])){$mensaje =  $_GET['mensaje'];}

        include __DIR__ . "/../views/Cards/cardAdd.php";
    }

    public function editarcarta(){

        
        include __DIR__ . "/../views/Cards/cardEdit.php";
    }

    public function procesar_anyadir_carta(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (!empty($_POST['nombre']) && !empty($_POST['ataque']) && !empty($_POST['defensa']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
            
                $nombre = $_POST['nombre'];
                $ataque = $_POST['ataque']; 
                $defensa = $_POST['defensa'];
                $poder_especial = $_POST['poder_especial'];

                $ruta_temporal = $_FILES['img']['tmp_name'];
                $nombre_imagen = basename($_FILES['img']['name']);

                $ruta_final = 'C:/wamp64/www/DAW/VSGAME-MVC-DANIELMILENTEEV/admin/views/Cards/uploads/imagenes/' . $nombre_imagen;

                var_dump($ruta_final);

                move_uploaded_file($ruta_temporal, $ruta_final);
        
                $cartasDB = new CartasBD();
                $anyadir = $cartasDB->insertarCarta($nombre, $ataque, $defensa, $poder_especial, $nombre_imagen);
         
                if ($anyadir){
                    header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList&mensaje=Carta insertada correctamente.");
                    exit;
                }
        
                else {
                    header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=anyadircarta&mensaje=Error al insertar carta.");
                    exit;
                }
                
            } 
            
            else {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=anyadircarta&mensaje=Todos los campos son obligatorios, intentelo de nuevo.");
                exit;
            }
        }

    }

    public function procesar_eliminar_carta(){

            $id = $_GET['id'];

            $cardDB = new CartasBD();
            $eliminar = $cardDB->EliminarCarta($id);
            
            if ($eliminar){
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList&mensaje=Carta borrada correctamente.");
                exit;
            }
        
            else {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList&mensaje=Error al borrar carta.");
                exit;
            }
        
    }

    public function procesar_editar_carta() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id']; 
            $nombre = $_POST['new_nombre'];  
            $ataque = $_POST['new_ataque'];  
            $defensa = $_POST['new_defensa'];  
            $poder_especial = $_POST['new_poderespecial'];  
            
            //Si hay imagen nueva al editar se sube a uploads.
        
            if ($_FILES['new_img']['name'] != "") {
        
                $ruta_temporal = $_FILES['new_img']['tmp_name']; 
                $imagen = basename($_FILES['new_img']['name']); 
                $ruta_final = 'C:/wamp64/www/DAW/VSGAME-MVC-DANIELMILENTEEV/admin/views/Cards/uploads/imagenes/' . $imagen;
                move_uploaded_file($ruta_temporal, $ruta_final);
          
            }
        
            //Si la imagen no cambia se queda la que ya estaba.
        
            else {
                $imagen = $_POST['old_img'];
            }
        
            if (empty($nombre) || empty($ataque) || empty($defensa)) {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=editarcarta&mensaje_error=Complete todos los campos necesarios.&id=" . $id);
                exit;
            }
        
            $cartasDB = new CartasBD();
            $update = $cartasDB->ActualizarCarta($id, $nombre, $ataque, $defensa, $poder_especial, $imagen);
                
            if ($update) {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList&mensaje=Carta editada correctamente.");
                exit;
            }
            else {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList&mensaje=Error al actualizar la carta.");
                exit;
            }
        
        }

    }

    public function Hacer_PDF() {

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
        $html .= '<td><img height="50px" src="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/views/Cards/uploads/imagenes/' . $carta['img'] . '"></td>'; 
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

    public function MostrarCartaPorID($id){

        $cartasDB = new CartasBD();
        $carta_encontrada = $cartasDB->obtenerCartaPorID($id);

        if ($carta_encontrada) {

            echo '<h2>Carta con ID ' . $carta_encontrada['id'] . '</h2>';
            if(isset($_GET['mensaje_error'])){echo "<a>" . $_GET['mensaje_error'] . "</a>";}
            echo '<form action="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=procesar_editar_carta" method="POST" enctype="multipart/form-data">'; 
            echo '<input type="hidden" name="id" value="' . $carta_encontrada['id'] . '">';
            echo '<input type="hidden" name="old_img" value="' . $carta_encontrada['img'] . '">';

            echo '<label for="new_nombre">Nombre:</label> ';
            echo '<input type="text" id="new_nombre" name="new_nombre" value="' . $carta_encontrada['nombre'] . '">';

            echo '<label for="new_ataque">Ataque:</label> ';
            echo '<input type="text" id="new_ataque" name="new_ataque" value="' . $carta_encontrada['ataque'] . '">';

            echo '<label for="new_defensa">Defensa:</label> ';
            echo '<input type="text" id="new_defensa" name="new_defensa" value="' . $carta_encontrada['defensa'] . '">';

            echo '<label for="new_poderespecial">Poder Especial:</label> ';
            echo '<input type="text" id="new_poderespecial" name="new_poderespecial" value="' . $carta_encontrada['poder_especial'] . '">';

            echo '<label for="img">Imagen:</label> ';
            echo '<input type="file" name="new_img" id="img" accept="image/*">';

            echo '<br><br><img height="200px" src="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/views/Cards/uploads/imagenes/' . $carta_encontrada['img'] . '">';

            echo '<br><br> <button type="submit">Aplicar cambios</button>';
            echo '</form>';

            return 1;

        } 
        
        else {
            echo '<p>Carta no encontrada.</p>';
            echo '<a href="cardEdit.php">Editar otra carta</a>';
            
            return 0;
        }

    }

    public function mostrarCartas(){
        $cartasDB = new CartasBD();
        $cartasDB->obtenerCartas();
    }

 }
 
 ?>