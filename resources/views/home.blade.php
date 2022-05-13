@extends('layouts.app')

@section('content')


@if(auth()->user()->hasRole('admin'))
<div style="text-align: center">
<p style="text-align:center"><h3>Students Result</h3></p>
<div>

<div class="container" style="margin-top:50px; width:50% ">
    <div class="justify-content-center">
        <table class="table table-bordered table table-striped">
        <tr style="text-align: center">
        <th>Fanlar bo'yicha natijalar:</th>
      
        </tr>
        @foreach ($subjects as $subject)
        <tr style="text-align: center" class="table-active">
            <td><a class="btn btn-light" href="{{route('userResult', ['id' => $subject->id])}}">{{$subject->name}} Fani Bo'yicha tests natijalari<i class="bi bi-arrow-right float-end"></a></td>
            @endforeach
        </div>
    </table>

</div>
@endif
@if(auth()->user()->hasRole('user'))
<div class="container" style="margin-top:50px; width:50%">
    <div class="justify-content-center">

        <table class="table table-bordered table table-striped">
        <tr style="text-align: center">

        <th>Fanlar:</th>

        </tr>
        @foreach ($subjects as $subject)
        <tr style="text-align: center">
            <td><a class="btn btn-primary" href="{{route('tests.get', ['id' => $subject->id])}}">{{$subject->name}}</a>
            @endforeach

        </div>
    </table>
</div>
@endif
@endsection
