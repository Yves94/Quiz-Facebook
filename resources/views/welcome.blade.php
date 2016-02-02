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

      TESSSSST
    </div>
       <h3> {{ Session::get('name') }}</h3> 
       <h3>  {{ Session::get('facebook_access_token') }}</h3> 
</body>
</html>
