<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Eloquent
{
    use SoftDeletes;
    protected $table = 'article';

    protected $fillable = [
        'title',
        'subhead',
        'desc',
        'url',
        'img_url',
        'author',
        'author_id',
        'tags_id',
        'status',
        'sort',
        'clicks',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {

    }

    public function content()
    {
        return $this->hasOne('App\Model\ArticleContentModel', 'aid', 'id');
    }
}
