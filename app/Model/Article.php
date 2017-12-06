<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Eloquent
{
    use SoftDeletes;
    protected $table = 'article';

    protected $fillable = [
        'title',
        'subhead',
        'desc',
        'img_url',
        'author',
        'author_id',
        'tag_id',
        'status',
        'sort',
        'clicks',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function content()
    {
        return $this->hasOne('App\Model\ArticleContent', 'aid', 'id');
    }
}
