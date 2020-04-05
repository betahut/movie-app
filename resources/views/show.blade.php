@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="/css/glide.core.min.css" />
@endsection

@section('content')
    <div class="mx-auto bg-gray-900">
        <div class="content">
            <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%), url({{ config('services.tmdb.backdropurl').$movie['backdrop_path'] }});"></div>
            <div class="p-8 z-10 relative">
                <div class="flex flex-col lg:flex-row lg:justify-between items-center mt-12 lg:mt-64 ml-0 sm:ml-0 md:ml-24">
                    <div class="w-full lg:w-1/3 px-0 sm:px-0 md:px-0 lg:px-8">
                        <img src="{{ $movie['poster_path'] ? config('services.tmdb.posterurl').$movie['poster_path'] : config('services.tmdb.noimgurl') }}" class="w-full md:w-auto rounded-lg" />
                    </div>
                    <div class="w-full lg:w-2/3 mt-12 lg:mt-0">
                        <h2 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-wider">{{ $movie['title'] }}</h2>
                        <p class="text-xl tracking-wider mt-4">{{ $movie['overview'] }}</p>
                        <div class="details block md:flex md:items-center md:justify-between md:items-center text-lg font-semibold tracking-widest mt-6">
                            <div class="genres">
                                @foreach ($movie['genres'] as $genre)
                                    {{ $genre['name'] }}<span> | </span>
                                @endforeach
                            </div>
                            <div class="timing flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                                <img class="w-4" src="/images/006-clock.svg" alt="movie-timing" />
                                <span class="ml-2">
                                    @php
                                        echo intdiv($movie['runtime'], 60).'H '. ($movie['runtime'] % 60).'MIN';
                                    @endphp
                                </span>
                            </div>
                            <div class="rating flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                                <img class="w-4" src="/images/007-star.svg" alt="rating" />
                                <span class="ml-2">{{ $movie['vote_average'] }}</span>
                            </div>
                        </div>
                        <div class="other mt-12 flex items-center flex-col md:flex-row">
                            <div class="flex w-full items-center mt-4 md:mt-0  transition ease-in-out duration-150">
                                @if(count($movie['videos']['results']) > 0)
                                    <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" target="_blank" class="px-4 py-1 rounded-full bg-blue-700 flex justify-center w-full md:w-2/5 tracking-widest border-blue-700 border-2  transition ease-in-out duration-150">Watch Now <img class="w-4 ml-2" src="/images/001-play.svg" alt="play" /></a>
                                @endif
                                <a href="#" class="{{ (count($movie['videos']['results']) > 0) ? 'ml-8' : '' }}"><img class="w-8" src="/images/005-heart-1.svg" alt="favourite" /></a>
                            </div>
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
    </script>
@endsection