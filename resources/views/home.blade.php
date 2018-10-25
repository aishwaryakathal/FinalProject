@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >User Dashboard</div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif

                    <h2>News</h2>
        <ul>

        @foreach($newslist as $news)
      <div class="p-3 mb-2 bg-primary text-white">  <li class="list-group-item"><h5>Title: {{ $news->title }}</h5></div>
      <div class="p-3 mb-2 bg-secondary text-white"> <h5>Description:{{ $news->description }}</h5></li> </div>

          </br>
        @endforeach
        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
