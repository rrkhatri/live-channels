<?php

namespace App\Http\Livewire\Channels;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{
    public $channels;
    public $search;

    protected $queryString = [
        'search'
    ];

    protected $listeners = [
        'search-channel' => '$refresh'
    ];

    public function mount()
    {
        $this->channels = collect();
    }

    public function render()
    {
        $this->listChannels();

        return view('livewire.channels.index');
    }

    public function listChannels()
    {
        $this->channels = Http::get('https://iptv-org.github.io/api/streams.json')->json();

        $this->filterChannels();
    }

    public function filterChannels()
    {
        if ($this->search) {
            $this->channels = collect($this->channels)->filter(function ($channel) {
                return str_contains(strtolower($channel['channel']), strtolower($this->search));
            })->toArray();
        }
    }
}
