<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'category_id', 'published_at', 'image'];

    protected $dates = ['published_at'];

    public function user() {
        return $this->belongsTO(User::class);
    }

    // We are trying to create a relationship between the users table and the categories table
    // public function user(){
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute($value){
        $imageUrl = '';

        if (!is_null($this->image)) {
            $imagePath = public_path(). "/img/" .$this->image;
            if (file_exists($imagePath)) $imageUrl = asset("img/" .$this->image);
        }

        return $imageUrl;
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? : NULL;
    }

    public function getimageThumbnailUrlAttribute($value){
        $imageUrl = '';

        if (!is_null($this->image)) {
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = Str::replaceFirst('.{$ext}', '_thumb.{$ext}', $this->image);
            $imagePath = public_path(). "/img/" .$thumbnail;
            if (file_exists($imagePath)) $imageUrl = asset("img/" .$thumbnail);
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

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function sluggable(): array{
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

     public function getRouteKeyName()
    {
        return 'slug';
    }

    // Using the laravel markdown package to easily format html data from the database
    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    // Using the laravel markdown package to easily format html data from the database
    public function getExcerptHtmlAttribute($value)
    {
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL;
    }

    public function dateFormatted($showTimes = false){
        $format = "d/m/y";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (! $this->published_at) {
            return '<span class="badge badge-warning">Draft</span>';
        }elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="badge badge-info">Schedule</span>';
        }else {
            return '<span class="badge badge-success">Published</span>';
        }
    }
}