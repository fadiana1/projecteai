<?php

namespace App\Models\V1;

use App\Traits\UUIDAsPrimaryKey;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UUIDAsPrimaryKey, Sluggable;
    protected $guarded;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function tani()
    {
        return $this->belongsTo(Tani::class);
    }
}
