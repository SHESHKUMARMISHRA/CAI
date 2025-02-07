# CAI
Candidate API Integration

--------------------------------------

Setup 

composer create-project laravel/laravel candidate-api-integration

# Navigate to project folder
cd candidate-api-integration

# Install HTTP client for API interactions
composer require guzzlehttp/guzzle

# Create API Client Service
php artisan make:service ApiService

# Run migrations
# php artisan migrate 

# Add new author >>  Run below CLI command
eg.
php artisan author:add "Shesh" "Mishra" "2025-02-07T16:39:11.213Z" "Developer" "male" "India"
