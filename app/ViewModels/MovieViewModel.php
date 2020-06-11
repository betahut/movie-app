<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class MovieViewModel extends ViewModel {
    public $movie;

    public function __construct($movie) {
        $this->movie = $movie;
    }

    public function movie() {
        return collect($this->movie)->merge([
            'poster_path' => $this->movie['poster_path'] ? config('services.tmdb.posterurl').$this->movie['poster_path'] : config('services.tmdb.noimgurl'),
            'backdrop_path' => config('services.tmdb.backdropurl').$this->movie['backdrop_path'],
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'runtime' => intdiv($this->movie['runtime'], 60).'H '. ($this->movie['runtime'] % 60).'MIN',
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(' | '),
            'cast' => collect($this->movie['credits']['cast']),
            'backdrops' => collect($this->movie['images']['backdrops']),
        ])->only([
            'poster_path', 'backdrop_path', 'release_date', 'runtime', 'genres', 'cast', 'backdrops', 'title', 'overview', 'vote_average', 'credits', 'images', 'videos', 'id'
        ]);
    }
}
