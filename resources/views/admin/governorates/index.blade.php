@extends('layouts.admin')
@section('title')
    Admin | Governorates
@endsection
@section('content')
@section('page_title')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Governorates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Governorates</li>
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
            <h3 class="card-title"><a href="{{ Route('dashboard.governorate.create') }}"
                    class="btn btn-block btn-primary"><i class="fa fa-plus"></i>&nbsp;Add New</a></h3>

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
                    @include('flash::message')
                    @if (count($governorates))
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending">#
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">Rendering
                                        name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        Edit</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($governorates as $item)
                                    <tr class="odd">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->name }}</td>
                                        <td><a href="{{ Route('dashboard.governorate.edit', $item->id) }}"
                                                class="btn btn-primary"><i class="fa fa-pen"></i></a></td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['dashboard.governorate.destroy', $item->id],
                                                'method' => 'delete',
                                                'class' => 'delete-form',
                                            ]) !!}
                                            <button type="submit" class="btn btn-danger btndeletee"><i
                                                    class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination --}}

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $governorates->links() !!}
        </div>
    @else
        <div class="alert alert-danger">No Data</div>
        @endif
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
@endsection
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        var confirmed = false;
        $('.delete-form').submit(function(e) {
            if (confirmed) {
                return;
            }
            e.preventDefault();
            var deleteform = $(this);
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function() {
                        $.alert('Confirmed!');
                        confirmed = true;
                        deleteform.submit();
                    },
                    cancel: function() {
                        $.alert('Canceled!');
                        confirmed = false;
                    }
                }
            });
        });
        setTimeout(function() {
            $('.show-data .alert').fadeOut('fast');
        }, 3000);
    });
</script>
@endpush
