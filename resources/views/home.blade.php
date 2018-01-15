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
                                    {{ round($scoresOrder->sum('gains') / $scoresOrder->sum('mise'), 2) }}
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
                        <a href="{{ route('scores.index') }}" class="btn btn-info"> Voir les scores</a>
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

