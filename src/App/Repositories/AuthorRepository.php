<?php

namespace Yahyya\bookstore\App\Repositories;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Interfaces\AuthorRepositoryInterface;
use Yahyya\bookstore\App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{

   public function list():Collection
   {
       return Author::with('books')->get();
   }
}
