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
        $scores = \Auth::user()->scores;
        //ordering to be date ascendant
        $scoresOrder = $scores->sortBy('datePartie');
        //prepare data for 5 last game data chart
        $lastScores = $scoresOrder->take(-5);
        $lastGameData[] = ['date Partie','Bénéfice'];
        foreach ($lastScores as $key => $score) {
                    $lastGameData[++$key] = [$score->datePartie, (int)$score->benefice];
        }


        // return the home view with all datas for display and charts
        return view('home', ['lastGameData' => json_encode($lastGameData), 'scoresOrder' => $scoresOrder, 'lastScores' => $lastScores]);
    }
}
