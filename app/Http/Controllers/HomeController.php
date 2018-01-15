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
        $lastScores = $scoresOrder->take(-5)->values();
        $lastGameData[] = ['date Partie', 'mise', 'gains'];
        foreach ($lastScores as $key => $score) {
                    $lastGameData[++$key] = [$score->datePartie, (int)$score->mise, (int)$score->gains];
        }
        // prepare data for win / lost donut chart
        $winLostData = [['win/lost', 'value'], ['Mise', $scoresOrder->sum('mise')], ['Gains', $scoresOrder->sum('gains')]];
        // prepare data for benefice per partie chart
        $beneficesPerPartie[] = ['date Partie', 'Bénéfices'];
        foreach ($scoresOrder->values() as $key => $score) {
            $beneficesPerPartie[++$key] = [$score->datePartie, (int)$score->benefice];
        }


        // return the home view with all datas for display and charts
        return view('home', array(
            'lastGameData' => json_encode($lastGameData),
            'winLostData'=>json_encode($winLostData),
            'beneficesPerPartie' => json_encode($beneficesPerPartie),
            'lastScores' => $lastScores,
            'scoresOrder' => $scoresOrder,
        ));
    }
}
