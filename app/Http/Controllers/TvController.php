<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {   
        abort_if($page > 500, 204);
        $popularTv = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/tv/popular?page='.$page)->json()['results'];
        $topRatedTv = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/tv/top_rated')->json()['results'];
        $tvGenres = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/genre/tv/list')->json()['genres'];        
        $viewModel = new TvViewModel($popularTv, $topRatedTv, $tvGenres, $page);

        return view('tv.index', $viewModel);
    }

    public function page($page = 1)
    {   
        abort_if($page > 500, 204);
        $popularTv = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/tv/popular?page='.$page)->json()['results'];
        $topRatedTv = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/tv/top_rated')->json()['results'];
        $tvGenres = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/genre/tv/list')->json()['genres'];        
        $viewModel = new TvViewModel($popularTv, $topRatedTv, $tvGenres, $page);

        return view('tv.page', $viewModel);
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
        $tvshow = Http::withToken(config('services.tmdb.token'))->get(config('services.tmdb.apiurl').'/tv/'.$id.'?append_to_response=videos,images,credits')->json();
        $viewModel = new TvShowViewModel($tvshow);
        return view('tv.show', $viewModel);
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
