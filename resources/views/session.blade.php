@extends('layouts.app')
@section('content')
<div class="container card" style="width: 40rem; text-align:center;">
    <div class="card-header">
      Your Results

@foreach ($sessions as $session)

    <ul class="list-group list-group-flush">
      <a class="btn btn-light" href="{{route('result', $session->id)}}">
      <li class="list-group-item">{{$session->subject->name}} | {{$session->point}} | {{$session->created_at}} <i class="bi bi-arrow-right float-end"></i>

      </li>
      </a>
    </ul>


@endforeach
  <a href="{{route('home.index')}}" class="btn btn-info">Back</a>

</div>
</div>
@endsection

