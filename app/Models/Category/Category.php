<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CategoryScope;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table='categories';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    protected $fillable = [
        'slug',
        'is_active'
    ];
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new CategoryScope);
    }

    public function CategoryTranslation()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
