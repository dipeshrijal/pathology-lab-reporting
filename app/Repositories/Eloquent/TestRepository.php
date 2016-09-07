<?php

namespace App\Repositories\Eloquent;

class TestRepository extends Repository
{
    public function model()
    {
        return \App\Entities\Test::class;
    }
}
