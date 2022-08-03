<?php

namespace App\Services\Workflow;

interface IWorkflow {

    public function iniciarCaso();

    public function irEtapa($etapa);

    public function cargarTokensEtapa();

    public function ejecutarAccion($accion);

    public function activarEtapa($event,$etapa,$caso,$contexto);

}