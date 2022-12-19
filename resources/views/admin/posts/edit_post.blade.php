@extends('layouts.admin')
@inject('model', 'App\Models\Governate')
@section('title')
    Admin | Update Posts
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
                        <li class="breadcrumb-item "><a href="{{ Route('dashboard.posts.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active">Update</li>
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
            <h3 class="card-title">Update Cities</h3>

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
                    {!! Form::open(['route' => ['dashboard.posts.update', $post->id], 'method' => 'put','enctype'=>"multipart/form-data"]) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{asset('images/'.$post->photo)}}" width="60px" height="60px" alt="">
                        @error('photo')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror

                        {{ Form::label('Photo', null, ['class' => 'control-label']) }}
                        {{ Form::file('photo', array_merge(['class' => 'form-control'])) }}


                        @error('title')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('title', null, ['class' => 'control-label']) }}
                        {{ Form::text('title', $post->title, array_merge(['class' => 'form-control'])) }}

                        @error('category_id')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Category', null, ['class' => 'control-label pt-3']) }}
                        <select class="custom-select" name="category_id">
                            @foreach ($categories as $item)
                            @if($item->id == $post->categories->id)
                            <option value="{{ $item->id }}" selected>
                                {{ $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('decription')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Description', null, ['class' => 'control-label pt-3']) }}
                        {{ Form::textarea('decription',$post->decription, array_merge(['class' => 'form-control','id'=>'editor'])) }} 

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
