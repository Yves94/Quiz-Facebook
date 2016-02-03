@extends('Layout.BackOffice')

@section('title', 'Les Quizzes')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/quiz/list','method'=>'POST']) !!}
                <div class="form-group">
                    {!! Form::text('search',null, ['class' => 'form-control', 'placeholder' => 'Rechercher']) !!}
                    <i class="glyphicon glyphicon-search form-control-feedback" style="margin-right: 20px; line-height: 39px"></i>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <h2>Tout les Quiz</h2>
        <div class="row add">
            <div class="col-md-12">
                <a href="{{url('admin/quiz/add')}}">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Ajouter
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bo">
                    <tr>
                        <th>
                            {{ 'Id' }}
                        </th>
                        <th>
                            {{ 'Titre' }}
                        </th>
                        <th>
                            {{ 'Author' }}
                        </th>
                        <th>
                            {{ 'Slug' }}
                        </th>
                        <th>
                            {{ 'Nombre de Question' }}
                        </th>
                        <th>
                            {{ 'Sommaire' }}
                        </th>
                        <th>
                            {{ 'Image' }}
                        </th>
                        <th>
                            {{ 'Date de début' }}
                        </th>
                        <th>
                            {{ 'Date de fin' }}
                        </th>
                        <th>
                            {{ 'Color' }}
                        </th>
                        <th>
                            {{ 'Participants' }}
                        </th>
                        <th>
                            {{ 'Modifier' }}
                        </th>
                        <th>
                            {{ 'Supprimer' }}
                        </th>


                    </tr>

                    @foreach ($quizzes as $k => $quiz)
                        <?php $creator = $quiz->creator()->get()->first() ?>
                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $quiz->id_quiz }}
                            </td>
                            <td>
                                {{ $quiz->title }}
                            </td>
                            <td>
                                {{
                                $creator->first_name
                                .' '.
                                $creator->last_name
                            }}
                            </td>
                            <td>
                                {{ $quiz->slug }}
                            </td>
                            <td>
                                {{ $quiz->nb_questions }}
                            </td>
                            <td>
                                {{ $quiz->summary }}
                            </td>
                            <td>
                                {{ $quiz->picture }}
                            </td>
                            <td>
                                {{ $quiz->start_date }}
                            </td>
                            <td>
                                {{ $quiz->end_date }}
                            </td>
                            <td>
                                {{ $quiz->color }}
                            </td>
                            <td>
                                <a href="{{url('admin/quiz/participants/')}}/{{$quiz->slug}}">
                                    <button type="button" class="btn btn-primary btn-xs">Voir les participants</button>

                                </a>
                            </td>
                            <td>
                                <a href="{{url('admin/quiz/edit')}}/{{$quiz->slug}}">
                                    {!! Form::button('<i class="glyphicon glyphicon-pencil"></i>', array('type' => 'button', 'class' => 'btn btn-info btn-xs')) !!}
                                </a>
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['admin_quiz_delete', $quiz->id_quiz], 'onsubmit' => 'return ConfirmDelete()']) !!}

                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}

                                {!! Form::close() !!}

                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $quizzes->render() !!}
            </div>
        </div>

    </div>

@endsection