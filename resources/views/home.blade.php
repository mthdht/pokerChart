@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><b class="text-muted">Dashboard</b></div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="rapid row">
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dernier jeu
                            <a href=""><i class="fa fa-2x fa-arrow-circle-o-right pull-right" aria-hidden="true"></i></a>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                            <span class="col-xs-5">
                                <i class="fa fa-3x fa-money" aria-hidden="true"></i>
                            </span>

                                <span class="col-xs-7"><b>
                                Gains <br><i class="fa fa-dollar" aria-hidden="true"></i></b>
                            </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Voir Stats
                            <a href=""><i class="fa fa-2x fa-arrow-circle-o-right pull-right" aria-hidden="true"></i></a>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                            <span class="col-xs-5">
                                <i class="fa fa-3x fa-eur" aria-hidden="true"></i>
                            </span>

                                <span class="col-xs-7 ">
                                <b>Bénéfice<br>
                                    <i class="fa fa-dollar" aria-hidden="true"></i></b>
                            </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Voir Stats
                            <a href=""><i class="fa fa-2x fa-arrow-circle-o-right pull-right" aria-hidden="true"></i></a>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                            <span class="col-xs-5">
                                <i class="fa fa-3x fa-area-chart" aria-hidden="true"></i>
                            </span>

                                <span class="col-xs-7 ">
                                <b>Ratio<br>
                                    <i class="fa fa-dollar" aria-hidden="true"></i></b>
                            </span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Voir Stats
                            <a href=""><i class="fa fa-2x fa-arrow-circle-o-right pull-right" aria-hidden="true"></i></a>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                            <span class="col-xs-5">
                                <i class="fa fa-3x fa-area-chart" aria-hidden="true"></i>
                            </span>

                                <span class="col-xs-7 ">
                                <b>Bénéfice<br>
                                    <i class="fa fa-dollar" aria-hidden="true"></i></b>
                            </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="lastGame panel panel-warning">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <b class="col-xs-8 "> 5 dernières parties </b>
                        <a href="{{ route('scores.index') }}" class="btn btn-info"> Voir les scores</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Buy-In</th>
                                <th>Mise</th>
                                <th>Gains</th>
                                <th>Bénefices</th>
                                <th>Re-cave</th>
                                <th>Date partie</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lastScores as $score)
                                <tr class="{{ $score->benefice >= 0 ? $score->benefice > 0 ? 'success': '' : 'danger' }}">
                                    <td>{{ $score->id }}</td>
                                    <td>{{ $score->buyIn }}</td>
                                    <td>{{ $score->mise }}</td>
                                    <td>{{ $score->gains }}</td>
                                    <td>{{ $score->benefice }}</td>
                                    <td>{{ $score->recave }}</td>
                                    <td>{{ $score->datePartie }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('rightSideContent')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <b class="text-muted">5 last Game</b>
        </div>
    </div>

    <div id="myPieChart" class="panel-body"></div>
</div>
@endsection
