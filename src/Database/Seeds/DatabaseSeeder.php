<?php
namespace Yahyya\bookstore\Database\Seeds;
use Illuminate\Database\Seeder;
use Yahyya\bookstore\Database\Seeds\AuthorSeeder;
use Yahyya\bookstore\Database\Seeds\BookSeeder;
use Yahyya\bookstore\Database\Seeds\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
        $this->call(AuthorSeeder::class);
         $this->call(BookSeeder::class);
    }
}
