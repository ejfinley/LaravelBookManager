<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'author' => 'Jane Austen',
            'title' => 'Pride and Prejudice'
        ]);
        DB::table('books')->insert([
            'author' => 'Lewis Carroll',
            'title' => 'Alice\'s Adventures in wonderland'
        ]);
        DB::table('books')->insert([
            'author' => 'Mark Twain',
            'title' => 'Adventures of Tom Sawyer'
        ]);
    }
}
