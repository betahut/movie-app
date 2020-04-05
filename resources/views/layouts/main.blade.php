<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie App</title>

    @yield('styles')
    
    <style>
        .glide__arrows{ top: 50%; }
        .glide__arrows .glide__arrow{ font-size: 0; height: 32px; width: 32px; background-repeat: no-repeat; }
        .glide__arrows .glide__arrow--left{ background-image: url('/images/next.png'); }
        .glide__arrows .glide__arrow--right{ background-image: url('/images/prev.png'); }
    </style>

    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
</head>
<body class="container mx-auto font-sans text-white relative min-h-screen" style="background:linear-gradient(to bottom, rgba(26, 32, 44, 0.925), rgba(26, 32, 44) 65%) no-repeat;">
    <nav class="fixed bottom-0 sm:bottom-0 md:bottom-auto left-0 sm:left-0 md:left-auto h-24 md:h-screen w-full sm:w-full md:w-24 flex justify-between  items-center flex-row md:flex-col bg-gray-900 z-50 border-t md:border-t-0 border-r-0 md:border-r border-gray-800">
        <div class="brand text-5xl font-extrabold">M.</div>
        <ul class="nav-items flex flex-row md:flex-col items-center">
            <li class="mx-4 my-2 sm:mx-4 sm:my-2 md:mx-8 md:my-4"><a href="/search"><img class="w-8 sm:w-8 md:w-32" src="/images/003-search.svg" alt="" /></a></li>
            <li class="mx-4 my-2 sm:mx-4 sm:my-2 md:mx-8 md:my-4"><a href="/"><img class="w-8 sm:w-8 md:w-32" src="/images/001-play.svg" alt="" /></a></li>
            <li class="mx-4 my-2 sm:mx-4 sm:my-2 md:mx-8 md:my-4"><a href="#"><img class="w-8 sm:w-8 md:w-32" src="/images/002-talk-show.svg" alt="" /></a></li>
            <li class="mx-4 my-2 sm:mx-4 sm:my-2 md:mx-8 md:my-4"><a href="#"><img class="w-8 sm:w-8 md:w-32" src="/images/004-heart.svg" alt="" /></a></li>
        </ul>
        <div class="hidden sm:hidden md:block"></div>
    </nav>
    @yield('content')

    <footer class="px-4 md:px-32 py-8 flex flex-col md:flex-row justify-between items-end mb-24 md:mb-0 relative z-10">
        <div class="">
            <div class="mb-2 tracking-widest font-medium text-xl">NEWSLETTER</div>
            <p class="text-gray-600 leading-normal">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, consectetur. </p>
            <div class="mt-4 flex">
                <input type="text" class="p-2 border border-gray-700 round text-gray-900 text-sm h-auto" placeholder="Your email address">
                <button class="bg-gray-700 border-gray-700 text-white rounded-sm h-auto text-xs p-3">Subscribe</button>
            </div>
            <p class="text-gray-600 leading-normal mt-4">Copyrights &copy; {{ date('Y') }} </p>
        </div>
    </footer>

    @yield('scripts')
    <livewire:scripts>
</body>
</html>