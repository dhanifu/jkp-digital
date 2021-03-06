<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembimbing extends Model
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

    public function getPhotoSrcAttribute()
    {
        if ($this->photo == null) {
            return "<img src='" . folderStorage("photos/user.jpg") . "'/>";
        }
        return "<img src='" . folderStorage("photos/pembimbing/$this->photo") . "'/>";
    }

    public function akun()
    {
        return $this->hasOne(User::class, 'pemilik_id');
    }

    public function rayon()
    {
        return $this->hasOne(Rayon::class);
    }
}
