<div class="tv-list ml-0 sm:ml-0 md:ml-24 mt-12 glide__whats__popular relative">
    <div class="tv-heading flex justify-between items-center">
        <h4 class="tracking-widest font-medium text-xl">WHAT'S POPULAR</h4>
        <a href="{{route('tv.page', '1')}}">More &rsaquo;</a>
    </div>
    <div class="flex glide__track" data-glide-el="track">
        <ul class="glide__slides scrolling-auto overflow-visible">
        @foreach ($popularTv as $tvshow)
            <x-tv-card :tvshow="$tvshow" />
        @endforeach
        </ul>
    </div>
    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-10" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
</div>