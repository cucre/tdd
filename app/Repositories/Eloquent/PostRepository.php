<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Eloquent\BaseRepository;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
    * PostRepository constructor.
    *
    * @param Post $model
    */
    public function __construct(Post $model)
    {
       parent::__construct($model);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
       return $this->model->all();    
    }
}