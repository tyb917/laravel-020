@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <example></example>
        	@if (Auth::check() && Auth::user()->hasRole(['root', 'admin']))
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-tokens></passport-personal-tokens>
            @endif
        </div>
    </div>
</div>
@endsection