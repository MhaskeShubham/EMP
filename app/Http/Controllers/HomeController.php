<?php

namespace App\Http\Controllers;

use App\Model\Alarm;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function empIndex()
    {
        $users = Employee::getUsers();

        $dept = Department::getUsers();

        return view('employee.index')
            ->with('users', $users)
            ->with('dept', $dept);
    }

    protected function _prepare($request)
    {
        $data = [
            "EMPNAME"          => $request->get("name"),
            "EMPDOB"          => $request->get("EMPDOB"),
            "EMPSAL"         => $request->get("EMPSAL"),
            "EMPGEN"         => $request->get("gender"),
            "EMPSEDEMPEDUCATION"  => implode(',',$request->get('EMPSEDEMPEDUCATION')),
            "EMPHOBBIES"       => $request->get('EMPHOBBIES'),
            "DEPTID"       => $request->get('DEPTID')
        ];
        return $data;
    }

    public function empAdd(Request $request)
    {

        try
        {
            if(empty($_POST))
            {
                return view('employee.add');
            }
            else
            {
                $user_data = $this->_prepare($request);

                $user_obj  = new Employee();
                $user_obj->saveUser($user_data);
                return response()->json(['status' => 'success' ,'msg' => 'New Employee Added Successfully']);
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
            $user = Employee::getUsersById($id);
            if (empty($_POST))
            {
                return view('employee.edit')
                    ->with('user', $user[0]);
            }
            else
            {
                $user_data = $this->_prepare($request);
                $user_obj  = new Employee();
                $user_obj->updateUser($id,$user_data);
                return response()->json(['status' => 'success', 'msg' => 'Employee Updated Successfully']);
            }
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'failure', 'error' => 'Something Went Wrong']);
        }

    }

    public function EmpDelete(Request $request, $id)
    {
        Employee::deleteUser($id);
        $request->session()->flash('message', "Employee deleted Successfully");
        return Redirect::to(route("employee::index"));
    }

}
