<?php

namespace App\Model;

use Eloquent;

class ArticleContent extends Eloquent
{
    protected $table = 'article_content';

    protected $fillable = [
        'aid',
        'content',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
