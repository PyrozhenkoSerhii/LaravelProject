<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(DictionarySeeder::class);

    }
}
class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(App\User::class,10)->create();
    }
}

class PostsSeeder extends Seeder
{
    public function run()
    {
        factory(App\Post::class,15)->create();
    }
}
class CommentSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Comment::class,6)->create();
    }
}

class DictionarySeeder extends Seeder
{
    public function run()
    {
        factory(\App\Dictionary::class,100)->create();
    }
}