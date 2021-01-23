@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><strong>Page Not Found</strong></h2>
                <p class="text-center mb-5">Sorry, the page you are looking for is not available at the moment.</p>
                <img src="{{ asset('img/404.svg') }}" alt="">
            </div>
        </div>
    </div>
@endsection
