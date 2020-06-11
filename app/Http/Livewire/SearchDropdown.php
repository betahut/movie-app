<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {   
        $searchResults = (strlen($this->search) > 2) ? Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/search/movie?query='.$this->search)->json()['results'] : [];
        $movieGenres = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/genre/movie/list')->json()['genres'];
        $movieGenres = collect($movieGenres)->mapWithKeys(function($genre) { return [$genre['id'] => $genre['name']]; });

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->map(function($searchResult) use ($movieGenres) {
                $genresFormatted = collect($searchResult['genre_ids'])->mapWithKeys(function($value) use ($movieGenres) {
                    return [$value => $movieGenres->get($value)];
                })->implode(', ');
                
                return collect($searchResult)->merge([
                    'poster_path' => $searchResult['poster_path'] ? config('services.tmdb.posterurl').$searchResult['poster_path'] : config('services.tmdb.noimgurl'),
                    'genres' => $genresFormatted,
                ])->only([
                    'vote_average', 'id', 'poster_path', 'title', 'genres'
                ]);
            })->take(7)
        ]);
    }
}
