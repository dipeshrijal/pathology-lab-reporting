<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    protected $fillable = ['test', 'result', 'normal_range'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
