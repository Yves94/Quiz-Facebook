@extends('Layout.BackOffice')

@section('title', 'Les Quizzes')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
        <h2>Liste des participants</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover ">
                    <tr>
                        <th>
                            {{ 'Id' }}
                        </th>
                        <th>
                            {{ 'Nom' }}
                        </th>
                        <th>
                            {{ 'Prenom' }}
                        </th>
                        <th>
                            {{ 'Email' }}
                        </th>
                        <th>
                            {{ 'Age' }}
                        </th>
                        <th>
                            {{ 'Anniversaire' }}
                        </th>
                    </tr>

                    @forelse ($entrants as $k => $entrant)
                        <tr @if($k%2==0) class="info" @endif>
                            <td>
                                {{ $entrant->id_user }}
                            </td>
                            <td>
                                {{ $entrant->last_name }}
                            </td>
                            <td>
                                {{ $entrant->first_name }}
                            </td>
                            <td>
                                {{ $entrant->email }}
                            </td>
                            <td>
                                {{ $entrant->age_rangs }}
                            </td>
                            <td>
                                {{ $entrant->birthday }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td>Aucun participant</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td></td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>

    </div>


@endsection