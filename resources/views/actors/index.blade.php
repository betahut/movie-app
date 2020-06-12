@extends('layouts.main')

@section('content')
<div class="mx-auto bg-gray-900">
    <div class="content">
        <div class="container absolute ml-0 sm:ml-0 md:ml-24 z-0">
            <h2 class="text-6xl font-black mt-4 opacity-25 ml-8">Popular</h2>
        </div>
        <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%);"></div>
        <div class="p-8 z-10 relative z-10">
            <div class="flex flex-col lg:justify-between items-start mt-8 ml-0 sm:ml-0 md:ml-24">
                <h1 class="text-5xl font-bold">Actors</h1>
                <div class="actors-div grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($popularActors as $actor)
                    <div class="actor mt-8 relative w-100">
                        <div class="absolute z-10 transform -rotate-90 inset-auto opacity-75 hover:opacity-100 transition ease-in-out duration-150 w-40" style="bottom: 105px; left: -85px;">
                            <span class="text-md text-6xl font-black truncate text-gray-700">{{$actor['popularity']}}</span>
                        </div>
                        <div class="relative z-0">
                            <a href="{{ route('actors.show', $actor['id']) }}">
                                <img src="{{$actor['profile_path']}}" alt="" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg" style="height:278px; width: 178px;">
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('actors.show', $actor['id']) }}" class="text-md hover:text-gray-300">{{$actor['name']}}</a>
                                <div class="text-sm truncate text-gray-400" title="{{$actor['known_for']}}">{{$actor['known_for']}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="page-load-status mt-16">
                    <p class="infinite-scroll-request spinner text-4xl text-center w-full relative">&nbsp;</p>
                    <p class="infinite-scroll-last">End of content</p>
                    <p class="infinite-scroll-error">No more pages to load</p>
                </div>
                {{-- <div class="flex justify-between mt-16 w-full">
                    @if($previous)
                        <a href="{{ route('actors.page', $previous) }}" class="relative">
                            <div class="relative z-10" style="top: 12px">Previous</div>
                            <div class="absolute z-0 text-3xl font-black text-gray-300 top-0 left-0 opacity-25">Page</div>
                        </a>
                    @else
                        <div></div>
                    @endif
                    @if($next)
                        <a href="{{ route('actors.page', $next) }}" class="relative">
                            <div class="relative z-10" style="top: 12px">Next</div>
                            <div class="absolute z-0 text-3xl font-black text-gray-300 top-0 right-0 opacity-25">Page</div>
                        </a>
                    @else
                        <div></div>
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status',
        // history: false,
    });
</script>
@endsection