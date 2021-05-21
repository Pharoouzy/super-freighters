<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Models
 */
class Setting extends Model {
    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'id'];

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @param $key
     */
    public static function get($key) {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }

    /**
     * @param $key
     * @param null $value
     * @return bool
     */
    public static function set($key, $value = null) {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($key) == $value) {
            return true;
        }
        return false;
    }
}
