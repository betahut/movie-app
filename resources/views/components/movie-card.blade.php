<li class="mt-8">
    <a href="{{ route('movies.show', $movie['id']) }}" class="flex justify-center md:block transition ease-in-out duration-150">
        <img src="{{ $movie['poster_path'] }}" alt="movie-poster" class="rounded-lg hover:opacity-75 transition ease-in-out duration-150" />
    </a>
    <div class="mt-2 flex justify-center flex-col items-center md:block transition ease-in-out duration-150 truncate">
        <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray:300 w-full md:w-auto text-center md:text-left" title="{{ $movie['title'] }}">{{ $movie['title'] }}</a>
        <div class="flex items-center text-gray-400 text-xs md:text-sm mt-1 flex-wrap">
            <span><img class="w-4" src="/images/007-star.svg"></span>
            <span class="ml-1">{{ $movie['vote_average'] }}</span>
            <span class="mx-1 md:mx-2">|</span>
            <span>{{ $movie['release_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm whitespace-normal genres text-center md:text-left">
            {{ $movie['genres'] }}
        </div>
    </div>
</li>