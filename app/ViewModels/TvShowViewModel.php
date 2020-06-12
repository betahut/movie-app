<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class TvShowViewModel extends ViewModel {
    public $tvshow;

    public function __construct($tvshow) {
        $this->tvshow = $tvshow;
    }

    public function tvshow() {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path'] ? config('services.tmdb.posterurl').$this->tvshow['poster_path'] : config('services.tmdb.noimgurl'),
            'backdrop_path' => config('services.tmdb.backdropurl').$this->tvshow['backdrop_path'],
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(' | '),
            'cast' => collect($this->tvshow['credits']['cast']),
            'backdrops' => collect($this->tvshow['images']['backdrops']),
        ])->only([
            'poster_path', 'backdrop_path', 'first_air_date', 'genres', 'cast', 'backdrops', 'name', 'overview', 'vote_average', 'credits', 'images', 'videos', 'id'
        ]);
    }
}
