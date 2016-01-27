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