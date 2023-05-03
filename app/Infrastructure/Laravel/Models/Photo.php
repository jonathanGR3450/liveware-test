<?php

namespace App\Infrastructure\Laravel\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'path',
        'name',
        'imageable_id',
        'imageable_type',
        'created_at',
        'updated_at',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
