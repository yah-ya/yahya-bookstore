<?php
namespace Yahyya\bookstore\Database\Seeds;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Yahyya\bookstore\App\Models\Author::class,100)->create()->each(function($author){
        });
    }
}
