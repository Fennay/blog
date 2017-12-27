<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/15 - 15:05
 */

namespace App\Http\Controllers\Home;


use App\Repositories\ArticleRepository;
use App\Exceptions\HomeException;
use HyperDown\Parser;

class IndexController extends BaseController
{
    protected $articleObj;
    protected $tagsList;
    protected $calendarData;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleObj = $articleRepository;
        $this->tagsList = $this->articleObj->getTagsListWith1Status();
        $this->calendarData = $this->calendarData();
    }

    public function index()
    {
        $articleList = $this->articleObj->getArticlePageListWith1Status();

        return view('home.index', [
            'tagsList'     => $this->tagsList,
            'articleList'  => $articleList,
            'calendarData' => $this->calendarData
        ]);
    }


    /**
     * 详情页
     * @param $articleUrl
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * Author: Fengguangyong
     */
    public function detail($articleUrl)
    {
        if (empty($articleUrl)) {
            view(404);
        }

        $this->addClick($articleUrl);

        // 如果为Id，则转换成URL
        if (is_numeric($articleUrl)) {
            $articleUrl = $this->articleObj->getArticleUrlById($articleUrl);

            return redirect(route('articleDetail', ['articleUrl' => $articleUrl]));
        }

        $articleInfo = $this->articleObj->getArticleInfoByUrl($articleUrl);

        if (empty($articleInfo)) {
            return view(404);
        }

        // markdown转换
        $content = $articleInfo->content->content;
        $parser = new Parser();
        $articleInfo->content->content = $parser->makeHtml($content);

        return view('home.detail', [
            'tagsList'     => $this->tagsList,
            'articleInfo'  => $articleInfo,
            'calendarData' => $this->calendarData
        ]);
    }

    /**
     * 点击次数
     * @param $articleId
     * @return mixed
     * @throws \App\Exceptions\HomeException
     */
    public function addClick($articleId)
    {
        return $this->articleObj->addClicks($articleId);
    }


    /**
     * 通过标签获取文章列表
     * @param $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($tag)
    {
        if (empty($tag)) {
            view(404);
        }
        $articleList = [];
        try {
            $articleList = $this->articleObj->getArticleListByTag($tag);
        } catch (HomeException $exe) {
            view(404);
        }

        return view('home.index', [
            'tagsList'     => $this->tagsList,
            'articleList'  => $articleList,
            'calendarData' => $this->calendarData
        ]);
    }


    public function calendarData()
    {
        $data = $this->articleObj->getArticleListGroupByDate();
        if (empty($data)) {
            return '';
        }
        foreach ($data as $k => $v) {
            $tmp['date'] = $k;
            $tmp['value'] = '';
            foreach ($v as $item => $value) {
                $tmp['value'] .= '<p><a href="' . route('articleDetail', ['url' => $value['url']]) . '" target="_blank">' . $value['title'] . '</p>';
            }
            $newData[] = $tmp;
        }

        return json_encode($newData, true);
    }
}
