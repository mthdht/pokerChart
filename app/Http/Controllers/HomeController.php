<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // call all scores from database
        $scores = \Auth::user()->scores();
        //keep the last five for 5 last game tab and chart
        $lastScores = $scores->orderBy('datePartie','desc')->take(5)->get();
        //ordering to be date ascendant
        $lastScoresOrder = $lastScores->reverse();
        //prepare data for 5 last game data chart
        $lastGameData[] = ['date Partie','Bénéfice'];
        foreach ($lastScoresOrder as $key => $score) {
                    $lastGameData[++$key] = [$score->datePartie, (int)$score->benefice];
        }
        // return the home view with all datas for display and charts
        return view('home', ['lastGameData' => json_encode($lastGameData), 'lastScores' => $lastScores]);
    }
}
