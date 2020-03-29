@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="/css/glide.core.min.css" />
@endsection

@section('content')
    <div class="mx-auto bg-gray-900">
        <div class="content">
            <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%), url({{ 'https://image.tmdb.org/t/p/original/'.$topRatedMovies[0]['backdrop_path'] }});"></div>
            <div class="p-8 z-10 relative">
                <div class="glide__featured relative">
                    <div class="flex glide__track" data-glide-el="track">
                        <ul class="glide__slides scrolling-auto overflow-visible">
                            @foreach ($topRatedMovies as $topRatedMovie)
                                <x-featured-movie :movie="$topRatedMovie" :genres="$movieGenres" />
                            @endforeach
                        </ul>
                    </div>
                    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-50" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left ml-0 md:ml-24" data-glide-dir="<">prev</button>
                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
                    </div>
                </div>

                @include('components.whats-popular')
                @include('components.now-playing')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/glide.min.js"></script>
    <script>
        let featuredGlide = new Glide('.glide__featured', {
            startAt: 0,
            rewind: false,
        }).mount();
        
        let featuredImage = document.querySelector('.hero-image');
        let featuredGlideLeft = document.querySelector('.glide__featured .glide__arrow--left');
        let featuredGlideRight = document.querySelector('.glide__featured .glide__arrow--right');

        let featuredGlideMove = (move) => featuredGlide.go(move);
        let featuredBgIamge = () => {
            let activeBgImage = document.querySelector('.glide__featured .glide__slide--active .movie-back-drop').innerText;
            featuredImage.style.background = `linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%), url(${activeBgImage}) no-repeat`;
        }

        featuredGlideLeft.addEventListener('click', (e) => {
            e.preventDefault();
            featuredGlideMove('<');
            setTimeout(() => featuredBgIamge(), 500);
        });
        
        featuredGlideRight.addEventListener('click', (e) => {
            e.preventDefault();
            featuredGlideMove('>');
            setTimeout(() => featuredBgIamge(), 500);
        });

        featuredGlide.on('swipe.end', () => {
            setTimeout(() => featuredBgIamge(), 500);
        })

        new Glide('.glide__now__playing', {
            startAt: 0,
            rewind: false,
            perView: 5,
            breakpoints:{
                1000: { perView: 5 },
                900: { perView: 4 },
                600: { perView: 3 },
                500: { perView: 2 },
                320: { perView: 1 }
            }
        }).mount();

        new Glide('.glide__whats__popular', {
            startAt: 0,
            rewind: false,
            perView: 5,
            breakpoints:{
                1000: { perView: 5 },
                900: { perView: 4 },
                600: { perView: 3 },
                500: { perView: 2 },
                320: { perView: 1 }
            }
        }).mount();
    </script>
@endsection