<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        'about',
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

    /**
     * Checks admin role
     *
     * @return bool
     */
    public function isAdmin(){
        return $this->role === 'admin';
    }

    /**
     * Relationships One To Many
     * Get the posts for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
     * Returns users_have_posts
     *
     * @return \Illuminate\Support\Collection
     */
    public function users_have_posts(){
        return DB::table('users')->whereExists(function ($query) {
            $query->select('user_id')
                  ->from('posts')
                  ->whereColumn('posts.user_id', 'users.id');
        })->get();
    }
}
