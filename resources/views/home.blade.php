@extends('layouts.app')

@if($scoresOrder->count())
    @section('leftSideContent')
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <b class="col-xs-8 text-muted">Ajouter un score </b>
                    <a href="{{ route('scores.create') }}" class="btn btn-success"> +</a>
                </div>
            </div>
            <div class="panel-body"></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <b class="text-muted">Quelques chiffres !</b>
                </div>
            </div>

            <div id="" class="panel-body">
                <table class="table table-responsive table-striped">
                    <tr>
                        <td><b>Bénéfices totale</b></td>
                        <td class="{{ $scoresOrder->sum('benefice') >=0 ? 'text-success' : 'text-danger' }} text-center"><b> {{$scoresOrder->sum('benefice')}} <i class="fa fa-eur" aria-hidden="true"></i></b></td>
                    </tr>
                    <tr>
                        <td><b>Nombres de partie</b></td>
                        <td class="text-center"><b> {{ $scoresOrder->count() }}</b></td>
                    </tr>
                    <tr>
                        <td><b>Meilleur gain</b></td>
                        <td class="text-center"><b>{{ $scoresOrder->max('Gains') }} <i class="fa fa-eur" aria-hidden="true"></i></b></td>
                    </tr>
                    <tr>
                        <td><b>Pire perte</b></td>
                        <td class="text-center text-danger"><b>{{ $scoresOrder->min('benefice') }} <i class="fa fa-eur" aria-hidden="true"></i></b></td>
                    </tr>
                    <tr>
                        <td><b>Bénéfice moyen</b></td>
                        <td class="{{ $scoresOrder->avg('benefice') >=0 ? 'text-success' : 'text-danger' }} text-center"><b>{{ round($scoresOrder->avg('benefice')) }} <i class="fa fa-eur" aria-hidden="true"></i></b></td>
                    </tr>
                    <tr>
                        <td><b>Parties gagnantes</b></td>
                        <td class="text-center"><b>{{ $scoresOrder->filter(function ($score, $key) {return $score->benefice > 0;})->count() }} </b> / {{ round($scoresOrder->filter(function ($score, $key) {return $score->benefice > 0;})->count() / $scoresOrder->count() *100) }}%</td>
                    </tr>
                    <tr>
                        <td><b>Parties perdantes</b></td>
                        <td class="text-center"><b>{{ $scoresOrder->filter(function ($score, $key) {return $score->benefice < 0;})->count() }} </b> / {{ round($scoresOrder->filter(function ($score, $key) {return $score->benefice < 0;})->count() / $scoresOrder->count() *100) }}%</b></td>
                    </tr>
                </table>
            </div>
        </div>
    @endsection

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
                    <div class="col-xs-6 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Dernier jeu
                            </div>

                            <div class="panel-body">
                                <div class="row {{ $scoresOrder->last()->benefice >= 0 ? 'text-success' : 'text-danger' }}">
                                    <span class="col-xs-5">
                                        <i class="fa fa-3x fa-money" aria-hidden="true"></i>
                                    </span>

                                    <span class="col-xs-7"><b>
                                    Gains <br> {{ $scoresOrder->last()->benefice }}<i class="fa fa-dollar" aria-hidden="true"></i></b>
                                </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                toutes Parties
                            </div>

                            <div class="panel-body">
                                <div class="row {{ $scoresOrder->sum('benefice') >= 0 ? 'text-success' : 'text-danger' }}">
                                <span class="col-xs-5">
                                    <i class="fa fa-3x fa-eur" aria-hidden="true"></i>
                                </span>

                                    <span class="col-xs-7 ">
                                    <b>Bénéfice<br>
                                        {{ $scoresOrder->sum('benefice') }}
                                        <i class="fa fa-dollar" aria-hidden="true"></i></b>
                                </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-6 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Gains / mise
                            </div>

                            <div class="panel-body">
                                <div class="row {{ $scoresOrder->sum('benefice') / $scoresOrder->sum('mise') >= 1 ? 'text-success' : 'text-danger' }}">
                                <span class="col-xs-5">
                                    <i class="fa fa-3x fa-area-chart" aria-hidden="true"></i>
                                </span>

                                    <span class="col-xs-7 ">
                                    <b>Ratio<br>
                                        {{ round($scoresOrder->sum('Gains') / $scoresOrder->sum('mise'), 2) }}
                                        <i class="fa " aria-hidden="true"></i></b>
                                </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="beneficesPerGame panel panel-warning">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <b class="col-xs-8 ">Bénéfice par partie </b>
                            <a href="{{ route('scores.index') }}" class="btn btn-default"> Voir les scores</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="beneficesPerGameChart" class="panel-body"></div>
                    </div>
                </div>

                <div class="lastGame panel panel-warning">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <b class="col-xs-8 "> 5 dernières parties </b>
                            <a href="{{ route('scores.index') }}" class="btn btn-default"> Voir les scores</a>
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
                                        <td>{{ $score->Gains }}</td>
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

            <div id="last5GamesColumnChart" class="panel-body"></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <b class="text-muted">Win / Lost</b>
                </div>
            </div>

            <div id="winLostDonutChart" class="panel-body"></div>
        </div>
    @endsection

    @push('scripts')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart'], 'language': 'fr'});
            google.charts.load('current', {packages: ['line'], 'language': 'fr'});
            google.charts.load('current', {packages: ['bar'], 'language': 'fr'});
            google.charts.setOnLoadCallback(draw5LastGameBeneficeChart);
            google.charts.setOnLoadCallback(drawWinLostDonutChart);
            google.charts.setOnLoadCallback(drawBeneficesPerGameChart);

            function draw5LastGameBeneficeChart() {
                // Define the chart to be drawn.
                var result = <?php echo $lastGameData?>;
                console.log(result);
                var data = new google.visualization.arrayToDataTable(result);
                var options = {
                    'legend': 'bottom',
                    'is3D': true,
                };
                // Instantiate and draw the chart.
                var chart = new google.charts.Bar(document.getElementById('last5GamesColumnChart'));
                chart.draw(data, google.charts.Line.convertOptions(options));
            }

            function drawWinLostDonutChart() {
                var result = <?php echo $winLostData?>;
                console.log(result);
                var data = new google.visualization.arrayToDataTable(result);
                var options = {
                    'legend': 'bottom',
                    'pieHole': '0.4',
                };
                // Instantiate and draw the chart.
                var chart = new google.visualization.PieChart(document.getElementById('winLostDonutChart'));
                chart.draw(data, options);
            }

            function drawBeneficesPerGameChart() {
                var result = <?php echo $beneficesPerPartie?>;
                console.log(result);
                var data = new google.visualization.arrayToDataTable(result);
                var options = {
                    'legend': 'bottom',
                };
                // Instantiate and draw the chart.
                var chart = new google.charts.Line(document.getElementById('beneficesPerGameChart'));
                chart.draw(data, google.charts.Line.convertOptions(options));
            }

        </script>
    @endpush
@else
    @section('content')
        <div class="panel panel-default">
        <h2 class="panel-heading">Add New Score ! </h2>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('scores.store') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('buyIn') ? ' has-error' : '' }}">
                    <label for="buyIn" class="col-md-4 control-label">Buy In</label>

                    <div class="col-md-6">
                        <input id="buyIn" type="number" class="form-control" name="buyIn" value="{{ old('buyIn') }}" required autofocus>

                        @if ($errors->has('buyIn'))
                            <span class="help-block">
                            <strong>{{ $errors->first('buyIn') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('mise') ? ' has-error' : '' }}">
                    <label for="buyIn" class="col-md-4 control-label">Mise</label>

                    <div class="col-md-6">
                        <input id="mise" type="number" class="form-control" name="mise" value="{{ old('mise') }}" required >

                        @if ($errors->has('mise'))
                            <span class="help-block">
                            <strong>{{ $errors->first('mise') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('Gains') ? ' has-error' : '' }}">
                    <label for="buyIn" class="col-md-4 control-label">Gains</label>

                    <div class="col-md-6">
                        <input id="gains" type="number" class="form-control" name="gains" value="{{ old('Gains') }}" required >

                        @if ($errors->has('Gains'))
                            <span class="help-block">
                            <strong>{{ $errors->first('Gains') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('datePartie') ? ' has-error' : '' }}">
                    <label for="datePartie" class="col-md-4 control-label">Date de la partie</label>

                    <div class="col-md-6">
                        <input id="datePartie" type="date" class="form-control" name="datePartie" value="{{ old('datePartie') }}" required >

                        @if ($errors->has('datePartie'))
                            <span class="help-block">
                            <strong>{{ $errors->first('datePartie') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
@endif



