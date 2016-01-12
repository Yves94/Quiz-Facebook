@extends('Layout.BackOffice')

@section('title', 'Les Quizzes')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>
                            {{ 'Id' }}
                        </th>
                        <th>
                            {{ 'Titre' }}
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

                    </tr>

                    @foreach ($quizzes as $k => $quiz)
                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $quiz->id }}
                            </td>
                            <td>
                                {{ $quiz->title }}
                            </td>
                            <td>
                                {{ $quiz->slug }}
                            </td>
                            <td>
                                {{ $quiz->nb_question }}
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
                                {{ $quiz->end_start }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>


@endsection