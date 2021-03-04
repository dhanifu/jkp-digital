<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rayon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'pembimbing_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }
}
