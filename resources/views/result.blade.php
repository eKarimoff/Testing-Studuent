@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:30px; width:60%; ">
    <table class="table table-striped" style="border:2px solid black">
    @foreach ($sessionResult as $session)
    <tr>
        <th style="text-align:center">{{$session->question->body}}</th>
    </tr>

    <tr>
    @foreach ($session->question->answers as $answer)
    <tr>
    <td style="{{$answer->is_true ? 'border: 1px solid green; color:green': 'border: 1px solid red; color:red'}}">@if($session->answer_id == $answer->id)<i class="bi bi-check2"></i>@endif {{$answer->body}}</td>
    </tr>
    @endforeach
    </tr>
    @endforeach
</table>
@if(auth()->user()->hasRole('teacher'))
<div class="text-center">
<a class="btn btn-info" href="{{route('session.get')}}">Back</a>
</div>
@endif
@if(auth()->user()->hasRole('user'))
<div class="text-center">
    <a class="btn btn-info" href="{{route('home.index')}}">Back</a>
    </div>
</div>
@endif


@endsection
