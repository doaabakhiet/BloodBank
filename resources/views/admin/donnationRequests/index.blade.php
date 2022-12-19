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
                <div class="col-sm-5 pt-3">
                    <form action="{{ Route('dashboard.donnations.index') }}" method="get" id="form">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Search" name="search">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 show-data">
                    @include('flash::message')
                    @if (count($donnations))
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending">#
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Client Name
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Patient
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Age
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        # Bags
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Blood Type
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Adress
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Phone
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1"
                                        aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">
                                        Request Date
                                    </th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">
                                        Show</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donnations as $item)
                                    <tr class="odd">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->clients->name }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->name }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->age}}</td>
                                        <td>{{ $item->num_of_bags }}</td>
                                        <td>{{ $item->bloodtype->name }}</td>
                                        <td><b>{{ $item->cities->governates->name }}:</b><br>{{ $item->cities->name }}
                                        </td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a href="{{Route('dashboard.donnations.show',$item->id)}}" class="btn btn-success" title="show"><i class="fas fa-eye"></i></a></td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['dashboard.donnations.destroy', $item->id],
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
            {!! $donnations->links() !!}
        </div>
    @else
        <div class="alert alert-danger">No Data</div>
        @endif
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#search').onkeyup = function(e) {
        if (e.keyCode === 13) {
            $('form').submit(); // your form has an id="form"
        }
    }
    function changeStatus(id) {
        $.ajax({
            type: "post",
            url: "{{ Route('dashboard.client.toggleActive') }}",
            data: {
                'id': id
            },
            dataType: "json",
            success: function(response) {
                $('.show-data table ').load(location.href + ".show-data table");
            }
        });
    }
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
