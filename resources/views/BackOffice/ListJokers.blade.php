@extends('Layout.BackOffice')

@section('title', 'Les Categories')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/joker/list','method'=>'POST']) !!}
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

                    @foreach ($jokers as $k => $joker)

                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $joker->id_joker }}
                            </td>
                            <td>
                                {{ $joker->wording_joker }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $jokers->render() !!}
            </div>
        </div>

    </div>


@endsection