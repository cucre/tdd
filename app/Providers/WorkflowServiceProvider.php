<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Workflow\IWorkflow;
use App\Services\Workflow\PPBWorkflow;
use App\Services\Workflow\SupervisionWorkflow;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('workflow', function ($app) {
        //$this->app->singleton(IWorkflow::class, function ($app) {
          $filtros = [
                       "taxonomia" => 704,
                       "delegacion" => 2
                     ];
          //xdebug_break();
          if(str_contains(request()->url(),"ppb")) {
              return new PPBWorkflow($filtros);
          } else {
              return new SupervisionWorkflow($filtros);
          }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
