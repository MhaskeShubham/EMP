@extends('layouts.app')

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0">Employee</h4>
                            </div><!--col-->

                            <div class="col-sm-7">
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <a type="button"  href="{{ route("employee::add") }}" class="btn btn-success ml-1" >Add <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div><!--btn-toolbar-->
                            </div><!--col-->
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="box-body table-responsive">
                        <table id="userTable" class="table table-striped table-bordered dataTable no-footer" style="width:100%">
                            <thead class="custom_thead">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">DOB</th>
                                <th class="text-center">Salary</th>
                                <th class="text-center">Education</th>
                                <th class="text-center">Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @if(count($users))
                                <?php $sno = 1;?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $user['EMPNAME'] }}</td>
                                        <td>{{ $user['EMPDOB'] }}</td>
                                        <td>{{ $user['EMPSAL'] }}</td>
                                        <td>{{ $user['EMPSEDEMPEDUCATION'] }}</td>
                                        <td>
                                            <a type="button"  href="{{ route("employee::edit",[$user['EMPID']]) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
{{--                                            @if($user->role_id === RE_DEVELOPER_ROLE_ID)--}}
{{--                                                <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this user, Plants mapped with this user also will deleted?', 'Yes', 'No', '{{ route("user::delete", $user->id) }}', 're_developer');"> <i class="fa fa-trash"></i></a>--}}
{{--                                            @else--}}
{{--                                                <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this user?', 'Yes', 'No', '{{ route("user::delete", $user->id) }}','other');"> <i class="fa fa-trash"></i></a>--}}
{{--                                            @endif--}}

                                            <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this user?', 'Yes', 'No', '{{ route("employee::delete", $user['EMPID']) }}','other');"> <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Employee Register</td>
                                <tr>
                            @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 class="card-title mb-0">Department</h4>
                            </div><!--col-->

                            <div class="col-sm-7">
                                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                                    <a type="button"  href="{{ route("department::add") }}" class="btn btn-success ml-1" >Add <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div><!--btn-toolbar-->
                            </div><!--col-->
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="box-body table-responsive">
                            <table id="deptTable" class="table table-striped table-bordered dataTable no-footer" style="width:100%">
                                <thead class="custom_thead">
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">District</th>
                                    <th class="text-center">Edit/Delete</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @if(count($dept))
                                    <?php $sno = 1;?>
                                    @foreach($dept as $row)
                                        <tr>
                                            <td>{{ $sno++ }}</td>
                                            <td>{{ $row['DEPTNAME'] }}</td>
                                            <td>{{ $row['DEPTSTATE'] }}</td>
                                            <td>{{ $row['DEPTDIST'] }}</td>
                                            <td>
                                                <a type="button"  href="{{ route("department::edit",[$row['DEPTID']]) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                {{--                                            @if($user->role_id === RE_DEVELOPER_ROLE_ID)--}}
                                                {{--                                                <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this user, Plants mapped with this user also will deleted?', 'Yes', 'No', '{{ route("user::delete", $user->id) }}', 're_developer');"> <i class="fa fa-trash"></i></a>--}}
                                                {{--                                            @else--}}
                                                {{--                                                <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this user?', 'Yes', 'No', '{{ route("user::delete", $user->id) }}','other');"> <i class="fa fa-trash"></i></a>--}}
                                                {{--                                            @endif--}}

                                                <a type="button" href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="Confirm('Delete User', 'Are you sure want to delete this department?', 'Yes', 'No', '{{ route("department::delete", $row['DEPTID']) }}','other');"> <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Department Register</td>
                                    <tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#userTable,#deptTable").DataTable();
        });

        // setTimeout(function () {
        //     window.location.reload();
        // }, 1000*20);

        function Confirm(title, msg, yes, cancel, link, role_type)
        {
            var content = '<div class="modal" role="dialog" id="deleteUser">'+
            '<div class="modal-dialog" role="document">'+
            '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<h5 class="modal-title">'+title+'</h5>'+
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                '<span aria-hidden="true">&times;</span>'+
            '</button>'+
            '</div>'+
            '<div class="modal-body">'+
                '<p id="msg">'+msg+'</p>'+
            '</div>'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-danger doAction">'+yes+'</button>'+
                '<button type="button" class="btn btn-success cancelAction" data-dismiss="modal">'+cancel+'</button>'+
            '</div>'+
            '</div></div></div>';
            $('body').prepend(content);
            $('#deleteUser').modal('show');
            $('.doAction').click(function () {
                if(role_type === 'other')
                {
                    window.open(link, "_self");
                }else{
                    $("#msg").html("Sorry! You can't delete this user for now.");
                    $("#msg").css({color:'red'});
                }
            });
            $('.cancelAction, .fa-close').click(function () {
                $('#deleteUser').modal('hide');
            });
        }
    </script>
@endsection
