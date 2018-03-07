{{--
    INDEX - the base template for the app
    @author Bastien Nicoud
--}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        {{--  Metas  --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{--  CSRF token  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--  App datas  --}}
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="icon.png" />

        {{--  Styles  --}}
        <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
        <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app"></div>

        {{--  App playload  --}}
        {{--  Laravel pre inject datas here to prevent over requesting the server  --}}
        <script>
            window.__INITIAL_STATE__ = {!! json_encode($user) !!}
        </script>

        {{--  Scripts  --}}
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/main.js') }}"></script>
    </body>

</html>