<?php

namespace App\Http\Controllers\PPB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Workflow;
use App\Services\Workflow\PPBWorkflow;

class PPBController extends Controller
{

    public function __construct()
    {

    }

    public function ratificacion( Request $request) {

       //return $workflow->activarEtapa('ratificacion',2,120,json_encode(['Rodolfo','predio_1234']));
       //return Workflow::iniciarCaso();
       return Workflow::activarEtapa('ratificacion',2,120,json_encode(['Rodolfo','predio_1234']));
    }

    public function calcularIncentivo( Request $request) {
        //return $workflow->iniciarCaso();
        return Workflow::activarEtapa('calcula_incentivo',1,120,json_encode(['Rodolfo','predio_1234']));
     }


}