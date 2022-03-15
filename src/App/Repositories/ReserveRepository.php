<?php

namespace Yahyya\bookstore\App\Repositories;

use Illuminate\Support\Collection;
use Yahyya\bookstore\App\Interfaces\ReserveRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Models\Reserve;

class ReserveRepository implements ReserveRepositoryInterface
{

    public function getByBookId(int $bookId):Collection
    {
        $reserves = Reserve::where('book_id',$bookId)->where('status','0')->get();
        return $reserves;
    }

    public function getTotalReservedByBookId(int $bookId):int
    {
        $reserves = Reserve::where('book_id',$bookId)->where('status','0')->sum('quantity');
        return $reserves;
    }
    public function store(int $userId, Book $book, int $quantity=1):Reserve
    {

        $reserve = new Reserve();
        $reserve->user_id = $userId;
        $reserve->quantity = $quantity;
        $reserve->book_id = $book->id;
        $reserve->status = 0;
        $reserve->save();

        return $reserve;
    }
}
