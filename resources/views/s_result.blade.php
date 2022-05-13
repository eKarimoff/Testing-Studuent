@extends('layouts.app')
@section('content')
<div class="container" style="text-align: center">
<h1>Dear {{$username}} your score is: {{$natija}}</h1>

<a  class="btn btn-danger" href="{{route('home.index')}}">Back</a>
</div>
@endsection
