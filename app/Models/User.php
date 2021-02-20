<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Suites\Resourcefulness;
use App\Mail\UserVerification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Resourcefulness, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
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
    
    public function projects()
    {
        return $this->hasMany(Project::class,'manager_id');
    }
    
    public function path()
    {
        return '/candidates/'.$this->id;
    }
    
    public function sendEmailVerificationNotification(){
        
        //Mail should be sent to user
        $emailAddress = $this->getEmailForVerification();
        Mail::to($emailAddress)->send(new UserVerification($emailAddress, $this->id));
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    
    public function assignRole(Role $role)
    {
        $this->roles->sync($role);
    }
    
    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }
    
}
