<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class MovieViewModel extends ViewModel {
    public $movie;
    public $torrents;

    public function __construct($movie, $ytsData) {
        $this->movie = $movie;
        $this->ytsData = $ytsData;
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
            'poster_path', 'backdrop_path', 'release_date', 'runtime', 'genres', 'cast', 'backdrops', 'title', 'overview', 'vote_average', 'credits', 'images', 'videos', 'id', 'imdb_id'
        ]);
    }

    public function torrents() {
        if($this->ytsData['data']['movie_count'] > 0) {
            $title = $this->ytsData['data']['movies'][0]['title'];
            return collect($this->ytsData['data']['movies'][0]['torrents'])->map(function($torrent) use ($title){
                return collect($torrent)->merge([
                    'magnet' => urlencode('magnet:?xt=urn:btih:'.$torrent['hash'].'&dn='.urldecode($title.' '.$torrent['quality'].' [YTS.MX]').'&tr=udp://glotorrents.pw:6969/announce&tr=udp://tracker.openbittorrent.com:80&tr=udp://tracker.coppersurfer.tk:6969&tr=udp://p4p.arenabg.ch:1337&tr=udp://tracker.internetwarriors.net:1337')
                ])->only(['magnet', 'size_bytes', 'size', 'quality']);
            });
        } else {
            return null;
        }
    }
}
