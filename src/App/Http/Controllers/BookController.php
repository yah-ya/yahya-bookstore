<?php

namespace Yahyya\bookstore\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yahyya\bookstore\App\Http\Requests\StoreBook;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\taskmanager\App\Http\Resources\BookCollection;

class BookController extends Controller
{
    private BookRepositoryInterface $repo;
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->repo = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return BookCollection
     */
    public function index()
    {
        return new BookCollection( $this->repo->list());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(StoreBook $req)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $details = $request->validated();
        return response()->json(
            [
                'res'=>$this->repo->store($details)
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->repo->getById($id);
        return response()->json(['res'=>true,'data'=>new \Yahyya\bookstore\App\Http\Resources\Book($book)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $details = $request->validated();
        return response()->json(
            [
                'res'=>$this->repo->update($book, $details)
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(['res'=>$this->repo->delete($book)]);
    }
}
