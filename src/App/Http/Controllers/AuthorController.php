<?php

namespace Yahyya\bookstore\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yahyya\bookstore\App\Http\Requests\StoreBook;
use Yahyya\bookstore\App\Http\Resources\AuthorCollection;
use Yahyya\bookstore\App\Interfaces\BookRepositoryInterface;
use Yahyya\bookstore\App\Interfaces\ReserveRepositoryInterface;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Http\Resources\BookCollection;
use Yahyya\bookstore\App\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    private AuthorRepository $repo;
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->repo = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        return response()->json(new AuthorCollection( $this->repo->list())) ;
    }

}
