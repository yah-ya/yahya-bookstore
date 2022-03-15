<?php

namespace Tests\Unit;

use Yahyya\bookstore\App\Http\Controllers\BookController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Yahyya\bookstore\App\Http\Middleware\CheckAuthToken;
use Yahyya\bookstore\App\Http\Requests\StoreBook;
use Yahyya\bookstore\App\Models\Author;
use Yahyya\bookstore\App\Models\Book;
use Yahyya\bookstore\App\Models\User;
use Yahyya\bookstore\App\Repositories\BookRepository;
use Yahyya\bookstore\App\Http\Requests\UpdateBook;
use Yahyya\bookstore\App\Repositories\ReserveRepository;
use Yahyya\bookstore\Database\Seeds\DatabaseSeeder;


class BookTest extends TestCase
{

    use RefreshDatabase;

    private $user = null;
    private $request =  null;
    private $bookController = null;
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->request = new Request();
        $this->user = $this->checkUserAuthorization();
        $this->bookController = new BookController(new BookRepository(),new ReserveRepository());

    }

    private function authorizeToken(string $token)
    {

        $this->request->headers->set('Authorization', 'Bearer ' . $token);

        $middleware = new CheckAuthToken();
        $response = $middleware->handle($this->request, function () {
            return response()->json(['message' => 'Authorized'], 200);
        });
        return $response;
    }

    private function checkUserAuthorization()
    {
        // Authorized user :
        $user = factory(User::class)->create();
        $authResponse = $this->authorizeToken($user->api_token);
        $this->assertEquals($authResponse->getStatusCode(), 200);
        return $user;
    }

    public function test_user_has_api_token_column()
    {
        $user = factory(User::class)->create();
        $this->assertIsString($user->api_token);
    }

    public function test_user_authentication()
    {
        //check if user can not login with fake/null token
        $token = Hash::make('1234');

        $authReponse = $this->authorizeToken($token);
        $this->assertEquals($authReponse->getStatusCode(), 403);

        // Correct assertion with correct api token :
        $user = factory(User::class)->create();
        $authResponse = $this->authorizeToken($user->api_token);

        $this->assertEquals($authResponse->getStatusCode(), 200);
        $this->assertTrue(Auth::check());
    }

    public function test_user_can_add_new_book()
    {
        $request = new StoreBook();
        $author = factory(Author::class)->create();
        $request->merge(['title' => 'Test Book', 'author_id' => $author->id, 'amount' => rand(0,1000), 'short_desc' => 'Test Book Desc']);
        $request->setContainer(app())->validateResolved();
        $this->assertEquals($this->bookController->store($request)->getStatusCode(),200);
    }

    public function test_user_can_update_a_book()
    {
        $book = factory(Book::class)->create();
        $request = new UpdateBook();
        $request->merge(['title' => 'Changed', 'short_desc' => 'Changed']);
        $request->setContainer(app())->validateResolved();
        $this->assertEquals($this->bookController->update($request, $book)->getStatusCode(),200);
        $this->assertEquals(Book::find($book->id)->title, 'Changed');
        $this->assertEquals(Book::find($book->id)->short_desc, 'Changed');
    }

    public function test_user_can_remove_a_book()
    {
        $book = factory(Book::class)->create();
        $this->assertEquals($this->bookController->destroy( $book->id)->getStatusCode(),200);
    }

    public function test_user_can_view_a_book()
    {
        $book = factory(Book::class)->create();
        $this->assertEquals($this->bookController->show( $book->id)->getStatusCode(),200);
    }

    public function test_user_can_add_an_author_to_a_book()
    {
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $author2 = factory(Author::class)->create();

        $this->bookController->setAuthor($author->id,$book);
        $this->bookController->setAuthor($author2->id,$book);
        $book = Book::find($book->id);

        $this->assertEquals($book->authors->count(),2);
    }

    public function test_user_can_remove_an_author_from_a_book()
    {
        $book = factory(Book::class)->create();
        $author = factory(Author::class)->create();
        $author2 = factory(Author::class)->create();

        $this->bookController->setAuthor($author->id,$book);
        $this->bookController->setAuthor($author2->id,$book);
        $book = Book::find($book->id);
        $this->assertEquals($book->authors->count(),2);

        $this->bookController->removeAuthor($author->id,$book);
        $book = Book::find($book->id);
        $this->assertEquals($book->authors->count(),1);
    }


    public function test_user_can_get_list_of_books_with_authors()
    {
        $this->seed(DatabaseSeeder::class);
        $this->assertEquals(100,$this->bookController->index()->count());
        $this->assertNotEmpty($this->bookController->index()[0]->authors);
    }

    public function test_user_can_reserve_a_book()
    {
        $this->seed(DatabaseSeeder::class);
//        $this->request->merge();
        $req = $this->bookController->reserve($this->bookController->index()[rand(0,100)]->id,$this->request);
        $this->assertEquals($req->getStatusCode(),200);

        $this->request->merge(['quantity'=>300]);
        $req = $this->bookController->reserve($this->bookController->index()[rand(0,100)]->id,$this->request);
        $this->assertEquals($req->getStatusCode(),402);
    }


}
