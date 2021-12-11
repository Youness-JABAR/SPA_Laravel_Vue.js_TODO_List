<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function todos()
    {
        return $this->morphToMany(Todo::class, 'todoable');
    }
}
