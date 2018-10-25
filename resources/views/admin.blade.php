@extends('layouts.app')

@section('content')


    <nav class="navbar navbar-expand-lg bg-rose">
    <div class="container">


        <div class="collapse navbar-collapse">
            

            <form class="form-inline ml-auto">
                <div class="form-group has-white">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini btn-round">
                    <i class="material-icons">search</i>
                </button>
            </form>
        </div>
    </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Job Position</th>
            <th>Since</th>
            <th class="text-right">Salary</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">1</td>
            <td>Andrew Mike</td>
            <td>Develop</td>
            <td>2013</td>
            <td class="text-right">&euro; 99,225</td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-info">
                    <i class="material-icons">person</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-success">
                    <i class="material-icons">edit</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-danger">
                    <i class="material-icons">close</i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>John Doe</td>
            <td>Design</td>
            <td>2012</td>
            <td class="text-right">&euro; 89,241</td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-info btn-round">
                    <i class="material-icons">person</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-success btn-round">
                    <i class="material-icons">edit</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                    <i class="material-icons">close</i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>Alex Mike</td>
            <td>Design</td>
            <td>2010</td>
            <td class="text-right">&euro; 92,144</td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                    <i class="material-icons">person</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                    <i class="material-icons">edit</i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-danger btn-simple">
                    <i class="material-icons">close</i>
                </button>
            </td>
        </tr>
    </tbody>
</table>



  @endsection
