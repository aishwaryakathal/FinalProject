
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

                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.edit', Auth::user())}}">

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
              <p> Buy Membership </p>
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
      <br/>

      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($newslist as $news)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>

            @endforeach
        </ol>


        <div class="carousel-inner">
          @foreach($newslist as $news)
          <div class="carousel-item {{ $loop->first ? 'active' : '' }} ">
            <img class="d-block w-100" src="{{url('../')}}/storage/upload/{{$news->imagepath}}" width="100px" height="400px" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="title" style="font-size:50px; color:black; font-weight:bold">{{$news->title}}</h5>
              <p class="description" style="font-size:30px; color:black;">{{$news->description}}</p>
            </div>
          </div>
          @endforeach

        </div>


        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>



    <!-- </br>
      <div class="container" >
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card">
                      <div class="card-header" ></div>

                      <div class="card-body" >
                          @if (session('status'))
                              <div class="alert alert-success" role="alert">
                                  {{ session('status') }}

                              </div>
                          @endif

                          <h2 >News Feeds</h2>
              <ul>





@foreach($newslist as $news)

       <div class="panel-group" id="accordion">
              <div class="panel panel-default" id="panel">
                     <div class="panel-heading">
                           <h4 class="panel-title" style="height:50px; width:500px;" >
                                <button type="button" class="btn btn-info" style="width:100%; text-align:left" data-toggle="collapse" data-target="#collapseOne_{{$news->id}}" href="#collapseOne" >
                                       {{ $news->title }}

                                       <i class="material-icons">keyboard_arrow_down </i>
                                </button>



                            </h4>

                            <div id="collapseOne_{{$news->id}}" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                       {{ $news->description }}
                                  </div>
                            </div>

                      </div>
                      <!-- <div id="collapseOne_@i" class="panel-collapse collapse in">
                            <div class="panel-body">
                                 {{ $news->description }}
                            </div>
                      </div>
              </div>
        </div>


@endforeach






              </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div> -->
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
