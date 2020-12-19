@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Edit User</h4>
                    </div>
                    <div id="editUserError">
                    </div>
                    <div class="card-body">
                        <form id="editUser" enctype="multipart/form-data"
                              action="{{ route("employee::edit",$user['EMPID']) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input name="name"  type="text" class="form-control" id="name" placeholder="Enter name" value="{{$user['EMPNAME']}}" required>
                                    </div>
                                    <div class="form-group date col-md-6">
                                        <label for="EMPDOB">Date Of Birth</label>
                                        <input type="text" value="{{$user['EMPDOB']}}" class="form-control pull-right input-sm datepicker" name="EMPDOB" id="EMPDOB" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="EMPSAL">Salary</label>
                                        <input name="EMPSAL"  type="number" class="form-control" id="EMPSAL" placeholder="Enter Salary" value="{{$user['EMPSAL']}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="EMPSEDEMPEDUCATION">Education</label>
                                        <select class="form-control input-sm" name ="EMPSEDEMPEDUCATION[]" id="EMPSEDEMPEDUCATION" multiple="multiple" required>
                                            {{--                                            <option value="home">Home</option>--}}
                                            <option value="BCA">BCA</option>
                                            <option value="MCA">MCA</option>
                                            <option value="BCS">BCS</option>
                                            <option value="MCS">MCS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="EMPHOBBIES">Hobbies</label>
                                        <input name="EMPHOBBIES"  type="text" class="form-control" id="EMPHOBBIES" placeholder="Enter Hobbies" value="{{$user['EMPHOBBIES']}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="DEPTID">Department</label>
                                        <input name="DEPTID"  type="number" class="form-control" id="DEPTID" placeholder="Enter Department id" value="{{$user['DEPTID']}}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label><br>
                                        <input type="radio" name="gender" value="Male" required> Male
                                        <input type="radio" name="gender" value="Female"> Female
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a type="button" href="{{ route("employee::index") }}"
                                   class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#EMPDOB').datepicker({
                "autoclose":true,
                "endDate":"{{date("Y-m-d", strtotime('+0 days'))}}",
                "format":"yyyy-mm-dd",
                "todayHighlight":true
            });
            $('#EMPSEDEMPEDUCATION').select2({
                placeholder: "Select Education",
            });
            // $('#EMPSEDEMPEDUCATION').val(null).trigger("change")
        });

        $("#editUser").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    var error = (response['status'] === 'success') ? response['msg'] : response['error'];
                    var status = (response['status'] === 'success') ? 'alert-success' : 'alert-danger';
                    let contents = '<div class="alert '+status+' alert-block">'+
                        '<button type="button" class="close" data-dismiss="alert">×</button>'+
                        '<strong>'+error+'</strong></div>';
                    $('#editUserError').html(contents);
                    $('#editUserError').val('');
                    setTimeout(function () {
                        $('#editUserError').html('');
                        if(status === 'alert-success')
                        {
                            window.location.href = '{{route('employee::index')}}';
                        }
                    }, 5000);
                }
            });
        });
    </script>
@endsection
