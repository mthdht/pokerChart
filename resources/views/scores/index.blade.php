@extends('layouts.app')

@section('leftSideContent')
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

@section('content')
    <div class="panel panel-default">
        <h2 class="panel-heading "><span class="text-muted"><b>Tous les scores!</b></span> </h2>
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
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($scores as $score)
                        <tr class="{{ $score->benefice >= 0 ? $score->benefice > 0 ? 'success': '' : 'danger' }}">
                            <td>{{ $score->id }}</td>
                            <td>{{ $score->buyIn }}</td>
                            <td>{{ $score->mise }}</td>
                            <td>{{ $score->gains }}</td>
                            <td>{{ $score->benefice }}</td>
                            <td>{{ $score->recave }}</td>
                            <td>{{ $score->datePartie }}</td>
                            <td>
                                <a href="{{ route('scores.show', ['id' => $score->id]) }}" class="btn btn-info ">Voir</a>
                                <a href="{{ route('scores.edit', ['id' => $score->id]) }}" class="btn btn-warning ">Editer</a>
                                <form method="POST" action="{{ route('scores.destroy', ['id' => $score->id]) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


