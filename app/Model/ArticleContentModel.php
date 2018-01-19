<?php

namespace App\Model;

use Eloquent;

class ArticleContentModel extends Eloquent
{
    protected $table = 'article_content';

    protected $fillable = [
        'aid',
        'content',
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
}
