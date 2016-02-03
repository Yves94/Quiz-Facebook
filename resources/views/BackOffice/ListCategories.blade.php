@extends('Layout.BackOffice')

@section('title', 'Les Categories')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/category/list','method'=>'POST']) !!}
                <div class="form-group">
                    {!! Form::label('search', 'Rechercher') !!}
                    {!! Form::text('search',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Rechercher') !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>
                            {{ 'Id' }}
                        </th>
                        <th>
                            {{ 'Categorie' }}
                        </th>
                    </tr>

                    @foreach ($categories as $k => $category)

                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $category->id_category }}
                            </td>
                            <td>
                                {{ $category->wording_category }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $categories->render() !!}
            </div>
        </div>

    </div>


@endsection