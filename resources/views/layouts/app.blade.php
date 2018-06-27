{{--
  -- App
  -- The base layout for each pages
  --
  -- @author Bastien Nicoud
  --}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="/favicon.png" rel="icon" data-n-head="true" type="image/png">

    {{-- Styles --}}
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    @stack('styles')
    <script defer src="{{ mix('js/fontawesome/all.js') }}"></script>
</head>

<body>
    @include('layouts.navbar')

    {{-- @include('layouts.breadcrum') --}}

    @include('layouts.flash_message')

    @yield('content')

    {{-- Scripts --}}
    <script src="{{ mix('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>