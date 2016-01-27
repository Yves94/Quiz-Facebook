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
                            {{ 'Supprimer' }}
                        </th>

                    </tr>

                    @foreach ($quizzes as $k => $quiz)
                        <?php $creator = $quiz->creator()->get()->first() ?>
                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $quiz['id_quiz'] }}
                            </td>
                            <td>
                                {{ $quiz['title'] }}
                            </td>
                            <td>
                                {{
                                    $creator->first_name
                                    .' '.
                                        $creator->last_name
                                }}
                            </td>
                            <td>
                                {{ $quiz['slug'] }}
                            </td>
                            <td>
                                {{ $quiz['nb_question'] }}
                            </td>
                            <td>
                                {{ $quiz['summary'] }}
                            </td>
                            <td>
                                {{ $quiz['picture'] }}
                            </td>
                            <td>
                                {{ $quiz['start_date'] }}
                            </td>
                            <td>
                                {{ $quiz['end_start'] }}
                            </td>
                            <td>
                                {{ $quiz['color'] }}
                            </td>
                            <td>

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