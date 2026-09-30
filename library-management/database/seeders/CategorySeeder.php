<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction',      'description' => 'Imaginative and invented narratives.'],
            ['name' => 'Non-Fiction',  'description' => 'Factual accounts and real-world topics.'],
            ['name' => 'Science',      'description' => 'Books covering scientific discoveries and concepts.'],
            ['name' => 'History',      'description' => 'Historical events and civilizations.'],
            ['name' => 'Biography',    'description' => 'Life stories of real people.'],
            ['name' => 'Technology',   'description' => 'Computing, software, and modern tech.'],
            ['name' => 'Philosophy',   'description' => 'Philosophical thought and ethics.'],
            ['name' => 'Psychology',   'description' => 'Human behavior and mental processes.'],
            ['name' => 'Self-Help',    'description' => 'Personal development and productivity.'],
            ['name' => 'Mystery',      'description' => 'Crime, suspense, and detective stories.'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => $cat['description'],
            ]);
        }
    }
}
