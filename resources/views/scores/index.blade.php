@extends('layouts.app')

@section('content')
    @foreach($scores as $score)
        <h2 class="panel-heading "><span class="text-muted"><b>Ton score, partie du {{ $score->datePartie }}!</b></span> </h2>

        <div class="panel-body ">
            <div class="row">
                <div class="col-xs-7 container">
                    <div class="">
                        <label class="col-xs-5 ">Buy-in</label>
                        <p class="col-xs-7 text-right">{{ $score->buyIn }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                        <label class="col-xs-5 ">Mise</label>
                        <p class="col-xs-7 text-right">{{ $score->mise }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <label class="col-xs-5 ">Gains</label>
                        <p class="col-xs-7 text-right">{{ $score->gains }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <label class="col-xs-5">Bénéfice</label>
                        <p class="col-xs-7 text-right">{{ $score->benefice }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <label class="col-xs-5">Re-cave</label>
                        <p class="col-xs-7 text-right">{{ $score->recave }}</p>
                    </div>
                </div>
                <div class="col-xs-5 container">
                    <a href="{{ route('scores.edit', ['id' => $score->id]) }}" class="btn btn-warning ">Editer</a>
                    <form method="POST" action="{{ route('scores.destroy', ['id' => $score->id]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>

                </div>
            </div>

        </div>
        <hr>
    @endforeach
@endsection

@section('sideContent')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('scores.create') }}" class="btn btn-success">Add score</a>
        </div>

        <div class="panel-body ">
            <form id="select" class="form-horizontal" method="get" action="{{ route('scores.index') }}">

                <div class="form-group">
                    <label for="datePartie" class="col-md-4 control-label">Trier par:</label>

                    <div class="col-md-8">
                        <select class="form-control" onchange="document.getElementById('select').submit();" name="trie">
                            <option value="all" @isset($_GET['trie'])
                            @if ($_GET['trie'] == 'all')selected @endif
                            @endisset>Tous</option>
                            <option value="win" @isset($_GET['trie'])
                            @if ($_GET['trie'] == 'win')selected @endif
                                    @endisset>Victoire</option>
                            <option value="lost" @isset($_GET['trie'])
                            @if ($_GET['trie'] == 'lost')selected @endif
                                    @endisset>Défaite</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


