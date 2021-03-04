<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rombel extends Model
{
    use HasFactory;

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

    protected $guarded = [];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }
}
