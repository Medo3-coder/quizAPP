<?php

namespace App;

use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    private $limit = 10 ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'visible_password' , 'occupation' ,
        'address' , 'phone' , 'bio' , 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function storeUser($data)
    {    // this visible_password is the same password coming from the form so dont bcrypt
        $data['visible_password'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = 0 ;
        return User::create($data);
    }

 // to  get all users
    public function allUsers()
    {
        return User::latest()->paginate($this->limit);
    }

    //get Single User

    public function findUser($id)
    {
        return User::find($id);
    }

    //update User
    public function updateUser($data,$id)
    {
        $user = User::find($id);

        if($data['password'])
        {
            $user->password = bcrypt($data['password']);
            $user->visible_password = $data['password'];
        }

        $user->name = $data['name'];
        $user->occupation = $data['occupation'];
        $user->address = $data['address'];
        $user->phone  = $data['phone'];
        $user->save();
    }

    //to delete User

    public function deleteUser($id)
    {
        return User::find($id)->delete();
    }
}
