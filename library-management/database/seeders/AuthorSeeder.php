<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'George Orwell',       'email' => 'gorwell@example.com',     'nationality' => 'British',    'birth_date' => '1903-06-25', 'bio' => 'English novelist and essayist, known for Nineteen Eighty-Four and Animal Farm.'],
            ['name' => 'J.K. Rowling',         'email' => 'jkrowling@example.com',   'nationality' => 'British',    'birth_date' => '1965-07-31', 'bio' => 'Author of the Harry Potter fantasy series.'],
            ['name' => 'Yuval Noah Harari',    'email' => 'yharari@example.com',     'nationality' => 'Israeli',    'birth_date' => '1976-02-24', 'bio' => 'Historian and author of Sapiens and Homo Deus.'],
            ['name' => 'Agatha Christie',      'email' => 'achristie@example.com',   'nationality' => 'British',    'birth_date' => '1890-09-15', 'bio' => 'Queen of mystery fiction, creator of Hercule Poirot.'],
            ['name' => 'Stephen Hawking',      'email' => 'shawking@example.com',    'nationality' => 'British',    'birth_date' => '1942-01-08', 'bio' => 'Theoretical physicist and author of A Brief History of Time.'],
            ['name' => 'Toni Morrison',        'email' => 'tmorrison@example.com',   'nationality' => 'American',   'birth_date' => '1931-02-18', 'bio' => 'Nobel Prize-winning American novelist.'],
            ['name' => 'Malcolm Gladwell',     'email' => 'mgladwell@example.com',   'nationality' => 'Canadian',   'birth_date' => '1963-09-03', 'bio' => 'Author and journalist known for Outliers and The Tipping Point.'],
            ['name' => 'Frank Herbert',        'email' => 'fherbert@example.com',    'nationality' => 'American',   'birth_date' => '1920-10-08', 'bio' => 'Science fiction author of the Dune saga.'],
            ['name' => 'Chimamanda Ngozi Adichie', 'email' => 'cadichie@example.com', 'nationality' => 'Nigerian', 'birth_date' => '1977-09-15', 'bio' => 'Nigerian author known for Americanah and Half of a Yellow Sun.'],
            ['name' => 'Dan Brown',            'email' => 'dbrown@example.com',      'nationality' => 'American',   'birth_date' => '1964-06-22', 'bio' => 'Bestselling thriller author, known for The Da Vinci Code.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }

        // Extra random authors
        Author::factory(10)->create();
    }
}
