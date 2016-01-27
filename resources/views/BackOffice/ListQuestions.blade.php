@extends('Layout.BackOffice')

@section('title', 'Les Question')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['url' => 'admin/question/list','method'=>'POST']) !!}
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
                            {{ 'Question' }}
                        </th>
                        <th>
                            {{ 'Réponses' }}
                        </th>
                        <th>
                            {{ 'Categorie' }}
                        </th>
                    </tr>

                    @foreach ($questions as $k => $question)
                        <!-- display answers-->
                        <?php $answers = $question->answers()->get() ?>
                        {{$answers_text = ''}}
                        @foreach($answers as $k_answer => $answer)
                            <?php $answers_text .= $answer->wording_answer ?>
                            @if(count($answers)-1 != $k_answer)
                                    <?php $answers_text .= ' - ' ?>
                            @endif
                        @endforeach
                                <!-- display categorie-->
                        <?php $categories = $question->categories()->get() ?>

                        {{$categories_text = ''}}
                        @foreach($categories as $k_category => $category)
                            <?php $categories_text .= $category->wording_category ?>
                            @if(count($categories)-1 != $k_category)
                                <?php $categories_text .= ' - ' ?>
                            @endif
                        @endforeach
                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $question->id_question }}
                            </td>
                            <td>
                                {{ $question->wording_question }}
                            </td>
                            <td>
                                {{ $answers_text }}
                            </td>
                            <td>
                                {{ $categories_text }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!-- generate links to the rest of the pages -->

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                {!! $questions->render() !!}
            </div>
        </div>

    </div>


@endsection