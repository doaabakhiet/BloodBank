@extends('layouts.admin')
@inject('model', 'App\Models\Governate')
@section('title')
    Admin | Update Settings
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        {{-- <li class="breadcrumb-item "><a href="{{ Route('dashboard.governorate.index') }}">Settings</a></li> --}}
                        <li class="breadcrumb-item active">Settings</li>
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
            <h3 class="card-title">Update Settings</h3>

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
                <div class="col-sm-12">
                    {!! Form::open(['route' => ['dashboard.settings.update', $setting->id], 'method' => 'put']) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @error('phone')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('phone', null, ['class' => 'control-label']) }}
                        {{ Form::number('phone', $setting->phone, array_merge(['class' => 'form-control'])) }}
                        @error('email')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::email('email', $setting->email, array_merge(['class' => 'form-control'])) }}
                        @error('facebook')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('Facebook', null, ['class' => 'control-label']) }}
                        {{ Form::text('facebook', $setting->facebook, array_merge(['class' => 'form-control'])) }}
                        
                        @error('instagram')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('Instagram', null, ['class' => 'control-label']) }}
                        {{ Form::text('instagram', $setting->instagram, array_merge(['class' => 'form-control'])) }}
                        
                        @error('youtube')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('Youtube', null, ['class' => 'control-label']) }}
                        {{ Form::text('youtube', $setting->youtube, array_merge(['class' => 'form-control'])) }}
                        
                        @error('twitter')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('Twitter', null, ['class' => 'control-label']) }}
                        {{ Form::text('twitter', $setting->twitter, array_merge(['class' => 'form-control'])) }}

                        @error('about_app')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        <br>
                        {{ Form::label('About', null, ['class' => 'control-label']) }}
                        {{ Form::textarea('about_app', $setting->about_app, array_merge(['class' => 'form-control','id'=>'editor'])) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    {!! Form::close() !!}
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

