@extends('layouts.app')

@section('content')

<html>
<head>
<meta charset="utf-8" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>
<body>
  <div class="wrapper ">

    <div class="sidebar" data-color="orange" data-background-color="badge filter badge-white" data-image="{{ asset('img/sidebar-1.jpg')}}">

      <div class="logo">

        <a href="" style="color:white">
         &nbsp; &nbsp; ACAA Admin Portal        </a>
      </div>
      <div class="sidebar-wrapper">
                @include('editprofileadmin')
        <ul class="nav">
          <li>
            <a class="nav-link" href="{{route('admin.dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>

          <li class="nav-item active ">
            <a class="nav-link" href="{{route('show_user') }}">
              <i class="material-icons">face</i>
              <p> Active Users </p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('show_user_active') }}">
              <i class="material-icons">how_to_reg</i>
              <p> Pending Users  </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('show_members')}}">
              <i class="material-icons">star</i>
              <p> Membership  </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('membership_type')}}">
              <i class="material-icons">timeline</i>
              <p> Add Membership  </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{route('add_news')}}">
              <i class="material-icons">chat</i>
              <p> News </p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#mapsExamples">
              <i class="material-icons">mail</i>
              <p> E-Mail
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="mapsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="{{route('get_email_accounts')}}">
                    <span class="sidebar-normal"> Group Email </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="{{route('get_individual_accounts')}}">

                    <span class="sidebar-normal">Email User </span>
                  </a>
                </li>

              </ul>
            </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('adddiscount')}}">
              <i class="material-icons">Percentage</i>
              <p> Discount </p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('main_banner')}}">
              <i class="material-icons">view_column</i>
              <p> Main Page News </p>
            </a>
          </li>

        </ul>
      </div>
    </div>

    <!-- Main Panel -->
    <div class="main-panel">


      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
              <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
              <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
            </button>
          </div>
          <a class="navbar-brand" href="#pablo">Users</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
          <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
          <form class="navbar-form">
            <div class="input-group no-border">
              <input type="text" value="" class="form-control" placeholder="Search...">
              <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#pablo">
                <i class="material-icons">dashboard</i>
                <p class="d-lg-none d-md-block">
                  Stats
                </p>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification">2</span>
                <p class="d-lg-none d-md-block">
                  Some Actions
                </p>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route('show_user_active') }}">You have {{$useractive}} new users</a>
                <a class="dropdown-item" href="{{route('show_members')}}">You have {{$membership_request}} Membership upgrade</a>

              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

      <!-- End Navbar -->


      <br/>
      <br/>

      <div class="col-lg-12">

              @if(Session::has('success_msg'))
              <div class="alert alert-success alert-with-icon">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                   <i class="material-icons" data-notify="icon" >check</i>
                {{ Session::get('success_msg') }}</div>
              @endif

      </div>



      <!-- Starting User lsit -->
      <div class="content">
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card ">
                  <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons"></i>
                    </div>
                    <h4 class="card-title">Users List </h4>
                  </div>
      <div class="material-datatables">
      <table id="table2" class="display table table-bordered table-striped table-hover">
      <thead>

          <tr>
              <th class="text-center">#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Since</th>
              <th class="text-left">Membership</th>
              <th class="text-left">Gender</th>
              <th class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
              <td class="text-center">{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->membership}}</td>
              <td>{{$user->gender}}</td>
              <td>
            <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-created_at="{{$user->created_at}}" data-membership="{{$user->membership}}" data-gender="{{$user->gender}}">
              VIEW<i class="fa fa-eye"></i>
            </a>
           <a href="{{ route('edit_user', $user->id) }}" class="edit-modal btn btn-warning btn-sm">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>

           <a href="{{route('delete-userinfo', $user->id)}}" class="delete-modal btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete <i class="fa fa-remove" aria-hidden="true"></i></a>

          </td>
          </tr>
            @endforeach

      </tbody>
      </table>
      </div>



                          </div>
                          </div>
                        </div>




                        </div>
                      </div>
                    </div>


      <!--ending user list -->



      <!--Ending Main Panel -->
    </div>


    {{-- Modal Form Show POST --}}
    <div id="show" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
          <div class="form-group">
          <label for="">ID :</label>
          <b id="i"/>
          </div>
          <div class="form-group">
          <label for="">Name :</label>
          <b id="name"/>
          </div>
          <div class="form-group">
          <label for="">Email :</label>
          <b id="email"/>
          </div>
          <div class="form-group">
          <label for="">Since :</label>
          <b id="created_at"/>
          </div>
          <div class="form-group">
          <label for="">Gender :</label>
          <b id="gender"/>
          </div>
          <div class="form-group">
          <label for="">Membership :</label>
          <b id="membership"/>
          </div>
          </div>
          </div>
          </div>
      </div>

      <!-- Edit post -->


                          <!-- <div class="copyright float-right">
                        &copy;
                        <script>
                          document.write(new Date().getFullYear())
                        </script>, made with <i class="material-icons">favorite</i> by
                        <a href="" target="_blank">Group</a> for a better web.
                      </div> -->
                    </div>

                </div>
              </div>
              <!-- @include('sidebarplugin') -->

            </body>
            </html>

@endsection
