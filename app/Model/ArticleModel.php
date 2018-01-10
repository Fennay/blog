<?php

namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Eloquent
{
    use SoftDeletes;
    public $table = 'article';
    // public $clearKeys;

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
        parent::__construct($attributes);
        $this->clearKeys = [
            'get_index_article_detail_by_article_url_*',
            'get_article_list_group_by_date_*',
        ];
    }

    public function content()
    {
        return $this->hasOne('App\Model\ArticleContentModel', 'aid', 'id');
    }
}
