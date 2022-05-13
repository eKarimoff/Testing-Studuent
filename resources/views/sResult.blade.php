@extends('layouts.app')
@section('content')
<div class="container card" style="width: 40rem; text-align:center;">
    <div class="card-header">
        Student Result

        @foreach ($sessions as $session)
        <li class="list-group-item">{{$session->user->name}} | ({{$session->user->id}}) | {{$session->subject->name}} | {{$session->point}}</li>

            @endforeach
<a href="{{route('home.index')}}" class="btn btn-outline-danger mt-2">Back</a>



</div>
</div>

@endsection
