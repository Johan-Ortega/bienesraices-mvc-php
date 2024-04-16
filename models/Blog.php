<?php

namespace Model;

class Blog extends ActiveRecord{
    protected static $tabla = 'blog';

    protected static $columnasDB = ['id', 'titulo', 'fecha', 'imagen', 'descripcion'];

    public $id;
    public $titulo;
    public $fecha;
    public $imagen;
    public $descripcion;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = date('Y-m-d');
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
    }
}