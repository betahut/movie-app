<div class="movie-list ml-0 sm:ml-0 md:ml-24 mt-12 glide__backdrops relative">
    <div class="movie-heading"><h4 class="tracking-widest font-medium text-xl">MEDIA ({{ count($movie['backdrops']) }})</h4></div>
    @if(count($movie['backdrops']) > 0)
    <div class="flex glide__track" data-glide-el="track" x-data="{ isOpen: false, image: '' }">
        <ul class="glide__slides scrolling-auto overflow-visible">
            @foreach ($movie['backdrops'] as $backdrop)
                <li class="mt-8 {{ (!$loop->last) ? 'mr-2' : '' }} glide__slide w-auto">
                    <div class="flex justify-center items-center transition ease-in-out duration-150 ">
                        @if(trim($backdrop['file_path']) != '')
                            <img src="{{ config('services.tmdb.mediaurl').$backdrop['file_path'] }}" alt="cast" class="object-contain hover:opacity-75 transition ease-in-out duration-150" @click="isOpen=true; image='{{ config('services.tmdb.backdropurl').$backdrop['file_path'] }}'" />
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50" style="background-color: rgba(0, 0, 0, 0.5);" x-show.transition.opacity="isOpen">
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="">
                    <div class="flex justify-end pr-2 pt-2">
                        <button class="text-3xl leading-none hover:text-gray-300" @click="isOpen=false; image='';" @keydown.escape.window="isOpen=false; image='';">&times;</button>
                    </div>
                    <div class="modal-body px-8 py-8">
                        <img :src="image" alt="poster-backdrop" /> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-10" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
    @endif
</div>