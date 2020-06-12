<?php

namespace App\ViewModels;
use \Carbon\Carbon;

use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel {
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits) {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor() {
        return collect($this->actor)->merge([
            'profile_path' => $this->actor['profile_path'] ? config('services.tmdb.profileurl').$this->actor['profile_path'] : 'https://ui-avatars.com/api?size=185_275&name='.$this->actor['name'],
            'poster_path' => $this->actor['profile_path'] ? config('services.tmdb.posterurl').$this->actor['profile_path'] : 'https://ui-avatars.com/api?size=185_275&name='.$this->actor['name'],
            'popularity' => number_format($this->actor['popularity'], 2, '.', ''),
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
        ]);
    }

    public function social() {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://www.twitter.com/'.$this->social['twitter_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://www.instagram.com/'.$this->social['instagram_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://www.facebook.com/'.$this->social['facebook_id'] : null,
        ]);
    }

    public function credits() {
        $creditCasts = collect($this->credits)->get('cast');
        return collect($creditCasts)->map(function($credit) {
            $release_date = '';
            if(isset($credit['release_date']))
                $release_date = $credit['release_date'];
            else if(isset($credit['first_air_date']))
                $release_date = $credit['first_air_date'];
            
            $title = 'Untitled';
            if(isset($credit['title']))
                $title = $credit['title'];
            else if(isset($credit['name']))
                $title = $credit['name'];

            
            return collect($credit)->merge([
                'release_date' => $release_date,
                'release_year' => isset($release_date) ? Carbon::parse($release_date)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($credit['character']) && trim($credit['character']) !== '' ? ' as '.$credit['character'] : '',
                'poster_path' => $credit['poster_path'] ? config('services.tmdb.profileurl').$credit['poster_path'] : config('services.tmdb.noimgurl'),
                'backdrop_path' => $credit['backdrop_path'] ? config('services.tmdb.posterurl').$credit['backdrop_path'] : config('services.tmdb.noimgurl'),
                'media_type' => $credit['media_type'] == 'movie' ? 'Movie' : 'TV',
            ]);
        })->sortByDesc('release_year');
    }

    public function knownForMovies() {
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)->where('media_type', 'movie')->sortByDesc('popularity')->take(5)->map(function($movie) {
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? config('services.tmdb.profileurl').$movie['poster_path'] : config('services.tmdb.noimgurl'),
                'title' => isset($movie['title']) ? $movie['title'] : 'Untitled',
            ]);
        });
    }
}
