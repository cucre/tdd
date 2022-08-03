<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
*
* @package App\Interfaces
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    *
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    *
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param $attributes
    * @param $id
    *
    * @return Model
    */
   public function update(array $attributes, $id): ?Model;

    /**
    * @param $id
    *
    * @return void
    */
   public function delete($id): void;

   /**
    * @param array $relations
    *
    * @return Model
    */
    public function with(array $relations): ?Model;

    /**
    * @return Model
    */
    public function getModel(): ?Model;
}