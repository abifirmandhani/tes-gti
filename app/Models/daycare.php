<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daycare extends Model
{
    use HasFactory;
    protected $table = 'daycare';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
        "establishment_date" => 'datetime:Y-m-d',
        "operational_permission_date" => 'datetime:Y-m-d',
        "rt"    => "string",
        "rw"    => "string",
    ];
}
