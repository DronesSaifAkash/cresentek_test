<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeNotDeleted(Builder $query)
    {
        return $query->whereNull('is_deleted');
    }


    public function scopeOnlyDeleted(Builder $query)
    {
        return $query->whereNotNull('is_deleted');
    }

    public function softDelete()
    {
        $this->is_deleted = now();
        return $this->save();
    }

    public function restore()
    {
        $this->is_deleted = null;
        return $this->save();
    }

    public function isSoftDeleted()
    {
        return !is_null($this->is_deleted);
    }

    // point no 18
    // public function latestPhone(): HasOne
    // {
    //     return $this->hasOne(Phone::class)->latestOfMany();
    // }

    public function latestPhone()
    {
        try {
            $latestPhone = DB::table('phones')
                             ->where('user_id', $this->id)
                             ->orderBy('created_at', 'desc')
                             ->first(['phone_number']);

            return $latestPhone ? $latestPhone->phone_number : null;
        } catch (QueryException $e) {
            if ($e->getCode() === '42S02') {
                return null;
            }
            throw $e;
        }
    }

    public function saveLatestPhone($phoneNumber)
    {
        try {
            DB::table('phones')->insert([
                'user_id' => $this->id,
                'phone_number' => $phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }


    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
}
