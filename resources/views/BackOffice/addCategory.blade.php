@extends('Layout.BackOffice')

@section('title', 'Creer une category')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/category/add','method'=>'POST']) !!}

                <div class="form-group">
                    {!! Form::label('wording_category', 'Category') !!}
                    {!! Form::text('wording_category',$category->wording_category, ['class' => 'form-control']) !!}
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