<?php

namespace Yahyya\bookstore\App\Repositories;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function store(array $details):bool
    {
        try {
            Book::create($details);
            return true;
        } catch (\Exception $ex){
            return false;
        }
    }

    public function list():Collection
    {
        return Book::all();
    }

    public function update(Book $book,array $details): bool
    {
        try {
            $book->update($details);
            return true;
        } catch (\Exception $ex){
            return false;
        }
    }

    public function getById(int $bookId): Book
    {
        $book = Book::findOrFail($bookId);
        return $book;
    }

    public function delete(Book $book): bool
    {
        try {
            $book->delete();
            return true;
        } catch (\Exception $ex){
            return false;
        }
    }
}
