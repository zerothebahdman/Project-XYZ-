<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function author() {
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

    public function getDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}