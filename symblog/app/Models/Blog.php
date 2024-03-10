<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Capsule\Manager as Capsule;
use App\Models\Comment;

class Blog extends Eloquent
{

    protected $table = "blog";

    const CREATED_AT = "created";
    const UPDATED_AT = "updated";

    protected $fillable = ["id", "title", "author", "blog", "image", "tags", "created", "updated"];

    // Relación uno a muchos con el modelo Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Obtener todos los comentarios asociados a este blog
    public function getComments()
    {
        return $this->comments;
    }

    // Obtener el número de comentarios asociados a este blog
    public function numComments()
    {
        return $this->comments ? count($this->comments) : 0;
    }
}
?>