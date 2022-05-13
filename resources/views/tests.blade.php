@extends('layouts.app')
@section('content')

<div class="container card" style="width:600px ;heghit:600px" >
    <form action="{{route('home.store')}}" method="POST" style="margin-top:5px">
    <table class="table table-striped table-bordered">
        @foreach ($questions as $question)
        @csrf
        <tr style="text-align: center">

            <th>{{$question->body}}</th>
        </tr>

        @foreach ($question->answers as $answer)

        <tr>
            <td><input type="radio" name="answer_id[{{$question->id}}]"  value="{{$answer->id}}" required/>{{$answer->body}}</td>
            <input type="hidden" name="s_id"  value="{{$question->subject_id}}"/>

        </tr>

        @endforeach
        @endforeach

        
    </table>
  <div style="text-align:center;">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
    </form>

</div>
@endsection

{{-- {!! $questions->links() !!}  --}}
<style>
    #submit{
        text-align: center;

    }

</style>
