<?php


namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuidInsert
{
    public static function bootHasUuidInsert()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string)Str::uuid();
            }
        });
    }
}
