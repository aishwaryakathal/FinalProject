
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

        <a href="" class="" style="color:white">
         &nbsp; &nbsp; ACAA Admin Portal        </a>
      </div>
      <div class="sidebar-wrapper">
        @include('editprofileadmin')
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('show_user') }}">
              <i class="material-icons">face</i>
              <p>Active Users </p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('show_user_active') }}">
              <i class="material-icons">how_to_reg</i>
              <p>Pending Users  </p>
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
          <!-- <li class="nav-item ">
            <a class="nav-link" href="{{route('get_email_accounts')}}">
              <i class="material-icons">mail</i>
              <p> E-Mail </p>
            </a>

          </li> -->

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
    @include('nav')
      <!-- End Navbar -->

      <!-- Starting User lsit -->
<br/>
      <div class="container">

              <div class="panel panel-primary" style="height:100px">

               <div class="panel-heading"></div>
               <br/>
               <br/>
                <div class="panel-body">
                  <div class="row">
                  <div class="col-sm-6">
                     {!! $chart->html() !!}
                  </div>

                  <br/><br/>

                  <div class="col-md-6">
                     {!! $pie_chart->html() !!}
                  </div>
                  <br/>
                  <br/>


                  <div class="col-md-6">
                    <br/>
                     {!! $chartforpurchase->html() !!}
                  </div>
                  <br/>
                  </br>

                  <div class="col-md-6">
                    <br/>
                     {!! $news->html() !!}
                  </div>
                  <br/>
                  </br>



               </div>

              </div>

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



</body>
</html>

{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $pie_chart->script() !!}
{!! $chartforpurchase->script() !!}
{!! $news->script() !!}


@endsection
