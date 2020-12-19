<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers()
    {
        $users = Employee::select()
                ->get();
//            ->paginate(10);

        return $users;
    }

    public function saveUser($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->save();

        return $this->id;
    }

    public function updateUser($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->update();
    }

    public static function deleteUser($id)
    {
        Employee::where('id',$id)->delete();
    }
}
