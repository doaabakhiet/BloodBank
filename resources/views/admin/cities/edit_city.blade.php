@extends('layouts.admin')
@inject('model', 'App\Models\Governate')
@section('title')
    Admin | Update Cities
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cities</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ Route('dashboard.governorate.index') }}">Cities</a></li>
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
                    {!! Form::model($city,['route' => ['dashboard.cities.update', $city->id], 'method' => 'put']) !!}
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @error('name')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                        {{ Form::label('name', null, ['class' => 'control-label']) }}
                        {{ Form::text('name', $city->name, array_merge(['class' => 'form-control'])) }}
                        {{-- <select class="form-select" name="governate_id">
                            @foreach ($governorates as $item)
                                @if ($item->id == $city->governates->id)
                                    <option value="{{ $item->id }}" selected>
                                        {{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::select('governate_id',$governorates->pluck('name','id')->toArray(),null,[
                            'class' => 'custom-select',
                            'placeholder' => 'Pick Governorate'
                        ]) !!}
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
