<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
     * @var array<int, string>
     */
    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'password',
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
    ];

    
    public function projects()
    {
        return $this->hasMany(Project::class,'manager_id');
    }
    
    public function path()
    {
        return '/candidates/'.$this->id;
    }
    
    /*public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }*/
    
    public function sendEmailVerificationNotification(){
        
        //Mail should be sent to user
        $emailAddress = $this->getEmailForVerification();
        Mail::to($emailAddress)->send(new UserVerification($emailAddress, $this->id));
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function hasRole($role)
    {
        if(is_string($role)){
            $roleNames = $this->roles->pluck('name');
            return $roleNames->contains($role);
        }

        return !! $role->intersect($this->roles)->count();
        
    }
    
    public function assignRole(Role $role)
    {
        $this->roles()->syncWithoutDetaching([$role->id]);
    }
    
    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }
    
    public function isManager()
    {
        return $this->permissions()->contains('manage_project');
    }
    
    public function profile(string $append = '')
    {
        $path = route('profile');
        
        if ($append) $path = route('profile.'.$append, $this);
        
        return $path;
    }
    
}
