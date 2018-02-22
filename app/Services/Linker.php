<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2018/2/22 - 10:50
 */

namespace App\Services;

/**
 * Linker
 * 便捷URL生成封装，主要用来生成第三方（例如资源域名）的路径
 *
 * @author  AaronLiu <liukan0926@stnts.com>
 * @package Common\Packages\Purl
 */
class Linker
{
    /**
     * 已设置前缀
     *
     * @var array
     */
    protected $prefixes;


    /**
     * Store a url setting.
     *
     * @param $name
     * @param $prefix
     */
    public function set($name, $prefix)
    {
        $this->setPrefix($name, $prefix);
    }

    /**
     * @param $name
     * @param $prefix
     */
    protected function setPrefix($name, $prefix)
    {
        $snakeCaseName = static::toSnakeCase($name);

        $this->prefixes[$snakeCaseName] = $prefix;
    }

    /**
     * Make a url base on a url setting.
     *
     * @param $name
     * @param $args
     * @return string
     */
    public function __call($name, $args)
    {
        if (count($args) > 1) {
            throw new \InvalidArgumentException('Invalid argument number: Only can have one argument');
        }

        $snakeCaseName = static::toSnakeCase($name);

        if (! isset($this->prefixes[$snakeCaseName])) {
            throw new \InvalidArgumentException('Setting "' . $name . '" not found.');
        }

        $suffix = empty($args) ?
            '' :
            $args[0];

        return is_callable($this->prefixes[$snakeCaseName]) ?
            $this->prefixes[$snakeCaseName]($suffix) :
            $this->prefixes[$snakeCaseName] . $suffix;
    }

    /**
     * Parse url to url setting for Linker use.
     *
     * @param $url
     * @return array
     */
    static protected function getSettingFromUrl($url)
    {
        $urlInfo = parse_url($url);

        if ($urlInfo === false || ! isset($urlInfo['scheme'])) {
            return [
                'all'    => $url,
                'scheme' => '',
                'host'   => '',
                'path'   => $url,
            ];
        }

        return [
            'all'    => $url,
            'scheme' => $urlInfo['scheme'],
            'host'   => $urlInfo['host'],
            'path'   => empty($urlInfo['path']) ? '' : $urlInfo['path'],
        ];
    }

    /**
     * Convert string to a snake-case string.
     *
     * @param $str
     * @return string
     */
    static protected function toSnakeCase($str)
    {
        $u = '_';

        $sanitizedStr = trim(
            preg_replace('/[^a-zA-Z]+/', $u, $str),
            $u
        );

        $snakeCaseStr = strtolower(
            preg_replace('/([A-Z])/', '_$1',
                lcfirst($str)
            )
        );

        return $snakeCaseStr;
    }

}