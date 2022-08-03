<?php

namespace App\Services\Workflow;

use App\Services\Workflow\IWorkflow;

class PPBWorkflow implements IWorkflow {

    private $etapa;
    private $caso;
    private $tokens;

    public function __construct($filtros) {
        // Se procesa n los filtros para obtener
        // la información del caso en cuestión
        $this->caso  = 17;
        $this->etapa = 5;
        $this->tokens = [];
    }

    public function iniciarCaso() {
          return "Se inicia caso en el flujo de PPB";
    }

    public function irEtapa($etapa) {
          $this->$etapa = $etapa;
          return "Cambiando a la etapa ".$etapa. " del flujo de PPB";
    }

    public function cargarTokensEtapa() {

          $this->tokens = [ "Caso:".$this->caso,
                            "Etapa:".$this->etapa,
                            "PREDIO_13456",
                            "PRODUCTOR_JUAN_ANTONIO"];
          return "Los tokens de PPB para el caso". $caso .
                 " y la etapa ".$this->etapa.
                 " son: ".json_encode($this->tokens);
    }

    public function ejecutarAccion($accion) {
          return "Se ejecutó la acción: ".$accion. " del flujo de  PPB";
    }

    public function activarEtapa($evento,$etapa,$caso,$contexto) {
         return "En PPB se ejecuta el evento: ".$evento.
                ", de la etapa: ".$etapa.", caso: ".$caso." con el contexto: ".
                $contexto;
    }
}