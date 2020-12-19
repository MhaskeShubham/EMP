<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DeptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected function _prepare($request)
    {
        $data = [
            "DEPTNAME"          => $request->get("name"),
            "DEPTSTATE"          => $request->get("DEPTSTATE"),
            "DEPTDIST"         => $request->get("DEPTDIST"),
        ];
        return $data;
    }

    public function empAdd(Request $request)
    {
        try
        {
            if(empty($_POST))
            {
                return view('department.add');
            }
            else
            {
                $user_data = $this->_prepare($request);

                $user_obj  = new Department();
                $user_obj->saveUser($user_data);
                return response()->json(['status' => 'success' ,'msg' => 'New Department Added Successfully']);
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'failure', 'error' => 'Something Went Wrong']);
        }
    }

    public function empEdit(Request $request, $id)
    {
        try
        {
            $user = Department::getUsersById($id);
            if (empty($_POST))
            {
                return view('department.edit')
                    ->with('user', $user[0]);
            }
            else
            {
                $user_data = $this->_prepare($request);
                $user_obj  = new Department();
                $user_obj->updateUser($id,$user_data);
                return response()->json(['status' => 'success', 'msg' => 'Department Updated Successfully']);
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'failure', 'error' => 'Something Went Wrong']);
        }

    }

    public function EmpDelete(Request $request, $id)
    {
        Department::deleteUser($id);
        $request->session()->flash('message', "Department deleted Successfully");
        return Redirect::to(route("employee::index"));
    }
}
