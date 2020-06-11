<div class="search-container ml-0 sm:ml-0 md:ml-24 mt-12 relative" x-data="{ isOpen: false }">
    <input wire:model.debounce.500ms="search" type="text" class="search-input rounded-full py-2 px-4 border border-gray-700 round text-gray-900 focus:text-white text-lg w-full bg-white focus:bg-gray-500 transition ease-in-out duration-150" placeholder="Search Movies..." x-ref="search" @keydown.window="
        if(event.keyCode === 191) {
            event.preventDefault();
            $refs.search.focus();
        }
    " />
    <div wire:loading class="spinner top-0 right-0 mt-6 mr-12"></div>
    <div class="absolute text-purple-lighter top-0 right-0 px-2 py-2 my-2 mx-2">
        <svg version="1.1" class="h-4 text-gray-700 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;" xml:space="preserve">
          <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
          c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
          C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
          S32.459,40,21.983,40z"/>
      </svg>
    </div>
    @if (strlen($search) > 2)
        <div class="relative bg-gray-800 rounded w-full mt-4">
            @if($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $searchResult)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $searchResult['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex justify-between items-center">
                                <span class="flex items-center">
                                    <img src="{{ $searchResult['poster_path'] }}" alt="movie-img" class="h-16 w-12 bg-gray-100" />
                                    <div class="ml-4">
                                        <p class="text-lg font-semibold">{{ $searchResult['title'] }}</p>
                                        <div class="text-gray-400 text-sm whitespace-normal genres md:text-left">
                                            {{$searchResult['genres']}}
                                        </div>
                                    </div>
                                </span>
                                <span class="vote_average">{{ $searchResult['vote_average'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @else
        <div class="px-3 py-3">Type "/" to search movies</div>
    @endif
</div>