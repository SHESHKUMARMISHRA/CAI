<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiService;


class AddAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:add {name}'; // The command signature

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new author'; // Command description

    protected $apiService;
    /**
     * Execute the console command.
     */
    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }
    public function handle()
    {
        //
        $name = $this->argument('name');
        $this->apiService->addAuthor($name);
        $this->info('Author added successfully!');
    }
}
