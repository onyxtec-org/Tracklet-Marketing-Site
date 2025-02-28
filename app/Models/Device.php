<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function versions()
    {
        return $this->hasMany(DeviceVersion::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }
}
