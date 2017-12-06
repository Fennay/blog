<?php

namespace App\Model;

use Eloquent;

class ArticleContent extends Eloquent
{
    protected $table = 'article_content';

    protected $fillable = [
        'id',
        'aid',
        'content'
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
