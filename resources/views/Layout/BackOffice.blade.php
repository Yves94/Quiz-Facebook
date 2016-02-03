
<html>
<head>
    <title>Quiz FB - @yield('title')</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <link href="{{ asset('assets/css/bootstrap-multiselect.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/bootstrap-multiselect.js') }}"></script>

    <!-- ... -->
    <script type="text/javascript" src="{{ asset('assets/bower_components/moment/min/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


</head>
<body>
@section('sidebar')
    <nav class="navbar navbar-inverse">
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
                            <li class="{{ Route::current()->getName() == "admin_quiz_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/quiz/list">Liste</a></li>
                            <li class="{{ Route::current()->getName() == "admin_quiz_add" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/quiz/add">Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="{{ Route::current()->getName() == "admin_question_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/question/list">Question</a></li>
                    <li class="{{ Route::current()->getName() == "admin_category_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/category/list">Category</a></li>
                    <li class="{{ Route::current()->getName() == "admin_answer_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/answer/list">Answer</a></li>
                    <li class="{{ Route::current()->getName() == "admin_user_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/user/list">user</a></li>
                    <li class="{{ Route::current()->getName() == "admin_jocker_list" ? "active" : "" }}"><a href="http://localhost/quizfb/public/admin/joker/list">joker</a></li>

                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">link</a></li>
                </ul>
            </div>
        </div>
    </nav>
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

        @if( $errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    @yield('content')
</div>

</body>
</html>