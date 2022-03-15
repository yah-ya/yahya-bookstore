<?php

namespace Yahyya\bookstore\App\Interfaces;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Models\Reserve;

interface ReserveRepositoryInterface
{
    public function getByBookId(int $bookId):Collection;
    public function store(int $userId,Book $book,int $quantity=1):Reserve;
}
