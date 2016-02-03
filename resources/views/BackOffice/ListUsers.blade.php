@extends('Layout.BackOffice')

@section('title', 'Les utilisateurs')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/user/list','method'=>'POST']) !!}
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
                            {{ 'Civilité' }}
                        </th>
                        <th>
                            {{ 'Nom' }}
                        </th>
                        <th>
                            {{ 'Prénom' }}
                        </th>
                        <th>
                            {{ 'Age' }}
                        </th>
                        <th>
                            {{ 'Email' }}
                        </th>
                    </tr>

                    @foreach ($users as $k => $user)

                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $user->id_user }}
                            </td>
                            <td>
                                {{ $user->gender }}
                            </td>
                            <td>
                                {{ $user->last_name }}
                            </td>
                            <td>
                                {{ $user->first_name }}
                            </td>
                            <td>
                                {{ $user->age_rangs }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $users->render() !!}
            </div>
        </div>

    </div>


@endsection