<?php

class Staff {
    private $cod_pers;
    private $nombre;

    public function __construct($cod_pers, $nombre) {
        $this->cod_pers = $cod_pers;
        $this->nombre = $nombre;
    }

    // Métodos de set
    public function setCodPers($cod_pers) {
        $this->cod_pers = $cod_pers;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Métodos de get
    public function getCodPers() {
        return $this->cod_pers;
    }

    public function getNombre() {
        return $this->nombre;
    }
}
