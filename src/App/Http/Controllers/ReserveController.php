<?php

namespace Yahyya\bookstore\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yahyya\bookstore\App\Http\Requests\StoreBook;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Interfaces\ReserveRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Http\Resources\BookCollection;

class ReserveController extends Controller
{
    private ReserveRepositoryInterface $repo;
    public function __construct(ReserveRepositoryInterface $reserveRepo)
    {
        $this->repo = $reserveRepo;
    }

    public function reserve(Book $book,$request)
    {
        $quantity = empty($request->quantity) ? 1 : $request->quantity;
        $totalReserved = $this->repo->getTotalReservedByBookId($book->id);


        if($totalReserved + $quantity > $book->stock )
        {
            return response()->json(['res'=>false,'msg'=>'This book is not in stock'],402);
        }


        $reserve = $this->repo->store(Auth::user()->id,$book,$quantity);
        return response()->json(['res'=>true,'data'=>$reserve]);
    }
}
