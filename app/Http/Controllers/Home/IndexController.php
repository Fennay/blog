<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/15 - 15:05
 */

namespace App\Http\Controllers\Home;


use App\Repositories\ArticleRepository;

class IndexController extends BaseController
{
    protected $articleObj;
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleObj = $articleRepository;
    }

    public function index()
    {

    }
}
