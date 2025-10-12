<?php

namespace App\Models;

use App\Traits\HasUuidInsert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use  SoftDeletes, HasUuidInsert;
    protected $table = 'notifications';
//    protected $fillable = ['column1', 'column2'];
}
