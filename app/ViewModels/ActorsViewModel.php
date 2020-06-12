<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel {
    public $popularActors;
    public $page;

    public function __construct($popularActors, $page) {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors() {
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? config('services.tmdb.profileurl').$actor['profile_path'] : 'https://ui-avatars.com/api?size=185_275&name='.$actor['name'],
                'popularity' => number_format($actor['popularity'], 2, '.', ''),
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->flatten()->implode(', '),
            ])->except([
                'adult', 'known_for_department', 'gender'
            ]);
        });
    }

    public function previous() {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next() {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
