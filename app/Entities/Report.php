<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = ['statement', 'status'];

    public function patient()
    {
    	return $this->belongsTo(User::class, 'patient_id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
