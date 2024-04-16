<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $entradas = Blog::get(2);
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'entradas' => $entradas
        ]);
    }

    public static function nosotros(Router $router){
        
        
        $router->render('paginas/nosotros', []);
    }

    public static function propiedades(Router $router){
        
        $propiedades = Propiedad::all();
        
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        
        $id = validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        
        $entradas = Blog::all();
        
        $router->render('paginas/blog', [
            'entradas' => $entradas
        ]);
    }

    public static function entrada(Router $router){
        
        $id = validarORedireccionar('/blog');

        $entrada = Blog::find($id);

        $router->render('paginas/entrada', [
            'entrada' => $entrada
        ]);
    }

    public static function contacto(Router $router){

        $mensaje = null;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '601ed02b158eda';
            $mail->Password = '5df0ca4d169abf';
            $mail->SMTPSecure = 'tls';

            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<h1>Tienes un nuevo mensaje</h1>';
            $contenido .= '<p><b>Nombre: </b>' . $respuestas['nombre'] . '</p>';

            //Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p><b>Eligió ser contactado por Teléfono: </b>' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p><b>Fecha de contacto: </b>' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p><b>Hora de contacto: </b>' . $respuestas['hora'] . '</p>';
            } else{
                //Es email, entonces agregamos el campo de email
                $contenido .= '<p><b>Eligió ser contactado por Correo Electrónico: </b>' . $respuestas['email'] . '</p>';
            }

            
            $contenido .= '<p><b>Mensaje: </b>' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p><b>Vende o Compra: </b>' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p><b>Precio o Presupuesto: </b>$' . $respuestas['precio'] . '</p>';

            $contenido .= '</html>';

            $mail->Body = $contenido;

            //Enviar el email
            if($mail->send()){
                $mensaje = "mensaje enviado correctamente";
            } else{
                $mensaje = "mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}