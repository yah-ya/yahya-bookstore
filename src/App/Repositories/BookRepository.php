<?php

namespace Yahyya\bookstore\App\Repositories;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Models\BookAuthors;

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

    public function deleteById(int $bookId): bool
    {
        try {
            $book = Book::findOfFail($bookId);
            $book->delete();
            return true;
        } catch (\Exception $ex){
            return false;
        }
    }

    public function assignNewAuthor(int $authorId,Book $book): bool
    {
        BookAuthors::insert(['author_id'=>$authorId,'book_id'=>$book->id]);
        return true;
    }

    public function removeAuthor(int $authorId, Book $book): bool
    {
        $bookAuthors = BookAuthors::where('author_id',$authorId)->where('book_id',$book->id);
        $bookAuthors->delete();
        return true;
    }
}
