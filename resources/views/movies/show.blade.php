@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="/css/glide.core.min.css" />
<link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
@endsection

@section('content')
    <div class="mx-auto bg-gray-900">
        <div class="content">
            <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%), url({{ $movie['backdrop_path'] }});"></div>
            <div class="p-8 z-10 relative">
                <div class="flex flex-col lg:flex-row lg:justify-between items-center mt-12 lg:mt-64 ml-0 sm:ml-0 md:ml-24">
                    <div class="w-full lg:w-1/3 px-0 sm:px-0 md:px-0 lg:px-8">
                        <img src="{{ $movie['poster_path'] }}" class="w-full md:w-auto rounded-lg" />
                    </div>
                    <div class="w-full lg:w-2/3 mt-12 lg:mt-0">
                        <h2 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-wider">{{ $movie['title'] }}</h2>
                        <p class="text-xl tracking-wider mt-4">{{ $movie['overview'] }}</p>
                        <div class="details block md:flex md:items-center md:justify-between md:items-center text-lg font-semibold tracking-widest mt-6">
                            <div class="genres">
                                {{ $movie['genres'] }}
                            </div>
                            <div class="timing flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                                <img class="w-4" src="/images/006-clock.svg" alt="movie-timing" />
                                <span class="ml-2">
                                    {{$movie['runtime']}}
                                </span>
                            </div>
                            <div class="rating flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                                <img class="w-4" src="/images/007-star.svg" alt="rating" />
                                <span class="ml-2">{{ $movie['vote_average'] }}</span>
                            </div>
                        </div>
                        <div class="other mt-12 flex items-center flex-col">
                            <div class="flex w-full items-center mt-4 md:mt-0  transition ease-in-out duration-150">
                                @if(count($movie['videos']['results']) > 0)
                                    <div class="flex flex-col" x-data="{ isOpen: false }">
                                        <button @click="isOpen = true" class="px-4 py-1 rounded-full bg-blue-700 flex justify-center items-center w-full tracking-widest border-blue-700 border-2  transition ease-in-out duration-150">Watch Trailer <img class="w-4 ml-2 mt-1" src="/images/001-play.svg" alt="play" /></button>
                                        
                                        <div class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50" style="background-color: rgba(0, 0, 0, 0.5);" x-show.transition.opacity="isOpen">
                                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                                <div class="">
                                                    <div class="flex justify-end pr-2 pt-2">
                                                        <button @click="document.querySelector('.plyr__poster').click(); isOpen = false;" @keydown.escape.window="document.querySelector('.plyr__poster').click(); isOpen=false;" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                                    </div>
                                                    <div class="modal-body px-8 py-8">
                                                        <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $movie['videos']['results'][0]['key'] }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            @if($torrents)
                            <div class="torrents-list w-full flex flex-row flex-wrap mt-4" x-data="torrentAlpine()">
                                @foreach(json_decode($torrents) as $torrent)
                                <div class="flex flex-col {{$loop->last ? '': 'mr-2'}} mt-2 w-1/2">
                                    <button @click="isOpen = true; updateMagnet('{{$torrent->magnet}}', '{{$movie['title']}}', '{{$movie['backdrop_path']}}', '{{$movie['imdb_id']}}'); loadTorrent();" class="torrent-item px-4 py-1 rounded-full bg-blue-700 flex justify-center items-center w-full tracking-widest border-blue-700 border-2  transition ease-in-out duration-150" data-magnet="
                                    {{$torrent->magnet}}" data-size="{{$torrent->size_bytes}}">Watch Now {{$torrent->quality}} ({{$torrent->size}})<img class="w-4 ml-2 mt-1" src="/images/001-play.svg" alt="play" /></button>
                                </div>
                                @endforeach

                                <div class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50" style="background-color: rgba(0, 0, 0, 0.5);" x-show.transition.opacity="isOpen">
                                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                        <div class="">
                                            <div class="flex justify-end pr-2 pt-2">
                                                <button @click="isOpen = false; magnet=''; document.querySelector('#torrent-player').innerHTML = '';" @keydown.escape.window="isOpen = false; magnet=''; document.querySelector('#torrent-player').innerHTML = '';" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                            </div>
                                            <div class="modal-body px-8 py-8">
                                                <div id="torrent-player" class="webtor text-center"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @include('components.movie-casts')
                @include('components.movie-media')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@webtor/player-sdk-js/dist/index.min.js"></script>
    <script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="/js/glide.min.js"></script>
    <script>
        document.querySelector('.glide__cast .glide__track') && new Glide('.glide__cast', {
            startAt: 0,
            rewind: false,
            perView: 6,
            breakpoints:{
                1200: { perView: 6 },
                1000: { perView: 5 },
                900: { perView: 4 },
                600: { perView: 3 },
                500: { perView: 2 },
                320: { perView: 1 }
            }
        }).mount();

        document.querySelector('.glide__backdrops .glide__track') && new Glide('.glide__backdrops', {
            startAt: 0,
            rewind: false
        }).mount();

        if(document.querySelector('#player')){
            const player = new Plyr('#player');
            document.querySelector('.plyr__poster').addEventListener('click', e => player.stop());
        }

        torrentAlpine = () => {
            return {
                isOpen: false,
                magnet: '',
                title: '',
                poster: '',
                imdbId: '',
                updateMagnet: (magnet, title, poster, imdbId) => { this.magnet = magnet; this.title = title; this.poster = poster; this.imdbId = imdbId; },
                loadTorrent: () => {
                    window.webtor = window.webtor || [];
                    window.webtor.push({
                        id: 'torrent-player',
                        magnet: unescape(this.magnet),
                        title: this.title,
                        poster: this.poster,
                        theme: 'dark',
                        width: '100%',
                        imdbId: this.imdbId,
                        header: true,
                        on: function(e) {
                            console.log(e, unescape(this.magnet));
                            if (e.name == window.webtor.TORRENT_FETCHED) {
                                console.log('Torrent fetched!')
                            }
                            if (e.name == window.webtor.TORRENT_ERROR) {
                                console.log('Torrent error!')
                            }
                        },
                    });
                }
            }
        }

        // documnet.querySelector('.torrent-item').addEventListener('click', (e) => {
        //     e.preventDefault();
        // })
    </script>
@endsection