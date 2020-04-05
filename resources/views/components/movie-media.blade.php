<div class="movie-list ml-0 sm:ml-0 md:ml-24 mt-12 glide__backdrops relative">
    <div class="movie-heading"><h4 class="tracking-widest font-medium text-xl">MEDIA ({{ count($movie['images']['backdrops']) }})</h4></div>
    @if(count($movie['images']['backdrops']) > 0)
    {{--  + count($movie['images']['posters']) --}}
    <div class="flex glide__track" data-glide-el="track">
        <ul class="glide__slides scrolling-auto overflow-visible">
            @foreach ($movie['images']['backdrops'] as $backdrop)
                <li class="mt-8 {{ (!$loop->last) ? 'mr-2' : '' }} glide__slide w-auto">
                    <div class="flex justify-center items-center transition ease-in-out duration-150 ">
                        @if(trim($backdrop['file_path']) != '')
                            <img src="{{ config('services.tmdb.mediaurl').$backdrop['file_path'] }}" alt="cast" class="object-contain hover:opacity-75 transition ease-in-out duration-150" />
                        @endif
                    </div>
                </li>
            @endforeach
            {{-- @foreach ($movie['images']['posters'] as $poster)
                <li class="mt-8 {{ (!$loop->last) ? 'mr-2' : '' }} glide__slide w-auto">
                    <div class="flex justify-center items-center transition ease-in-out duration-150">
                        @if(trim($poster['file_path']) != '')
                            <img src="{{ config('services.tmdb.mediaurl').$poster['file_path'] }}" alt="cast" class="object-contain hover:opacity-75 transition ease-in-out duration-150" />
                        @endif
                    </div>
                </li>
            @endforeach --}}
        </ul>
    </div>
    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-10" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
    @endif
</div>