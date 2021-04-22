<?php

namespace WebmanPress\AutoRoute\Module;

use Exception;
use ReflectionClass;
use ReflectionException;
use Webman\Route;
use WebmanPress\AutoRoute\Attributes\Route as RouteAttribute;


class AutoRoute {

    protected static bool $openapi = true;

    /**
     * <h2 style="color:#E97230;">加载注解路由</h2>
     * <span style="color:#E97230;">/app 默认自动加载</span>
     *
     * @param array $list <span style="color:#E97230;">需要另外加载的目录</span>
     *                    <pre style="color:#E97230;">[ [命名空间根, 目录绝对路径], ...array]</pre>
     *
     * @throws ReflectionException
     */
    static function load(array $list = [], $openapi = true) {
        static::$openapi = $openapi;
        $class_list      = [];
        // 扫描 /app 目录所有可用文件
        static::scanClass('\app', app_path(), $class_list);

        // 扫描 OpenAPI 文件
        $openapi && static::scanClass(
            'WebmanPress\AutoRoute\Controller',
            dirname(__DIR__) . '/Controller',
            $class_list
        );

        // 扫描给定的目录列表中所有可用类
        foreach ($list as $item) {
            static::scanClass($item[0], $item[1], $class_list);
        }

        /** 扫描给定的目录列表中所有可用路由 */
        foreach ($class_list as $class => $namespace) {
            static::scanRoute($class, $namespace);
        }

        /** OPTIONS 请求方法处理 */
        Route::options('/{all:.*}', function () { return response(''); });
    }

    /**
     * <h2 style="color:#E97230;">扫描目录存在的类</h2>
     *
     * @param string $base_namespace <span style="color:#E97230;">对应的命名空间根</span>
     * @param string $dir <span style="color:#E97230;">目录</span>
     * @param array  $class_list <span style="color:#E97230;">引用列表</span>
     */
    protected static function scanClass(string $base_namespace, string $dir, array &$class_list) {
        $dir = realpath($dir);

        /**
         * 读取PHP文件列表
         */
        $files = static::scanFiles($dir);
        /**
         * 扫描类
         */
        foreach ($files as $file) {
            /** 拼接类名 */
            $class = str_replace("/", '\\', str_replace($dir, $base_namespace, preg_replace("/\.php$/i", '', $file)));
            /** 确定类存在 */
            if (class_exists($class)) {
                $class_list[$class] = $base_namespace;
            }
        }
    }

    /**
     * <h2 style="color:#E97230;">扫描目录所有PHP文件</h2>
     * <div style="color:#E97230;">排除 . 开头的文件夹和 model,view 文件夹</div>
     *
     * @param string $dir <span style="color:#E97230;">扫描的目录</span>
     *
     * @return array
     */
    protected static function scanFiles(string $dir): array {
        $dir = realpath($dir);

        if (!is_dir($dir))
            return [];

        $items = scandir($dir);
        $files = [];
        foreach ($items as $item) {
            if (!preg_match("/(^\..*|model|view)/", $item)) {
                $item_path = $dir . DIRECTORY_SEPARATOR . $item;
                if (is_dir($item_path)) {
                    array_push($files, ...static::scanFiles($item_path));
                } elseif (preg_match("/\.php$/i", $item)) {
                    array_push($files, $item_path);
                }
            }
        }

        return $files;
    }

    /**
     * <h2 style="color:#E97230;">扫描所有注解路由</h2>
     *
     * @param string $class <span style="color:#E97230;">类名</span>
     * @param string $namespace <span style="color:#E97230;">基本命名空间</span>
     *
     * @throws ReflectionException
     * @throws Exception
     */
    protected static function scanRoute(string $class, string $namespace) {
        /** 给定类的反射类 */
        $ref = new ReflectionClass($class);
        /** 获取类里的所有方法 */
        $methods = $ref->getMethods();
        /** 遍历类方法 */
        foreach ($methods as $method) {

            /** 读取方法的路由注解 */
            $attributes = $method->getAttributes(RouteAttribute::class);

            /** 遍历方法的所有路由 */
            foreach ($attributes as $attribute) {
                /**
                 * 路由对象
                 *
                 * @var RouteAttribute $route
                 */
                $route = $attribute->newInstance();

                /** 设置的路由对象的参数列表 */
                $arguments = $attribute->getArguments();

                /** 读取路由Path */
                $path = preg_replace("/^\.\//", '', isset($arguments[0]) ? $arguments[0] : $arguments['route']);

                // 路由对应方法
                $callback = $ref->name . '@' . $method->name;

                /** 相对路径子路由处理 */
                if (!preg_match("/^[\/\\\]/", $path)) {
                    // 获取路由基本路径
                    $basePath = str_replace(
                        "\\",
                        '/',
                        str_replace(
                            preg_replace("/^(\\\)/", '', $namespace),
                            '',
                            $ref->name
                        )
                    );

                    // 驼峰转换
                    $basePath = strtolower(preg_replace("/([a-z])([A-Z])/", "$1-$2", $basePath));

                    // 路径中移除 controller 目录
                    $basePath = str_replace('/controller', '', $basePath);
                    // 路径中移除 index 类名
                    $basePath = str_replace('/index', '', $basePath);

                    // 拼接实际路径
                    $path = $basePath . (empty($path) ? '' : '/' . $path);
                }

                /** 设置路由路径 */
                $route->path = (string)$path;

                /** 添加路由 */
                $route->add($callback);

                /** 添加到 OpenAPI 文档 */
                static::$openapi && $route->addToOpenAPI();
            }
        }
    }
}