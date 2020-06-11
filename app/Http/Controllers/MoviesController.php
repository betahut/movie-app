<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $popularMovies = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/movie/popular')->json()['results'];
        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/movie/now_playing')->json()['results'];
        $topRatedMovies = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/movie/top_rated')->json()['results'];
        $movieGenres = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/genre/movie/list')->json()['genres'];
        // $movieGenres = collect($movieGenres)->mapWithKeys(function($genre) { return [$genre['id'] => $genre['name']]; });
        
        $moviesViewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $movieGenres, $topRatedMovies);

        return view('index', $moviesViewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/movie/'.$id.'?append_to_response=videos,images,credits')->json();

        $viewModel = new MovieViewModel($movie);

        return view('show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
