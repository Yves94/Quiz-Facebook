@extends('Layout.BackOffice')

@section('title', 'Creer une réponse')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/user/add/'.$user->id_user,'method'=>'POST']) !!}


                <div class="form-group">
                    {!! Form::label('first_name', 'prénom') !!}
                    {!! Form::text('first_name',$user->first_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', 'prénom') !!}
                    {!! Form::text('last_name',$user->last_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email :') !!}
                    {!! Form::text('email',$user->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('birthday','Date d\'anniversaire') !!}
                    <div class='input-group date datepicker'>
                        {!! Form::text('birthday',$user->birthday, ['class' => 'form-control', 'placeholder' => '01/01/1990']) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sel1">{{ 'Civlité' }}</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0" {{ $user->birthday == "0" ? 'selected="selected"' : '' }}>Mme</option>
                        <option value="1" {{ $user->birthday == "1" ? 'selected="selected"' : '' }}>M</option>
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::submit('Valider') !!}
                </div>
                {!! Form::close() !!}

                @if( $errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>


@endsection