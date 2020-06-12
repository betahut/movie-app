<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class TvViewModel extends ViewModel {
    public $popularTv;
    public $tvGenres;
    public $topRatedTv;
    public $page;

    public function __construct($popularTv, $topRatedTv, $tvGenres, $page) {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->tvGenres = $tvGenres;
        $this->page = $page;
    }

    public function popularTv() {
        return $this->formatTv($this->popularTv);
    }

    public function topRatedTv() {
        return $this->formatTv($this->topRatedTv);
    }

    public function tvGenres() {
        return collect($this->tvGenres)->mapWithKeys(function($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    public function previous() {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next() {
        return $this->page < 500 ? $this->page + 1 : null;
    }

    // helper methods
    private function formatTv($tv){
        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->tvGenres()->get($value)];
            })->implode(', ');
            $poster_path = $tvshow['poster_path'] ? config('services.tmdb.posterurl').$tvshow['poster_path'] : config('services.tmdb.noimgurl');
            return collect($tvshow)->merge([
                'poster_path' => $poster_path,
                'backdrop_path' => $tvshow['backdrop_path'] ? config('services.tmdb.backdropurl').$tvshow['backdrop_path'] : $poster_path,
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
                'name' => $tvshow['name'] ? $tvshow['name'] : 'Untitled',
                'overview' => $tvshow['overview'],
                'vote_average' => $tvshow['vote_average'],
                'id' => $tvshow['id'],
            ])->only([
                'poster_path', 'backdrop_path', 'first_air_date', 'genres', 'id', 'name', 'vote_average', 'overview', 'genre_ids'
            ]);
        });
    }
}
