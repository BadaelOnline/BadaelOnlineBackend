<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Config;


class TagScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join('about_translations', 'tags.id', '=', 'about_translations.tag_id')
            ->where('about_translations.local', '=', Config::get('app.locale'))
            ->select([
                'tags.id','tags.is_active','tags.slug',
                'about_translations.name','about_translations.keyword',
                'about_translations.meta_desc','about_translations.local'
            ]);
    }
}
