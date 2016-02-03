@extends('Layout.BackOffice')

@section('title', 'unquiz')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/quiz/add','method'=>'POST','files' => true]) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title',$quiz->title, ['class' => 'form-control']) !!}
                    </div>

                <div class="form-group">
                    {!! Form::label('nb_questions','Nombre de question') !!}
                    {!! Form::text('nb_questions',$quiz->nb_questions, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('summary','Description') !!}
                    {!! Form::text('summary',$quiz->summary, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('picture','Image') !!}
                    {!! Form::file('picture',$quiz->picture, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('start_date','Date de début') !!}
                    <div class='input-group date datepicker'>
                        {!! Form::text('start_date',$quiz->start_date, ['class' => 'form-control']) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('end_date','Date de fin') !!}
                    <div class='input-group date datepicker'>
                        {!! Form::text('end_date',$quiz->end_date, ['class' => 'form-control']) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('color','couleur') !!}
                    {!! Form::text('color',$quiz->color, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Valider') !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection