@extends('layouts.app')
@section('content')
  <style>
.form-control {
  border-radius: 10px !important;
}
.form-control[multiple] {
  border-radius: 10px !important;
}
</style>
<div class="container" style="margin-top:10px; width:50%">
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  <form action="{{route('storeTest')}}" method="GET" enctype="multipart/form-data">
  @csrf
@if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
    <div class="form-group">
      <select class="form-control"  id="type" name="subject_id" required>
        <option>Select Subject</option>
        @foreach ($subjects as $subject)
        <option value="{{$subject->id}}">{{$subject->name}}</option>
        @endforeach
      </select>
    </div>
      <div class="form-group">
        <input type="text" class="form-control" name="question"  placeholder="Question" >
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="answer[]" placeholder="A)" >
        <input type="text" class="form-control" name="answer[]" placeholder="B)" >
        <input type="text" class="form-control" name="answer[]" placeholder="C)" >
       <div class="form-group">
        <select class="form-control" name="is_true"  id="answer[]">
          <option>Select Is_true</option>
          @foreach (['1' => 'A', '2' => 'B', '3' => 'C'] as $key => $option)
          <option value="{{$key}}" selected>{{$option}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div style="text-align:center; margin-top:10px">
      <button type="Submit" class="btn btn-outline-success">Submit</button>
    </div>
</form>
</div>


@endsection
