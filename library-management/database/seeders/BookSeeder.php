<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => '1984',                       'isbn' => '9780451524935', 'author' => 'George Orwell',        'category' => 'Fiction',    'publisher' => 'Secker & Warburg',     'year' => 1949, 'copies' => 5, 'description' => 'A dystopian novel set in a totalitarian society ruled by Big Brother.'],
            ['title' => 'Animal Farm',                 'isbn' => '9780451526342', 'author' => 'George Orwell',        'category' => 'Fiction',    'publisher' => 'Secker & Warburg',     'year' => 1945, 'copies' => 4, 'description' => 'An allegorical novella about a farm where animals revolt.'],
            ['title' => "Harry Potter and the Philosopher's Stone", 'isbn' => '9780439708180', 'author' => 'J.K. Rowling', 'category' => 'Fiction', 'publisher' => 'Bloomsbury', 'year' => 1997, 'copies' => 6, 'description' => 'A young boy discovers he is a wizard and attends Hogwarts School.'],
            ['title' => 'Sapiens',                     'isbn' => '9780062316097', 'author' => 'Yuval Noah Harari',    'category' => 'History',    'publisher' => 'Harper Collins',       'year' => 2011, 'copies' => 4, 'description' => 'A brief history of humankind from the Stone Age to the present.'],
            ['title' => 'Homo Deus',                   'isbn' => '9780062464316', 'author' => 'Yuval Noah Harari',    'category' => 'History',    'publisher' => 'Harper Collins',       'year' => 2015, 'copies' => 3, 'description' => 'A brief history of tomorrow and the future of humanity.'],
            ['title' => 'Murder on the Orient Express','isbn' => '9780062693662', 'author' => 'Agatha Christie',      'category' => 'Mystery',    'publisher' => 'Collins Crime Club',   'year' => 1934, 'copies' => 3, 'description' => 'Poirot investigates a murder aboard a luxury train.'],
            ['title' => 'A Brief History of Time',     'isbn' => '9780553380163', 'author' => 'Stephen Hawking',      'category' => 'Science',    'publisher' => 'Bantam Books',         'year' => 1988, 'copies' => 4, 'description' => 'An exploration of cosmology and the nature of the universe.'],
            ['title' => 'Beloved',                     'isbn' => '9781400033416', 'author' => 'Toni Morrison',        'category' => 'Fiction',    'publisher' => 'Alfred A. Knopf',      'year' => 1987, 'copies' => 2, 'description' => 'A former enslaved woman is haunted by the ghost of her daughter.'],
            ['title' => 'Outliers',                    'isbn' => '9780316017930', 'author' => 'Malcolm Gladwell',     'category' => 'Psychology', 'publisher' => 'Little, Brown',        'year' => 2008, 'copies' => 5, 'description' => 'The story of success and what makes high-achievers different.'],
            ['title' => 'Dune',                        'isbn' => '9780441013593', 'author' => 'Frank Herbert',        'category' => 'Fiction',    'publisher' => 'Chilton Books',        'year' => 1965, 'copies' => 4, 'description' => 'Epic science fiction set on the desert planet Arrakis.'],
            ['title' => 'Americanah',                  'isbn' => '9780307455925', 'author' => 'Chimamanda Ngozi Adichie', 'category' => 'Fiction', 'publisher' => 'Knopf',             'year' => 2013, 'copies' => 3, 'description' => 'A young Nigerian woman emigrates to the US and navigates race and identity.'],
            ['title' => 'The Da Vinci Code',           'isbn' => '9780385504201', 'author' => 'Dan Brown',            'category' => 'Mystery',    'publisher' => 'Doubleday',            'year' => 2003, 'copies' => 6, 'description' => 'A symbologist unravels a mystery hidden in Leonardo da Vinci\'s artwork.'],
        ];

        foreach ($books as $data) {
            $author   = Author::where('name', $data['author'])->first();
            $category = Category::where('name', $data['category'])->first();

            if (!$author || !$category) {
                continue;
            }

            Book::create([
                'title'            => $data['title'],
                'isbn'             => $data['isbn'],
                'author_id'        => $author->id,
                'category_id'      => $category->id,
                'description'      => $data['description'],
                'publisher'        => $data['publisher'],
                'published_year'   => $data['year'],
                'total_copies'     => $data['copies'],
                'available_copies' => $data['copies'],
                'status'           => 'available',
            ]);
        }

        // Extra random books
        Book::factory(20)->available()->create();
    }
}
