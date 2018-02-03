@extends('layouts.master')

@section('main')
    
    @include('layouts.partials.header')
    
    @yield('content')
    
    @include('layouts.partials.footer')

    <cookies-advise href="{{ route('site.legal') }}"></cookies-advise>

    <unavailable-link></unavailable-link>

    <contact-dialog></contact-dialog>

    <appointment-dialog></appointment-dialog>

    <urgency-dialog></urgency-dialog>
    
    <div id="page-loader" class="d-flex justify-content-center align-items-center" hidden>
        <img src="{{ asset('images/imagotipo-menu.svg') }}" height=120 alt="">
        <page-loader></page-loader>
    </div>

@stop