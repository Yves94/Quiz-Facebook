<!DOCTYPE html>
<html>
    <head>
         <link href="{{ secure_asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
         <script src="{{ secure_asset('assets/js/jquery-2.2.0.min.js') }}"></script>
         <script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
         <title>Qiz - Accueil</title>
    </head>
<body>
    <div class="container">
        <!-- Menu -->
        <nav class="navbar" style="font-size: 20px; margin-bottom: -21px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" style="font-size: 30px;">Q'IZ</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Classement</a></li>
                    <li><a href="#">Historique</a></li>
                </ul>
                <!-- Bouton de droite -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0)"><span class="glyphicon glyphicon-flash"></span> Ratio : 0.91</a></li>
                    @role('Admin')
                        <li>{!! Html::linkRoute('admin_quiz_list', '<span class="glyphicon glyphicon-cog"></span>') !!}</li>
                    @endrole
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span></a></li>
                </ul>
                <!-- Champ de recherche -->
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher un Quiz">
                    </div>
                </form>
            </div>
        </nav>

        <hr>

    <div class="row">
            <!-- Affichage de tous les quiz -->
            @if(isset($quiz))
                @foreach ($quiz as $qiz)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="thumbnail" style="padding:0;">
                        <!-- Barre de progression -->
                                <div class="progress" style="padding: 0; border:none;">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ round((time()-strtotime($qiz->start_date))/(strtotime($qiz->end_start)-strtotime($qiz->start_date))*100) }}%; background-color: {{ $qiz->color }}; box-shadow: none;">
                                        <b>{{ date('d', strtotime($qiz->end_start) - time()) }}</b> jour(s) restant(s)
                                    </div>  
                                </div>
                            <!-- Photo associé -->
                            <img data-holder-rendered="true" src="{{ asset('assets/quizPicture/'. $qiz->picture) }}">
                            
                            <div class="caption">
                                <!-- Info sur le quiz -->
                                <h3>{{ $qiz->title }} <span class="badge" style="background-color: {{ $qiz->color }}; color: #fff;">{{ $qiz->nb_questions }} questions</span></h3>
                                <p>Créé le : {{ date('d/m/Y', strtotime($qiz->start_date)) }}</p>
                                <p>{{ $qiz->summary }}</p>     

                                <!-- Bouton renvoyant vers le quiz -->
                                <a href="{{ $qiz->slug }}" class="btn btn-default" role="button" style="width: 100%; background-color: {{ $qiz->color }}; color: #fff;"><b>Jouer</b></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
