@inject('Permission', 'App\Models\Permission')
@extends('layouts.admin')
@section('title')
    Admin | Update Roles
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ Route('dashboard.roles.index') }}">Roles</a></li>
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
            <h3 class="card-title">Update Roles</h3>

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
                    {!! Form::open(['route' => ['dashboard.roles.update', $role->id], 'method' => 'put']) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @error('name')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', $role->name, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        @error('display_name')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('display_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('display_name', $role->display_name, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        @error('description')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('description', null, ['class' => 'control-label']) }}
                        {{ Form::textarea('description', $role->description, array_merge(['class' => 'form-control', 'id' => 'editor'])) }}
                    </div>
                    <div class="form-group">

                        {{ Form::label('Permission', null, ['class' => 'control-label']) }}
                        <div class="row">
                            <div class="col-sm-12 pl-4">
                            <input type="checkbox" id="checkAll" class="form-check-input"><label for="checkAll">Check All</label>
                            <hr/>
                            </div>
                            
                            @foreach ($Permission->all() as $perm)
                                <div class="col-sm-3 pl-4">
                                    {{ Form::checkbox('permissions_list[]', $perm->id, $role->hasPermission($perm->name) ? true : false, ['class' => 'form-check-input']) }}
                                    {{ $perm->display_name }}
                                </div>
                            @endforeach
                        </div>
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
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>
@endpush
