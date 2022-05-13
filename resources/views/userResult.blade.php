@extends('layouts.app')
@section('content')
<div class="container card" style="width: 40rem; text-align:center;">
    <div class="card-header">
      Students Result

@foreach ($sessions as $session)

    <ul class="list-group list-group-flush">

        <li class="list-group-item"><a class="btn btn-outline-primary" href="
            {{route('sResult', ['subjectId'=>$session->first()->subject_id,'userId'=>$session->first()->user_id])}}">
            {{$session->first()->user->name}}ning natijalari</a>

    </li>
@endforeach
<a href="{{route('home.index')}}" class="btn btn-light">Back</a>
</div>
</div>
@endsection


