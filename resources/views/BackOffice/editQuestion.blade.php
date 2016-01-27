@extends('Layout.BackOffice')

@section('title', 'modif question')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/question/edit/'.$question->id_question,'method'=>'POST']) !!}

                <div class="form-group">
                    {!! Form::label('wording_question', 'Question') !!}
                    {!! Form::text('wording_question',$question->wording_question, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Categories') !!}<br />
                    {!! Form::select('categories[]',
                    $categories,
                    $categoriesSelected,
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