<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel {
    public $popularActors;

    public function __construct($popularActors) {
        $this->popularActors = $popularActors;
    }

    public function popularActors() {
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? config('services.tmdb.profileurl').$actor['profile_path'] : '/images/user.png',
                'popularity' => number_format($actor['popularity'], 2, '.', ''),
                'known_for' => collect($actor['known_for'])->map(function($known){
                    $keyKnown = $known['media_type'] == 'tv' ? 'name' : 'title';
                    return collect($known)->merge([
                        'title' => $known[$keyKnown],
                    ]);
                })->pluck('title')->flatten()->implode(', '),
            ])->except([
                'adult', 'known_for_department', 'gender'
            ]);
        });
    }
}
