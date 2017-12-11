<?php

namespace Day7;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {
    protected $table = 'programs';

    protected $guarded = [];

    public $incrementing = false;

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
