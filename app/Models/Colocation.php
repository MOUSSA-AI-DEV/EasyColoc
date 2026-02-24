<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['name', 'owner_id', 'status'];


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['role', 'joined_at', 'left_at'])
            ->wherePivot('left_at', null);
    }

    public function allMembers()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['role', 'joined_at', 'left_at']);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
