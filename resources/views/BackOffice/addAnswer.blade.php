@extends('Layout.BackOffice')

@section('title', 'Creer une réponse')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/answer/add','method'=>'POST']) !!}

                <div class="form-group">
                    {!! Form::label('wording_answer', 'Category') !!}
                    {!! Form::text('wording_answer',$answer->wording_answer, ['class' => 'form-control']) !!}
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