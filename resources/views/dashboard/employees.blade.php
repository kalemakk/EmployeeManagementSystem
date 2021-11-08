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
                        <h1 class="m-0">Employees</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Employees</li>
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
                                        <h3 class="card-title">All Employees</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn-primary btn-sm float-right" data-toggle="modal"
                                                data-target="#add-employee">Add Employee
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Branch</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->position}}</td>
                                            <td>{{$employee->branch->name}}</td>
                                            <td>
                                                <a href="{{route('employees.show',['employee'=>$employee])}}" style="color: black">
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
    <div class="modal fade" id="add-employee">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('first_name') is-invalid @enderror"
                                               name="first_name" value="{{old('first_name')}}" placeholder="Enter First Name" required>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('first_name')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('last_name') is-invalid @enderror"
                                               name="last_name" value="{{old('last_name')}}" placeholder="Enter Last Name" required>
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('last_name')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email"
                                               class="form-control form-control-sm @error('email') is-invalid @enderror"
                                               name="email" value="{{old('email')}}" placeholder="Enter Email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Location</label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('location') is-invalid @enderror"
                                               name="location" value="{{old('location')}}" placeholder="Enter Location" required>
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('location')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Position</label>
                                        <input type="text"
                                               class="form-control form-control-sm @error('position') is-invalid @enderror"
                                               name="position" value="{{old('position')}}" placeholder="Enter Position" required>
                                        @error('position')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('position')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Joined On</label>

                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="joined" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>


{{--                                        <input type="text"--}}
{{--                                               class="form-control form-control-sm @error('position') is-invalid @enderror"--}}
{{--                                               name="position" value="{{old('position')}}" placeholder="Enter Position" required>--}}
                                        @error('joined')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('joined')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="branch">Branch</label>
                                        <select name="branch" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" selected>Select Branch</option>
                                            @foreach($branches as $branch)
                                                <option value={{$branch->id}}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('branch')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('branch')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="branch">Department</label>
                                        <select name="dept" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" selected>Select Department</option>
                                            @foreach($depts as $dept)
                                                <option value={{$dept->id}}>{{$dept->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('dept')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('dept')}}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="btn-group">
                                <button type="reset" class="btn btn-warning">Clear Form</button>
                                <button type="submit" class="btn btn-primary">Save Employee</button>
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
            $('#add-dept').modal({show: true})
            @endif
        });
    </script>

@endpush
