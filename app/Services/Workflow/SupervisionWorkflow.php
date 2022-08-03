<?php

namespace App\Services\Workflow;

use App\Services\Workflow\IWorkflow;


class SupervisionWorkflow implements IWorkflow {

    private $etapa;
    private $caso;
    private $tokens;

    public function __construct($filtros) {
        // Se procesa n los filtros para obtener
        // la información del caso en cuestión
        $this->caso = 23;
        $this->etapa = 7;
        $this->tokens = [];
    }

    public function iniciarCaso() {
          return "Se inicia caso en el flujo de Supervisión";
    }

    public function irEtapa($etapa) {
          $this->$etapa = $etapa;
          return "Cambiando a la etapa ".$etapa. " del flujo de Supervisión";
    }

    public function cargarTokensEtapa() {

          $this->tokens = ["Caso:".$this->caso,
                           "Etapa:".$this->etapa,
                           "MuestraUnica: 245",
                           "Folio: PIMAF_123456",
                           "Folio: PIMAF_865842"
                          ];
          return "Los tokens de Supervision para el caso". $caso .
                 " y la etapa ".$this->etapa.
                 " son: ".json_encode($this->tokens);
    }

    public function ejecutarAccion($accion) {
          return "Se ejecutó la acción: ".$accion. " del flujo de supervisión";
    }

    public function activarEtapa($evento,$etapa,$caso,$contexto) {
      return "En Supervisión se ejecuta el evento: ".$evento.
             ", de la etapa: ".$etapa.", caso: ".$caso." con el contexto: ".
             $contexto;
    }
}