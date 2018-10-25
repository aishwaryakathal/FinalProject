
@extends('layouts.app')

@section('content')

<!DOCTYPE html>
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
          &nbsp; &nbsp; Membership Portal        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                {{Auth::user()->name}}
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('profile.show') }}">
                    <span class="sidebar-mini">  </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.edit', Auth::user())}}">
                    <span class="sidebar-mini">  </span>
                    <span class="sidebar-normal"> Change Password </span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('userdashboard')}}">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>



          <li class="nav-item ">
            <a class="nav-link" href="{{ route('payment_form') }}">
              <i class="material-icons">face</i>
              <p>Buy Membership </p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('payment_history')}}">
              <i class="material-icons">timeline</i>
              <p> Payment History </p>
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

          </div>

        </div>


      </div>
    </nav>

      <!-- End Navbar -->

      <!-- Starting User lsit -->
      <div class="card-body">
        <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="80px" height="80px"/><br/>

        <table id="table2" class="display table table-bordered table-striped table-hover">
        <thead>

            <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Member Since</th>

                <th class="text-left">Gender</th>
                <th class="text-center">membership</th>
            </tr>
        </thead>
        <tbody>

            <tr>

                <td>{{Auth::user()->name}}</td>
                <td>{{Auth::user()->email}}</td>
                <td>{{Auth::user()->created_at}}</td>
                <td>{{Auth::user()->gender}} </td>
                <td>{{Auth::user()->membership}}</td>

            </tr>


        </tbody>
        </table>





        </a>



      </div>
      <!--ending user list -->


      <!--Ending Main Pangel -->
    </div>

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
              <div class="fixed-plugin">
                <div class="dropdown show-dropdown">
                  <a href="#" data-toggle="dropdown">
                    <i class="fa fa-cog fa-2x"> </i>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header-title"> Sidebar Filters</li>
                    <li class="adjustments-line">
                      <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors ml-auto mr-auto">
                          <span class="badge filter badge-purple" data-color="purple"></span>
                          <span class="badge filter badge-azure" data-color="azure"></span>
                          <span class="badge filter badge-green" data-color="green"></span>
                          <span class="badge filter badge-warning" data-color="orange"></span>
                          <span class="badge filter badge-danger" data-color="danger"></span>
                          <span class="badge filter badge-rose active" data-color="rose"></span>
                        </div>
                        <div class="clearfix"></div>
                      </a>
                    </li>
                    <li class="header-title">Sidebar Background</li>
                    <li class="adjustments-line">
                      <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="ml-auto mr-auto">
                          <span class="badge filter badge-black active" data-background-color="black"></span>
                          <span class="badge filter badge-white" data-background-color="white"></span>
                          <span class="badge filter badge-red" data-background-color="red"></span>
                        </div>
                        <div class="clearfix"></div>
                      </a>
                    </li>
                    <li class="adjustments-line">
                      <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Mini</p>
                        <label class="ml-auto">
                          <div class="togglebutton switch-sidebar-mini">
                            <label>
                              <input type="checkbox">
                              <span class="toggle"></span>
                            </label>
                          </div>
                        </label>
                        <div class="clearfix"></div>
                      </a>
                    </li>
                    <li class="adjustments-line">
                      <a href="javascript:void(0)" class="switch-trigger">
                        <p>Sidebar Images</p>
                        <label class="switch-mini ml-auto">
                          <div class="togglebutton switch-sidebar-image">
                            <label>
                              <input type="checkbox" checked="">
                              <span class="toggle"></span>
                            </label>
                          </div>
                        </label>
                        <div class="clearfix"></div>
                      </a>
                    </li>




                    <li class="button-container text-center">
                      <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> </button>
                      <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> </button>
                      <br>
                      <br>
                    </li>
                  </ul>
                </div>
              </div>

</body>
</html>
@endsection
