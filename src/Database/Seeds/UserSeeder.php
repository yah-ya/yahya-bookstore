<?php
namespace Yahyya\bookstore\Database\Seeds;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\Yahyya\bookstore\App\Models\User::class,100)->create()->each(function($user){

        });
    }
}
