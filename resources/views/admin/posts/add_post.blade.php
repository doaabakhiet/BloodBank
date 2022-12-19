@extends('layouts.admin')
@inject('model', 'App\Models\Governate')
@section('title')
    Admin | Add Posts
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ Route('dashboard.governorate.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
            <h3 class="card-title">Add New Posts</h3>

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
                    {!! Form::open(['route' => 'dashboard.posts.store', 'method' => 'post','enctype'=>"multipart/form-data"]) !!}
                    @csrf
                    <div class="form-group">
                        @error('photo')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Photo', null, ['class' => 'control-label']) }}
                        {{ Form::file('photo', array_merge(['class' => 'form-control'])) }}
                        @error('title')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Title', null, ['class' => 'control-label pt-3']) }}
                        {{ Form::text('title', null, array_merge(['class' => 'form-control'])) }}
                        @error('category_id')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Category', null, ['class' => 'control-label pt-3']) }}
                        <div class="form-group mt-3">
                            <select class="custom-select" name="category_id">
                                <option selected>Pick Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('decription')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Description', null, ['class' => 'control-label pt-3']) }}
                        {{ Form::textarea('decription', null, array_merge(['class' => 'form-control','id'=>'editor'])) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
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
