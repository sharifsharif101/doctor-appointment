<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'address',
        'phone_number',
        'department',
        'image',
        'education',
        'description',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function role(){
        return $this->hasOne('App\Models\role', 'id', 'role_id');
    }

    public function userAvatar( $request){
        $image = $request->file('image');
        if ($image) {
            // Generate a hashed name for the image
            $name = $image->hashName();
            // Define the destination path
            $destination = public_path('/images');
            // Move the image to the destination
            $image->move($destination, $name);
            // Add the image name to the data array
            return $name;
        }
    }


}
