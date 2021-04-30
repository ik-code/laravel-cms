<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'title', 'description', 'post_content', 'published_at', 'image', 'category_id'
    ];

    /**
     * Delete post image from storage
     */
    public function deleteImage(){
        Storage::delete($this->image);
    }

    /**
     * Relationships One To Many
     * Get the posts for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationships Many To Many
     * Get the posts for the tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany( Tag::class );
    }

    /**
     * checks if post has tags
     *
     * @param $tag_id
     *
     * @return bool
     */
    public function  hasTag($tag_id){
        return in_array($tag_id, $this->tags->pluck('id')->toArray());
    }
}
