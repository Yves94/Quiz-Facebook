
<html>
<head>
    <title>Quiz FB - @yield('title')</title>

    <link href="{{ secure_asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="{{ secure_asset('assets/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>

    <link href="{{ secure_asset('assets/css/bootstrap-multiselect.min.css') }}" rel="stylesheet">
    <script src="{{ secure_asset('assets/js/bootstrap-multiselect.js') }}"></script>

    <!-- ... -->
    <script type="text/javascript" src="{{ secure_asset('assets/bower_components/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ secure_asset('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{ secure_asset('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


</head>
<body>
    @section('sidebar')
   
    <nav class="navbar navbar-inverse">
     <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Brand</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="dropdown {{ Route::current()->getName() == "admin_quiz_list" || Route::current()->getName() == "admin_quiz_add" ? "active" : "" }}">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">Quiz <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Route::current()->getName() == "admin_quiz_list" ? "active" : "" }}">{!! Html::linkRoute('admin_quiz_list', 'Liste') !!}</li>
                            <li class="{{ Route::current()->getName() == "admin_quiz_add" ? "active" : "" }}">{!! Html::linkRoute('admin_quiz_add', 'Ajouter') !!}</li>
                        </ul>
                    </li>
                    <li class="{{ Route::current()->getName() == "admin_question_list" ? "active" : "" }}">{!! Html::linkRoute('admin_question_list', 'Questions') !!}</li>
                    <li class="{{ Route::current()->getName() == "admin_category_list" ? "active" : "" }}">{!! Html::linkRoute('admin_category_list', 'Catégories') !!}</li>
                    <li class="{{ Route::current()->getName() == "admin_user_list" ? "active" : "" }}">{!! Html::linkRoute('admin_user_list', 'Utilisateurs') !!}</li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="">
                            <span class="glyphicon glyphicon-cog"></span>
                            Paramètres
                        </a>
                    </li>
                </ul>
            </div>
        </div>
         </div>
    </nav>
<<<<<<< HEAD

    @show
    <script>
        $(document).ready(function() {
            $('.datepicker').datetimepicker({
                locale: 'fr',
            //format: 'd/MM/YYYY'
            format: 'L'
        });
            $('.multiselect').multiselect({
                nonSelectedText: 'Selectionnez une valeur',
                allSelectedText: 'Tout est sélectionné'
            });
        });
    </script>
    <div class="container">
        @if (Session::has("flash_message"))
        <div class="alert alert-success">
         <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
         {{ Session::get("flash_message") }}
     </div>
     @endif

=======

    @show

    <div class="container">
        @if (Session::has("flash_message"))
        <div class="alert alert-success">
         <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
         {{ Session::get("flash_message") }}
     </div>
     @endif

>>>>>>> heroku/endbo
     @if( $errors->any())
     <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    @yield('content')
</div>


    <script>
        $(document).ready(function() {
            $('.datepicker').datetimepicker({
                locale: 'fr',
                //format: 'd/MM/YYYY'
                format: 'L'
            });
            $('.multiselect').multiselect({
                nonSelectedText: 'Selectionnez une valeur',
                allSelectedText: 'Tout est sélectionné'
            });
        });

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

</body>
</html>