<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    protected $table = 'article';

    protected $fillable = [
        'title',
        'subhead',
        'desc',
        'thumb',
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

        $this->model = DB::table($this->table);
    }

    public function content()
    {
        return $this->hasOne('App\Model\ArticleContent', 'aid', 'id');
    }
}
