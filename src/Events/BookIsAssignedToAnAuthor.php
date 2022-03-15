<?php

namespace Yahyya\taskmanager\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Yahyya\bookstore\App\Models\Book;

class BookIsAssignedToAnAuthor
{
    use Dispatchable,SerializesModels;

    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
}
