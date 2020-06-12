<div class="tvshow-list ml-0 sm:ml-0 md:ml-24 mt-12 glide__cast relative">
    <div class="tvshow-heading"><h4 class="tracking-widest font-medium text-xl">CAST ({{ count($tvshow['cast']) }})</h4></div>
    @if(count($tvshow['cast']) > 0)
    <div class="flex glide__track" data-glide-el="track">
        <ul class="glide__slides scrolling-auto overflow-visible">
            @foreach ($tvshow['cast'] as $cast)
                <li class="mt-8 {{ (!$loop->last) ? 'mr-2' : '' }} glide__slide w-auto">
                    <a href="{{ route('actors.show', $cast['id']) }}" class="flex justify-center items-center transition ease-in-out duration-150 ">
                        @if(trim($cast['profile_path']) != '')
                            <img src="{{ config('services.tmdb.profileurl').$cast['profile_path'] }}" alt="cast" class="w-32 h-32 object-contain rounded-full hover:opacity-75 transition ease-in-out duration-150 border border-gray-300" />
                        @else
                            <img src="{{ '/images/user.png' }}" alt="cast" class="w-32 h-32 object-cover rounded-full hover:opacity-75 transition ease-in-out duration-150" />
                        @endif
                    </a>
                    <div class="mt-2 flex justify-center flex-col items-center md:block transition ease-in-out duration-150 text-center">
                        <a href="{{ route('actors.show', $cast['id']) }}" class="text-base mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                        <div class="text-gray-400 text-sm"> {{ $cast['character'] }} </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="glide__arrows absolute left-0 flex w-full justify-between items-center z-10" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
    </div>
    @endif
</div>