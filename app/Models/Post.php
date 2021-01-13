<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $dates = ['published_at'];
    public function user() {
        return $this->belongsTO(User::class);
    }

    public function getImageUrlAttribute($value){
        $imageUrl = '';

        if (!is_null($this->image)) {
            $imagePath = public_path(). "/img/" .$this->image;
            if (file_exists($imagePath)) $imageUrl = asset("img/" .$this->image);
        }

        return $imageUrl;
    }

    public function getDateAttribute($value){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    // Get blog posts that has been published
    public function scopePublished($query){
        return $query->where('published_at', '<=', Carbon::now());
    }
}