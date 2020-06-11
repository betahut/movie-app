@extends('layouts.main')

@section('content')
<div class="mx-auto bg-gray-900">
    <div class="content">
        <div class="container absolute ml-0 sm:ml-0 md:ml-24 z-0">
            <h2 class="text-6xl font-black mt-4 opacity-25 ml-8">Popular</h2>
        </div>
        <div class="p-8 z-10 relative z-10">
            <div class="flex flex-col lg:justify-between items-start mt-8 ml-0 sm:ml-0 md:ml-24">
                <h1 class="text-5xl font-black">Actors</h1>
                <div class="actors-div grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($popularActors as $actor)
                    <div class="actor mt-8 relative w-100">
                        <div class="absolute z-10 transform -rotate-90 inset-auto opacity-50" style="bottom: 105px; left: -95px;">
                            <span class="text-md text-6xl font-black truncate text-gray-700">{{$actor['popularity']}}</span>
                        </div>
                        <div class="relative z-0">
                            <a href="#">
                                <img src="{{$actor['profile_path']}}" alt="" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-md hover:text-gray-300">{{$actor['name']}}</a>
                                <div class="text-sm truncate text-gray-400" title="{{$actor['known_for']}}">{{$actor['known_for']}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection