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
    }
}
