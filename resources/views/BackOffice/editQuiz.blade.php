@extends('Layout.BackOffice')

@section('title', 'unquiz')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/quiz/edit/test','method'=>'POST']) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title',null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug','Slug') !!}
                        {!! Form::text('test',null, ['class' => 'form-control']) !!}
                    </div>
                <div class="form-group">
                    {!! Form::label('nb_question','Nombre de question') !!}
                    {!! Form::text('test',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('summary','Description') !!}
                    {!! Form::text('description',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('picture','Image') !!}
                    {!! Form::text('picture',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('start_date','Date de d&eacute;but') !!}
                    {!! Form::text('start_date',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('end_start','Date de fin') !!}
                    {!! Form::text('end_start',null, ['class' => 'form-control']) !!}
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