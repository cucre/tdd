<?php   

namespace App\Repositories\Eloquent;   

use App\Interfaces\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
    
    /**
    * @param array $attributes
    * @param $id
    *
    * @return Model
    */
    public function update(array $attributes, $id): ?Model
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);

        return $record;
    }

    /**
    * @param $id
    *
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
    * @param $id
    *
    * @return void
    */
    public function delete($id): void
    {
        $this->model->destroy($id);
    }

    /**
    * @return Model
    */
    public function getModel(): ?Model
    {
        return $this->model;
    }

    /**
    * @param array $relations
    *
    * @return Model
    */
    public function with(array $relations): ?Model
    {
        return $this->model->with($relations);
    }
}