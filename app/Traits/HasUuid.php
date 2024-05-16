<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getKeyName()
    {
        return 'uuid';
    }

    public function getKeyType()
    {
        return 'string';
    }
}
