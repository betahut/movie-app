<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class MoviesViewModel extends ViewModel {
    public $popularMovies;
    public $nowPlayingMovies;
    public $movieGenres;
    public $topRatedMovies;

    public function __construct($popularMovies, $nowPlayingMovies, $movieGenres, $topRatedMovies) {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->movieGenres = $movieGenres;
        $this->topRatedMovies = $topRatedMovies;
    }

    public function popularMovies() {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies() {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function topRatedMovies() {
        return $this->formatMovies($this->topRatedMovies);
    }

    public function movieGenres() {
        return collect($this->movieGenres)->mapWithKeys(function($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    // helper methods
    private function formatMovies($movies){
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->movieGenres()->get($value)];
            })->implode(', ');
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? config('services.tmdb.posterurl').$movie['poster_path'] : config('services.tmdb.noimgurl'),
                'backdrop_path' => config('services.tmdb.backdropurl').$movie['backdrop_path'],
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
