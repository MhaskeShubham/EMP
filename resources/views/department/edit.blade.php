@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Edit Department</h4>
                    </div>
                    <div id="editUserError">
                    </div>
                    <div class="card-body">
                        <form id="editUser" enctype="multipart/form-data"
                              action="{{ route("department::edit",$user['DEPTID']) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input name="name"  type="text" class="form-control" id="name" placeholder="Enter name" value="{{$user['DEPTNAME']}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="DEPTSTATE">State</label>
                                        <input name="DEPTSTATE"  type="text" class="form-control" id="DEPTSTATE" placeholder="Enter State" value="{{$user['DEPTSTATE']}}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="DEPTDIST">District</label>
                                        <input name="DEPTDIST"  type="text" class="form-control" id="DEPTDIST" placeholder="Enter District" value="{{$user['DEPTDIST']}}" required>
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
