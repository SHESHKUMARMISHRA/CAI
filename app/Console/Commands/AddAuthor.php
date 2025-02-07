<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;



class AddAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:add 
                            {first_name} 
                            {last_name} 
                            {birthday} 
                            {biography} 
                            {gender} 
                            {place_of_birth}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new author via API';

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    public function handle()
    {
        $token = \Cache::get('api_token');

        if (!$token) {
            $this->error('API Token is missing. Please log in.');
            return;
        }

        $this->info("Using API Token: " . substr($token, 0, 10) . "...");
        // Collect arguments
        $data = [
            'first_name'    => $this->argument('first_name'),
            'last_name'     => $this->argument('last_name'),
            'birthday'      => $this->argument('birthday'),
            'biography'     => $this->argument('biography'),
            'gender'        => $this->argument('gender'),
            'place_of_birth' => $this->argument('place_of_birth'),
        ];

        // Call API service to add author
        //$token = config('services.api.token'); // Fetch token from .env or config file

        $response = $this->apiService->addAuthor($token, $data);

        // Check API response
        if (isset($response->status) && $response->status == 401) {
            $this->error("Unauthorized: Check API token.");
        } elseif (isset($response->id)) {
            $this->info("Author {$response->first_name} {$response->last_name} added successfully!");
        } else {
            $this->error("Failed to add author.");
        }
    }
}
