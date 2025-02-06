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
    public function delete($authorId)
    {
        dd($authorId);
        $token = session('api_token');

        // Call your API service to delete the author
        $response = $this->apiService->deleteAuthor($authorId, $token);

        // Check if deletion was successful
        if ($response->status == 'success') {
            // If successful, remove the author from the authors array
            $this->authors = collect($this->authors)->where('id', '!=', $authorId)->values()->toArray();
            session()->flash('message', 'Author deleted successfully!');
        } else {
            session()->flash('error', 'Failed to delete the author.');
        }
    }

    public function render()
    {
        return view('livewire.authors-table');
    }
}


