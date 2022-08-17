@extends('user.layout')
@section('content')
<div class="card" style="width: 48rem;">
  <div class="card-header">Edit user Details</div>
  <div class="card-body" >

     <a href="{{ url('/user/') }}" style="float: right;  padding: 10px 10px;" title="Home"><button class="btn btn-primary btn-sm"><i class="fa fa-home" aria-hidden="true"></i></button></a>
            <br><br>

      <form action="{{ url('user/' .$user->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <label>Email :</label>&nbsp&nbsp
        <input type="email" name="email" id="name" value="{{$user->email}}"></br>
        @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
<br>
        <label>Full Name :</label>&nbsp&nbsp
        <input type="text" name="name" id="name" value="{{$user->name}}"></br>
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        <br>
        <label>Date Of Joining :</label>&nbsp&nbsp 
        <input type="date" name="date_of_join" value="{{$user->date_of_join}}">
        @if ($errors->has('date_of_join'))
        <span class="text-danger">{{ $errors->first('date_of_join') }}</span>
        @endif

        <br><br>
        <label>Date Of Leaving :</label>&nbsp&nbsp 
        <input type="date" name="date_of_leave" value="{{$user->date_of_leave}}">
        @if ($errors->has('date_of_leave'))
        <span class="text-danger">{{ $errors->first('date_of_leave') }}</span>
        @endif
        &nbsp  &nbsp
            <input type="checkbox" id="still_work" name="still_work"
                   checked>
            <label for="scales">Still Working</label>
    
<br><br>

        <label>Upload Image :</label>&nbsp&nbsp 
        <input type="file" name="imagefile" class="form-control" placeholder="image">

        <br><br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
  
  </div>
</div>
@stop