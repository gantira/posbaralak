<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $appends = ['image_link'];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
    ];

    public function getImageLinkAttribute()
    {
        return $this->image ? asset(Storage::url($this->image)) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6V_R6WMnHzN5bpexR-vQ1tNickx9phBGTHA&usqp=CAU';
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function statuses()
    {
        return $this->morphToMany(Status::class, 'statusable');
    }
}
