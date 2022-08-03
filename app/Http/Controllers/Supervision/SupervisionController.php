<?php

namespace App\Http\Controllers\Supervision;

use App\Http\Controllers\Controller;
//use App\Services\Workflow\IWorkflow;
use Illuminate\Http\Request;
use Workflow;

class SupervisionController extends Controller
{

    public function __construct()
    {

    }

    public function crearCuestionario(Request $request) {
       //return $this->workflow->activarEtapa('crear_cuestionario',4,5,json_encode(['Pepe','pregunta_1','pregunta_2']));
       return Workflow::activarEtapa('crear_cuestionario',4,5,json_encode(['Pepe','pregunta_1','pregunta_2']));
    }


}