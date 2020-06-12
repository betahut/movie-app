@extends('layouts.main')

@section('content')
<div class="mx-auto bg-gray-900">
    <div class="content">
        <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%), url('{{ $actor['poster_path'] }}');"></div>
        <div class="p-8 z-10 relative z-10">
            <div class="flex flex-col lg:flex-row lg:justify-between items-start mt-12 lg:mt-64 ml-0 sm:ml-0 md:ml-24">
                <div class="w-full lg:w-1/3 px-0 sm:px-0 md:px-0 lg:px-8">
                    <img src="{{ $actor['profile_path'] }}" class="w-auto md:w-full rounded-lg" />
                </div>
                <div class="w-full lg:w-2/3 mt-12 lg:mt-0">
                    <h2 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-wider">{{$actor['name']}}</h2>
                    <p class="text-xl tracking-wider mt-4">{{$actor['biography']}}</p>
                    <div class="details block md:flex md:items-center md:justify-between md:items-center text-lg font-semibold tracking-widest mt-6">
                        <div class="place_of_birth flex items-center ml-0 mt-2 md:mt-0">
                            <img class="w-4" src="/images/location.svg" alt="location" />
                            <span class="ml-2 truncate" title="{{$actor['place_of_birth']}}">
                                {{$actor['place_of_birth']}}
                            </span>
                        </div>
                        <div class="timing flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                            <img class="w-4" src="/images/cake.svg" alt="birth-date" />
                            <span class="ml-2 truncate" title="{{$actor['birthday']}} ({{$actor['age']}} years old)">
                                {{$actor['birthday']}} ({{$actor['age']}} years old)
                            </span>
                        </div>
                        <div class="rating flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                            <img class="w-4" src="/images/007-star.svg" alt="rating" />
                            <span class="ml-2">{{$actor['popularity']}}</span>
                        </div>
                    </div>
                    <div class="other-links block md:flex md:items-center text-lg font-semibold tracking-widest mt-6">
                        @if($actor['homepage'])
                        <div class="website flex items-center ml-0 mt-2 md:mt-0">
                            <a href="{{$actor['homepage']}}" target="_blank" title="Website">
                                <img class="w-10" src="/images/website-design.svg" alt="website" />
                            </a>
                        </div>
                        @endif
                        @if($social['facebook'])
                        <div class="facebook flex items-center ml-0 mt-2 ml-4 md:mt-0">
                            <a href="{{$social['facebook']}}" target="_blank" title="Facebook">
                                <img class="w-10" src="/images/facebook.svg" alt="facebook" />
                            </a>
                        </div>
                        @endif
                        @if($social['instagram'])
                        <div class="instagram flex items-center ml-0 mt-2 ml-4 md:mt-0">
                            <a href="{{$social['instagram']}}" target="_blank" title="Instagram">
                                <img class="w-10" src="/images/instagram.svg" alt="instagram" />
                            </a>
                        </div>
                        @endif
                        @if($social['twitter'])
                        <div class="twitter flex items-center ml-0 mt-2 ml-4 md:mt-0">
                            <a href="{{$social['twitter']}}" target="_blank" title="Twitter">
                                <img class="w-10" src="/images/twitter.svg" alt="twitter" />
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="known_for mt-12">
                        <div class="font-bold text-3xl">Known For</div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                            @foreach($knownForMovies as $movie)
                            <div class="mt-4 flex flex-col items-center md:items-start truncate">
                                <a href="{{route('movies.show', $movie['id'])}}">
                                    <img src="{{ $movie['poster_path'] }}" alt="{{$movie['title']}}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
                                </a>
                                <div class="mt-2 truncate">
                                    <a href="{{route('movies.show', $movie['id'])}}" class="text-md hover:text-gray-300 truncate" title="{{$movie['title']}}">{{$movie['title']}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row lg:justify-between items-center mt-4 ml-0 sm:ml-0 md:ml-24">
                <div class="history mt-4 w-full">
                    <div class="font-bold text-4xl">History ({{count($credits)}})</div>
                    <ul class="leading-loose mt-8">
                        @foreach($credits as $credit)
                            <li class="flex flex-row items-center justify-between my-4 relative rounded-lg overflow-hidden" style="border: 1px solid #2d3748;">
                                @if($credit['backdrop_path'] !== '/images/no-image.svg')
                                    <div class="absolute h-full w-full z-0 opacity-50" style="background-image:linear-gradient(to right, rgba(255, 255, 255, 0), rgba(26, 32, 44) 100%), url('{{ $credit['backdrop_path'] }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                        <div class="absolute font-black text-2xl" style="top: -2px; right: 5px;">{{$credit['media_type']}}</div>
                                    </div>
                                @elseif($credit['poster_path'] !== '/images/no-image.svg')
                                    <div class="absolute h-full w-full z-0 opacity-50" style="background-image:linear-gradient(to right, rgba(255, 255, 255, 0), rgba(26, 32, 44) 100%), url('{{ $credit['poster_path'] }}'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                        <div class="absolute font-black text-2xl" style="top: -2px; right: 5px;">{{$credit['media_type']}}</div>
                                    </div>
                                @else
                                    <div class="absolute h-full w-full z-0 opacity-50" style="background-image:linear-gradient(to right, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%);">
                                        <div class="absolute font-black text-2xl" style="top: -2px; right: 5px;">{{$credit['media_type']}}</div>
                                    </div>
                                @endif
                                <div class="flex flex-row items-center relative z-10 p-4 truncate">
                                    <img src="{{$credit['poster_path']}}" alt="{{$credit['title']}}" class="w-8 h-10 mr-2 rounded-lg" style="border: 1px solid #2d3748;" />
                                    <strong class="mr-2 font-bold">{{$credit['title']}}</strong>
                                    <span class="hidden md:inline">{{$credit['character']}}</span>
                                </div>
                                <div class="relative z-10 pr-4 pl-2 h-full">
                                    <span class="font-bold md:font-semi-bold text-gray-200">{{$credit['release_year']}}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection