@inject('roles', 'App\Models\Role')
@extends('layouts.admin')
@section('title')
    Admin | Add Users
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ Route('dashboard.users.index') }}">Users</a></li>
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
            <h3 class="card-title">Add New Users</h3>

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
                    {!! Form::open(['route' => 'dashboard.users.store', 'method' => 'post']) !!}
                    @csrf
                    <div class="form-group">
                        @error('name')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        @error('password')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Password', null, ['class' => 'control-label']) }}
                        {{ Form::text('password', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    {{-- <div class="form-group">
                        @error('password_confirmation')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('Password confirmation', null, ['class' => 'control-label']) }}
                        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                    </div> --}}
                    <div class="form-group">
                        @error('email')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::email('email', null, array_merge(['class' => 'form-control'])) }}
                    </div>

                    <div class="form-group">
                        @error('roles_list')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{-- {!! Form::select('roles_list[]', $roles->pluck('display_name', 'id')->toArray(), null, [
                            'class' => 'custom-select',
                            'multiple'=>'multiple'
                        ]) !!} --}}
                        {!! Form::select('roles_list[]', $roles->pluck('display_name', 'id')->toArray(), null, [
                            'class' => 'js-example-basic-multiple form-control text-black',
                            'multiple'=>'multiple'
                        ]) !!}
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
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
       
    });
</script>
@endpush
