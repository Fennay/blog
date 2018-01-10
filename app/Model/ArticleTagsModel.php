<?php


namespace App\Model;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleTagsModel extends Eloquent
{
    use SoftDeletes;
    protected $table = 'article_tags';

    protected $fillable = [
        'name',
        'url',
        'status',
        'sort',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->clearKeys = [];
    }

}