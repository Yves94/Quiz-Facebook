@extends('Layout.BackOffice')

@section('title', 'Creer une qestion')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/question/add','method'=>'POST']) !!}

                <div class="form-group">
                    {!! Form::label('question', 'Question') !!}
                    {!! Form::text('question',$question->wording_question, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Categories') !!}<br />
                    {!! Form::select('categories[]',
                    $categories,
                    null,
                    ['class' => 'form-control multiselect',
                    'multiple' => 'multiple']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <!-- answer -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">

                        {!! Form::label('Les réponses') !!}
                        {!! Form::text('answer1',null, ['class' => 'form-control','placeholder' => 'Réponse 1']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('Choisissez la bonne réponse') !!}<br>
                        {!!   Form::radio('good_answer', 1) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('answer2',null, ['class' => 'form-control','placeholder' => 'Réponse 2']) !!}
                    </div>
                    <div class="col-md-6">
                        {!!   Form::radio('good_answer', 1) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('answer2',null, ['class' => 'form-control','placeholder' => 'Réponse 3']) !!}
                    </div>
                    <div class="col-md-6">
                        {!!   Form::radio('good_answer', 1) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('answer2',null, ['class' => 'form-control','placeholder' => 'Réponse 4']) !!}
                    </div>
                    <div class="col-md-6">
                        {!!   Form::radio('good_answer', 1) !!}
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::submit('Valider') !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection