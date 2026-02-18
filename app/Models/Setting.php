<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table ="settings";
    protected $guarded = ['id'];
    public $timestamps = true;

    public static function getValue($key, $default = null)
    {
        try {
            $record = static::where('key', $key)->first();
            if (!$record) {
                return $default;
            }
            return $record->value;
        } catch (\Throwable $e) {
            return $default;
        }
    }
}
