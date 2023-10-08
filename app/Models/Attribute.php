<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id', 'id');
    }
}
