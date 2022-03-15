<?php

namespace Yahyya\bookstore\App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['title','author_id','short_desc','amount'];

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
