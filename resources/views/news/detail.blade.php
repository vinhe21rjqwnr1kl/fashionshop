

@extends('main')
@section('content')

<div class="container p-t-70 p-b-40">
    <div class="card">
        <h1 class="card-title" style="font-weight: bold;">{{ $news->title }}</h1>
        <img src="{{ $news->thumb }}" class="card-img-top" alt="{{ $news->title }}" style="height: 300px; object-fit: cover;">

        <div class="card-body">

            <p class="card-text">{!! $news->content !!}</p>
        </div>
    </div>
</div>

@endsection
