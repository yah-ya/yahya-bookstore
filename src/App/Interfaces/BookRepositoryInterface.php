<?php

namespace Yahyya\bookstore\App\Interfaces;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Models\Book;

interface BookRepositoryInterface
{
    public function store(array $details):bool;
    public function update(Book $book,array $details):bool;
    public function list():Collection;
    public function getById(int $bookId):Book;
    public function deleteById(int $bookId):bool;
    public function assignNewAuthor(int $authorId,Book $book):bool;
    public function removeAuthor(int $authorId,Book $book):bool;
}
