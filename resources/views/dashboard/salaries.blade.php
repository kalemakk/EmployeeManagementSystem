@extends('layouts.dashboard')
@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Salaries</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Salaries</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="card-title">All Salaries</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn-primary btn-sm float-right" data-toggle="modal"
                                                data-target="#add-salary">Add Salary
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Employee</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salaries as $salary)
                                        <tr>
                                            <td>{{decrypt($salary->amount)}}</td>
                                            <td>{{$salary->status}}</td>
                                            <td>{{$salary->employee->fullName()}}</td>
                                            <td>
                                                <a href="{{route('salaries.show',['salary'=>$salary])}}" style="color: black">
                                                    <button type="button" class="btn btn-primary btn-block btn-flat" style="color: white;font-size: 16px">View</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="modal fade" id="modal-success">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-success">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Success Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>One fine body&hellip;</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-light">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <div class="modal fade" id="modal-danger">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Danger Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>One fine body&hellip;</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-light">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->


                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    {{--add new dept--}}
    <div class="modal fade" id="add-salary">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('salaries.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Amount</label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('amount') is-invalid @enderror"
                                               name="amount" value="{{old('amount')}}" placeholder="Enter Amount" required>
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('amount')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="branch">Employee</label>
                                        <select name="employee" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" selected>Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value={{$employee->id}}>{{$employee->first_name." ".$employee->last_name}}</option>
                                            @endforeach
                                        </select>

                                        @error('employee')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('employee')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

{{--                                <div class="col-lg-6 col-md-6 col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="branch">Status</label>--}}
{{--                                        <select name="dept" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" required>--}}
{{--                                            <option value="" selected>Select Status</option>--}}
{{--                                                <option value="approved">{{$dept->name}}</option>--}}
{{--                                        </select>--}}

{{--                                        @error('dept')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{$errors->first('dept')}}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                            </div>

                            <div class="btn-group">
                                <button type="reset" class="btn btn-warning">Clear Form</button>
                                <button type="submit" class="btn btn-primary">Save Salary</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection



@push('scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        window.addEventListener("load", function () {
            @if(Session::has('errors'))
            $('#add-salary').modal({show: true})
            @endif
        });
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>

@endpush
