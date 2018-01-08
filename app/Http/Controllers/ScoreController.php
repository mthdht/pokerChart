<?php

namespace App\Http\Controllers;

use App\Score;
use App\Http\Requests\ScoreRequest;

class ScoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \Auth::user()->scores;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScoreRequest $request)
    {
        $score = new Score($request->all());
        \Auth::user()->scores()->save($score);

        return redirect(route('scores.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $score = \Auth::user()->scores()->where('id', '=', $id)->first();
        return view('scores.show', ['score' => $score]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $score = \Auth::user()->scores()->where('id', '=', $id)->first();
        return view('scores.edit', ['score' => $score]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScoreRequest $request, $id)
    {
        $score = Score::findOrFail($id);
        $score->fill($request->all());
        \Auth::user()->scores()->save($score);
        return redirect(route('scores.show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Score::find($id)->delete();
        return redirect(route('scores.index'));
    }
}
