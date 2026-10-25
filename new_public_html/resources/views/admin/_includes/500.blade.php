@extends('admin.layout')

@section('main')
    <div class="col-12">
        <div class="card card-transparent mx-auto text-center">
            <h1 class="text-secondary lh-1" style="font-size: 200px">500</h1>
            <hr class="w-30px">
            <h3 class="text-uppercase">Internal server error</h3>

            <p class="lead">Looks like we have an internal issue, please try again in couple of minutes.</p>
            <br>
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center fs-14">
                <li class="nav-item">
                    <a class="nav-link" href="#">Report problem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Return home</a>
                </li>
            </ul>
        </div>
    </div>
@endsection