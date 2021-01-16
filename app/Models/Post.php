<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

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

    public function sluggable(): array{
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

     public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Using the laravel markdown package to easily format html data from the database
    public function getBodyHtmlAttribute($value)
    {
        return this->body ? Markdown::convertToHtml(e($post->body)) : NULL;
    }

    // Using the laravel markdown package to easily format html data from the database
    public function getExcerptHtmlAttribute($value)
    {
        return this->excerpt ? Markdown::convertToHtml(e($post->excerpt)) : NULL;
    }
}
