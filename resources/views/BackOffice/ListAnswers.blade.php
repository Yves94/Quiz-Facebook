@extends('Layout.BackOffice')

@section('title', 'Les réponses')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/answer/list','method'=>'POST']) !!}
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
                            {{ 'Réponse' }}
                        </th>
                    </tr>

                    @foreach ($answers as $k => $answer)

                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $answer->id_answer }}
                            </td>
                            <td>
                                {{ $answer->wording_answer }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $answers->render() !!}
            </div>
        </div>

    </div>


@endsection