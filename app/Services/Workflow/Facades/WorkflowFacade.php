<?php

namespace App\Services\Workflow\Facades;

use Illuminate\Support\Facades\Facade;

class WorkflowFacade extends Facade {

     protected static function getFacadeAccessor() {
         return 'workflow';
         //return 'IWorkflow';
     }
}