<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilmRequest;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Film;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class FilmController extends Controller
{
    //Create new film controller instance
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'switchSubStatus']);
        $this->middleware('admin', ['except' => ['index', 'show', 'switchSubStatus']]);
    }

    //show film list (10 films)
    public function index()
    {
        //scope
        //$films = Film::orderBy('date', 'asc')->released()->get();
        //without scope
        //$films = Film::orderBy('date', 'asc')->where('date', '>=', Carbon::now())->get();

        $films = Film::orderBy('date', 'asc')->take(10)->get();
        return view('main', compact('films'));
    }

    //show a single film view
    public function show($id)
    {
        $film = Film::findById($id);

      //  $film =  $film->;
      //  $releaseDate = $film->date->diffForHumans();
        //temp
        if(Auth::check()) $sub = $film->getSubStatus();

        return view('film/view', compact('film', 'sub'));
    }

    //save new film and redirect to film view
    public function store(FilmRequest $request)
    {
        $input = $request->all();
        $film = Film::create($input);
        return redirect('film/'.$film->id)->with('msg', 'Film was successfully created!');
    }

    //show edit film form
    public function edit($id)
    {
        $film = Film::findById($id);

        $date = Carbon::createFromFormat('d/m/Y', $film->date);

        return view('film/edit', compact('film', 'date'));
    }

    //update film
    public function update($id, FilmRequest $request)
    {
        $input = $request->all();
        $film = Film::findById($id);

        $film->update($input);

        return redirect('film/'.$film->id);
    }


    //switch subscription (sub/unsub)
    public function switchSubStatus($id, $status)
    {
        $film = Film::findById($id);
        $user_id = Auth::user()->id;

        if ($status == 'sub')
            $film->users()->attach($user_id);
        else
            $film->users()->detach($user_id);

        return Redirect::back()->with('msg', ($status == 'sub' ? 'Subscribed!' : 'Unsubscribed!'));
    }



}
