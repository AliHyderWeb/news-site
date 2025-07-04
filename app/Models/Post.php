<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   use HasFactory;

   protected $fillable = [ 'title', 'description', 'category_id', 'post_image', 'user_id' ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function category()
   {
      return $this->belongsTo(Category::class);
   }
}
