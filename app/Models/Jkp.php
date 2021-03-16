<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jkp extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });

        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::user()->id;
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
    protected $dates = ['deleted_at'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
