<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class todo extends Model
{
    use HasFactory;
    protected $with = ['users','admins'];
    public function users()
    {

        return $this->morphedByMany(User::class, 'todoable');
    }
    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'todoable');
    }
}
