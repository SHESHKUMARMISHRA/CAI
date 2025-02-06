<?php
// app/Http/Livewire/AuthorsTable.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\ApiService;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class AuthorsTable extends Component
{
    public $authors = [];

    protected $apiService;

    public function __construct()
    {
        // Inject Guzzle Client into ApiService
        $this->apiService = new ApiService(new Client());
    }

    public function mount()
    {
        $token = Session::get('api_token');

        // Fetch authors from API
        $this->authors = $this->apiService->getAuthors($token);
    }

    public function render()
    {
        return view('livewire.authors-table');
    }
}


