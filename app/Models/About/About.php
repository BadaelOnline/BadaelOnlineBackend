<?php

namespace App\Models\About;

use App\Scopes\AboutScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table='abouts';
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    protected $fillable = [
        'is_active'
    ];
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope(new AboutScope);
    }
    public function AboutTranslation()
    {
        return $this->hasMany(AboutTranslation::class);
    }
}
