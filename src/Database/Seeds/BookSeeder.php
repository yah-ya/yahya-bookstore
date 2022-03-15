<?php
namespace Yahyya\bookstore\Database\Seeds;
use Illuminate\Database\Seeder;
use Yahyya\bookstore\App\Models\Author;
use Yahyya\bookstore\App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class,100)->create()->each(function($book){
            $book->authors()->save(Author::query()->inRandomOrder()->first());
        });
    }
}
