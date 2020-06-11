<div class="movie-list ml-0 sm:ml-0 md:ml-24 mt-12 glide__whats__popular relative">
    <div class="movie-heading"><h4 class="tracking-widest font-medium text-xl">WHAT'S POPULAR</h4></div>
    <div class="flex glide__track" data-glide-el="track">
        <ul class="glide__slides scrolling-auto overflow-visible">
        @foreach ($popularMovies as $popularMovie)
            <x-movie-card :movie="$popularMovie" />
        @endforeach
        </ul>
    </div>
    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-10" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
</div>