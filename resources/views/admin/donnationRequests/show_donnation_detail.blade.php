@extends('layouts.admin')
@section('title')
    Admin | Donnation Requests
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donnation Requests</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Donnation Requests</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 show-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7">
                                <h4>Client : <small class="text-primary">{{ $donnation->clients->name }}</small></h4>
                                <h4>Patient : <small class="text-primary">{{ $donnation->name }}</small></h4>
                                <h4>Age : <small class="text-primary">{{ $donnation->age }}</small></h4>
                                <h4># Bags : <small class="text-primary">{{ $donnation->num_of_bags }}</small></h4>
                                <h4>Blood Type : <small class="text-primary">{{ $donnation->bloodtype->name }}</small>
                                </h4>
                                <h4>Address : <small
                                        class="text-primary"><b>{{ $donnation->cities->governates->name }}:</b>{{ $donnation->cities->name }}
                                    </small></h4>
                                    <h4 class="text-primary">Notes :</h4>
                                <p>{{ $donnation->notes }}</p>
                                <h4>Phone : <small class="text-primary">{{ $donnation->phone }}</small></h4>
                                <h4>Request Date : <small class="text-primary">{{ $donnation->created_at }}</small></h4>
                            </div>
                            <div class="col-sm-5">
                                <iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?q={{ $donnation->latitude }},{{$donnation->longtitude}}&hl=es&z=14&amp;output=embed">
                                </iframe>
                                <br />
                                <small>
                                  <a 
                                   href="https://maps.google.com/maps?q={{ $donnation->latitude }},{{$donnation->longtitude}}&hl=es;z=14&amp;output=embed" 
                                   style="color:#0000FF;text-align:left" 
                                   target="_blank"
                                  >
                                    See map bigger
                                  </a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
@endsection
