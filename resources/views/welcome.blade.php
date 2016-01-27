<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
         <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
         <script src="{{ asset('assets/js/jquery-2.2.0.min.js') }}"></script>
         <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel</div>
            </div>
        </div>
    </body>
    <script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</html>
