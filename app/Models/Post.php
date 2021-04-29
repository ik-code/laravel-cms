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
      'title', 'description', 'post_content', 'published_at', 'image'
    ];

    /**
     * Delete post image from storage
     */
    public function deleteImage(){
        Storage::delete($this->image);
    }
}
