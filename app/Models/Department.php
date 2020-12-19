<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Department extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DEPTNAME',
        'DEPTSTATE',
        'DEPTDIST'
    ];

    protected $table = 'departments';

    public $timestamps = false;

//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];
//
//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];


    public static function getUsers()
    {
        $users = Department::select()
            ->get()->toArray();
//            ->paginate(10);

        return $users;
    }

    public static function getUsersById($id)
    {
        $users = Department::select()
            ->where('DEPTID',$id)
            ->get()->toArray();
//            ->paginate(10);

        return $users;
    }

    public function saveUser($data)
    {
        try {
            foreach($data as $key => $value)
            {
                $this->$key = $value;
            }
            $this->save();
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateUser($id,$data)
    {
        try {
            DB::table('departments')->where('DEPTID',$id)->update($data);
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }


    }

    public static function deleteUser($id)
    {
        Employee::where('DEPTID',$id)->delete();
        Department::where('DEPTID',$id)->delete();
    }
}
