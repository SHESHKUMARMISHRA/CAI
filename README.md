# CAI
Candidate API Integration

--------------------------------------

Setup 

composer create-project laravel/laravel candidate-api-integration

# Navigate to project folder
cd candidate-api-integration

# Install Livewire
composer require livewire/livewire

# Install HTTP client for API interactions
composer require guzzlehttp/guzzle

# Generate auth scaffolding (optional if using Laravel Breeze or Jetstream)
php artisan make:livewire auth.login

# Create models and migrations
php artisan make:model Author -m
php artisan make:model Book -m
php artisan make:model User -m

# Define relationships in models

// app/Models/Author.php
class Author extends Model {
    public function books() {
        return $this->hasMany(Book::class);
    }
}

// app/Models/Book.php
class Book extends Model {
    public function author() {
        return $this->belongsTo(Author::class);
    }
}

# Migrations setup

// database/migrations/create_authors_table.php
Schema::create('authors', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});

// database/migrations/create_books_table.php
Schema::create('books', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->foreignId('author_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

# Create API Client Service
php artisan make:service ApiService

# Create Livewire Components
php artisan make:livewire AuthorsTable
php artisan make:livewire AuthorView
php artisan make:livewire BooksTable
php artisan make:livewire Profile

# Run migrations
php artisan migrate

