<?php

namespace App\Model;

class ArticleContent extends BaseModel
{
    protected $table = 'article_content';

    protected $fillable = [
        'aid',
        'content'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->model = DB::table($this->table);
    }
}
