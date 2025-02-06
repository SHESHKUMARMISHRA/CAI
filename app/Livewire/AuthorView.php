<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AuthorView extends Component
{
    public $authors;

    public function mount()
    {
        $this->authors = Http::withToken(session('api_token'))
                             ->get('https://candidate-testing.api.royal-apps.io/api/v2/authors')
                             ->json();
    }
    public function render()
    {
        return view('livewire.author-view');
    }
}
