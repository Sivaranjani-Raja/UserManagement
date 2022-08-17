@extends('user.layout')
@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message'))
            <p class="alert {{ Session::get('flash_message', 'alert-success') }}">{{ Session::get('flash_message') }}</p>
            @endif
            @if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                    <div class="d-flex bd-highlight">

                        <div class="p-2 flex-fill bd-highlight"><b>User Records</b>  <a href="{{ url('/') }}" title="Edit User"><button class="btn btn-success btn-sm"><i class="fa fa-home" aria-hidden="true"></i></button></a>
                        </div>

                        {{-- Search Option --}}
                        <div class="p-2 flex-fill bd-highlight">
                            <form method="GET" action="{{ url('/user') }}">


                                <div class="input-group">
                                    <div class="form-outline">
                                      <input type="text" id="form1" name="search" class="form-control"  placeholder="Search by name" value="" />
                                      
                                    </div>
                                    <button class="btn btn-primary " style="height: 37px;">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                  </div>

                               
                            </form>
                        </div>
                        <div class="p-2 flex-fill bd-highlight"> <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right; ">
                            Add New
                          </button></div>
                      </div>

                          {{-- Add New User Modal --}}
                          <!-- Modal -->
                          <form action="{{ url('user') }}" method="post" role="form"  enctype="multipart/form-data">
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   
                                        {!! csrf_field() !!}

                                       
                                            <div class="input-group flex-nowrap">
                                              <span class="input-group-text" id="addon-wrapping">Email :</span>
                                              <input type="email" class="form-control" name="email" id="email" required placeholder="Enter Email" aria-label="Email" aria-describedby="addon-wrapping">
                                              
                                            </div>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                            <br>

                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Full Name :</span>
                                    <input type="text" class="form-control" name="name" id="name" required placeholder="Enter User Name" aria-label="Email" aria-describedby="addon-wrapping">
                                    
                                  </div>
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                        <br>

                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">Date Of Joining:</span>
                                            <input type="date" class="form-control" name="date_of_join" id="date_of_join" required placeholder="Enter User Name" aria-label="Email" aria-describedby="addon-wrapping">
                                            
                                          </div>

                                        @if ($errors->has('date_of_join'))
                                        <span class="text-danger">{{ $errors->first('date_of_join') }}</span>
                                        @endif
                                
                                        <br>
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">Date Of Leaving:</span>
                                            <input type="date" class="form-control" name="date_of_leave" id="date_of_leave" required placeholder="Enter User Name" aria-label="date of leave" aria-describedby="addon-wrapping">
                                            
                                          </div>
                                     
                                        @if ($errors->has('date_of_leave'))
                                        <span class="text-danger">{{ $errors->first('date_of_leave') }}</span>
                                        @endif
                                        <br>

                                            <input type="checkbox" id="checkbox" name="still_work" onclick="myFunction()">
                                            <label for="scales">Still Working</label>
                                       
                                        <script>
                                        function myFunction() {
                                        
                                        var x=$("#checkbox").is(":checked");

                                        let result = x === true ?  document.getElementById("date_of_leave").disabled = true :  document.getElementById("date_of_leave").disabled = false;
                                        }
                                        </script>
                                            
                                    
                                <br><br>
                                
                                        <label>Upload Image :</label>&nbsp&nbsp 
                                        <input type="file" name="imagefile" class="form-control" id="imagefile" required placeholder="image" >
                                
                                        <br><br>
                                    
                                </div>
                                <div class="modal-footer">
                                    <input type="submit"  value="Save" class="btn btn-success" >
                                <br>
                                </div>
                               
                            </form>
                              </div>
                            </div>
                          </div>
                    </div>
                    {{-- List Of User details --}}
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Experience</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($user) && $user->count())
                                    @foreach($user as $item)
                                        <tr>
                                        
                                            <td>
                                                <div class="thumb">
                                                <img class="user"  src="image/{{$item->imagefile}}" alt="avatar">
                                                </div>
                                            </td>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            @if(is_null($item->date_of_leave))
                                            <td>{{ \Carbon\Carbon::now()->diff( \Carbon\Carbon::parse($item->date_of_join))->format(" %Y years %m Months %d Days") }} </td>
                                            @else
                                            <?php
                                                $date = new DateTime($item->date_of_join);
                                                $now = new DateTime($item->date_of_leave);

                                                $exp_date = $date->diff($now)->format(" %Y years %m Months");
                                            ?>
                                            <td>{{ $exp_date }} </td>
                                            @endif
    <td>                                         
                                                 {{-- Delete User --}}
                                                <form method="POST" action="{{ url('/user' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                @endif
                                </tbody>
                               
                               
                            </table>
                            <br>
                           
                            @if( request()->get('search') )
                            <a href="{{ url('/user') }}" style="float: right;  padding: 10px 10px;" title="Home"><button class="btn btn-primary btn-sm">Back</button></a>
                            <br><br>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.modal.create')
@endsection
<style>
    .user {
  display: inline-block;
  width: 60px;
  height: 60px;
  border-radius: 50%;

  object-fit: cover;
}
</style>
<script rel="javascript" type="text/javascript" href="js/jquery-1.11.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

