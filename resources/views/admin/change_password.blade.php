@extends('layouts.admin')
@inject('client', 'App\Models\Client')
@inject('donationRequest', 'App\Models\DonationRequest')
@inject('contact', 'App\Models\Contact')
@section('title')
    Admin | Change Password
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item active">Change Password</li>
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
            <h3 class="card-title">Change Your Password</h3>

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

            <div class="card card-widget widget-user">
                <div class="row">
                    <div class="col-sm-12">
                      @include('flash::message')
                        {!! Form::model(null, ['url' => ['dashboard/update-password'], 'method' => 'put']) !!}
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          @error('old_password')
                              <label class="text-danger">{{ $message }}</label>
                          @enderror
                          {{ Form::label('old_password', null, ['class' => 'control-label']) }}
                          {{ Form::password('old_password',['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            @error('password')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                            {{ Form::label('password', null, ['class' => 'control-label']) }}
                            {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                        </div>

                        <div class="form-group">
                          @error('confirm_password')
                              <label class="text-danger">{{ $message }}</label>
                          @enderror
                          {{ Form::label('confirm password', null, ['class' => 'control-label']) }}
                          {{ Form::password('confirm_password', array_merge(['class' => 'form-control'])) }}
                      </div>
                        
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                        {!! Form::close() !!}
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
