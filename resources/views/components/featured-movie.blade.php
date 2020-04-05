<li class="flex justify-between items-center mt-64 ml-0 sm:ml-0 md:ml-24 lg:ml-0">
    <div class="none lg:block w-full lg:w-1/2"></div>
    <div class="w-full lg:w-1/2">
        <h2 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-wider truncate" title="{{ $movie['title'] }}">{{ $movie['title'] }}</h2>
        <p class="text-xl tracking-wider mt-4 h-28 overflow-hidden truncate" style="-webkit-line-clamp: 3; -webkit-box-orient: vertical; white-space: normal; display: -webkit-box;">{{ $movie['overview'] }}</p>
        <div class="details block md:flex md:items-center md:justify-between md:items-center text-lg font-semibold tracking-widest mt-6">
            <div class="hidden movie-back-drop">{{ config('services.tmdb.backdropurl').$movie['backdrop_path'] }}</div>
            <div class="genres">
                @foreach ($movie['genre_ids'] as $genre_id)
                    {{ $genres[$genre_id] }}<span> | </span>
                @endforeach
            </div>
            <div class="rating flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                <img class="w-4" src="/images/007-star.svg" alt="rating" />
                <span class="ml-2">{{ $movie['vote_average'] }}</span>
            </div>
        </div>
        <div class="other mt-12 flex items-center flex-col md:flex-row">
            <div class="flex ml-0 w-full items-center mt-4 md:mt-0  transition ease-in-out duration-150">
                <a href="/movies/{{ $movie['id'] }}" class="px-4 py-1 rounded-full flex w-full justify-center md:w-3/5 tracking-widest border-2 border-white">More Details</a>
                <a href="#" class="ml-8"><img class="w-8" src="/images/005-heart-1.svg" alt="favourite" /></a>
            </div>
        </div>
    </div>
</li>