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
        $this->middleware('auth', ['only' => 'switchSubStatus', 'comment']);
        $this->middleware('admin', ['except' => ['index', 'view', 'switchSubStatus', 'comment', 'rate']]);
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
    public function view($id)
    {
        $film = Film::findById($id);
        $comments = $film->comments()->orderBy('comments.created_at', 'desc')->get();


       // dd($comments);
      //  $film =  $film->;
      //  $releaseDate = $film->date->diffForHumans();
        //temp
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $rate = $film->rating()->find($user_id)->get();
            $sub = $film->getSubStatus();
        }
        dd($rate);
        return view('film/view', compact('film', 'comments', 'sub', 'rate'));
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

    //add new comment
    public function comment($id)
    {
        $comment = Input::get('comment');
        $film = Film::findById($id);
        $user_id = Auth::user()->id;
        $film->comments()->attach($user_id, array('comment' => $comment));
        return Redirect::back();
    }

    //add new rate
    public function rate($id)
    {
        if(Request::ajax()){

            $rate = Input::get('rate');
            $film = Film::findById($id);
            $user_id = Auth::user()->id;
            $film->rating()->attach($user_id, array('rate' => $rate));

            return true;
        }
        return false;
    }
}
