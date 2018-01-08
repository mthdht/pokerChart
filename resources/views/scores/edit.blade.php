@extends('layouts.app')

@section('content')

    <h2 class="panel-heading "><span class="text-muted"><b>Edit your score !</b></span> </h2>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('scores.update', ['id' => $score->id]) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('buyIn') ? ' has-error' : '' }}">
                <label for="buyIn" class="col-md-4 control-label">Buy In</label>

                <div class="col-md-6">
                    <input id="buyIn" type="number" class="form-control" name="buyIn" value="{{ $score->buyIn }}" required autofocus>

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
                    <input id="mise" type="number" class="form-control" name="mise" value="{{ $score->mise }}" required >

                    @if ($errors->has('mise'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mise') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('gains') ? ' has-error' : '' }}">
                <label for="buyIn" class="col-md-4 control-label">Gains</label>

                <div class="col-md-6">
                    <input id="gains" type="number" class="form-control" name="gains" value="{{ $score->gains }}" required >

                    @if ($errors->has('gains'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gains') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('datePartie') ? ' has-error' : '' }}">
                <label for="datePartie" class="col-md-4 control-label">Date de la partie</label>

                <div class="col-md-6">
                    <input id="datePartie" type="date" class="form-control" name="datePartie" value="{{ $score->datePartie }}" required >

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
@endsection
