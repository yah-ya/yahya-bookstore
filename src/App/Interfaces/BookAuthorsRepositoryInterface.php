<?php

namespace Yahyya\bookstore\App\Interfaces;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Models\Author;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Models\BookAuthors;

interface BookAuthorsRepositoryInterface
{
    public function store(Book $book,Author $author):bool;
    public function update(BookAuthors $bookAuthor,array $details):bool;
    public function getByAuthor(Author $author):Collection;
    public function getByBook(Book $author):Collection;
    public function delete(BookAuthors $bookAuthor):bool;
}
