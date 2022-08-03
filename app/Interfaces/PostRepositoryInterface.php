<?php
namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
   /**
    * @return Collection
    */
   public function all(): Collection;
}