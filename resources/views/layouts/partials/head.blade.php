
<!-- Configuration -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon -->
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16" />

<!-- Styles -->
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
<link href="{{ asset('/css/all.css') }}" rel="stylesheet">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]); !!}
</script>