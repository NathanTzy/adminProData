<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDistributor extends Model
{
    protected $fillable = ['name', 'email', 'password', 'role', 'user_id']; // Menambahkan 'user_id'

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
