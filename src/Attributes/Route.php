<?php


namespace WebmanPress\AutoRoute\Attributes;

use Attribute;
use FastRoute\RouteParser\Std;
use support\Request;
use Webman\Route as RouteClass;
use Webman\Route\Route as RouteObject;
use WebmanPress\AutoRoute\Module\OpenAPI;
use WebmanPress\AutoRoute\Module\Validator;

/**
 * Class AutoRoute
 *
 * @package WebmanPress\Attributes\AutoRoute
 */
#[Attribute(Attribute::IS_REPEATABLE | Attribute::TARGET_METHOD)]
class Route {
    public string   $path   = '';
    protected array $config = ['path' => '', 'method' => '', 'operation' => []];

    /**
     * <h2 style="color:#E97230;">注解路由</h2>
     * <div style="color:#E97230;"><a href="https://swagger.io/specification/#parameter-object">OpenAPI
     * 标准文档</a></div>
     *
     * @param string     $route <span style="color:#E97230;">路由 Path</span>
     * @param string     $method <span style="color:#E97230;">路由方法（get, post, put ...）</span>
     * @param array      $middleware <span style="color:#E97230;">路由中间件</span>
     * <pre style="color:#3982F7;">[ MiddleWare::class, ... ]</pre>
     * <hr/>
     * @param null       $openapi <span style="color:#E97230;">是否在 OpenAPI 文档中显示此路由方法</span>
     *
     * @param array      $cookie
     * @param array      $header
     * @param array      $get
     * @param array      $post
     *
     * @param array      $tags <span style="color:#E97230;">[Operation] 方法所属分组</span>
     * <div style="color:#E97230;">直接给 string 就可以，如果需要添加描述等信息只需要注解一次就会自动注册到全局。</div>
     * <pre style="color:#3982F7;">[
     *    '标签名称',
     *    [
     *        'name'            => '标签名称带描述'
     *        'description'     => '标签描述',
     *        'externalDocs'    => [
     *            'description' => '外部文档描述',
     *            'url'         => '外部文档链接',
     *        ]
     *     ]
     *]</pre>
     *
     * @param string     $summary <span style="color:#E97230;">[Operation] 方法简介</span>
     * @param string     $description <span style="color:#E97230;">[Operation] 方法详细说明</span>
     * @param array      $externalDocs <span style="color:#E97230;">[Operation] 方法外部文档</span>
     *<pre style="color:#3982F7;">[
     *    'description' => '文档描述',
     *    'url'         => '文档链接'
     *]</pre>
     *
     * @param null       $operationId <span style="color:#E97230;">[Operation] 方法操作 ID，区分大小写且唯一</span>
     * @param array      $parameters <span style="color:#E97230;">[Operation] 路由接受的参数列表</span>
     * <pre style="color:#3982F7;">[
     *    [
     *        'name'        => '参数名称',
     *        'in'          => 'query',
     *        'description' => '参数描述说明',
     *        'required'    => true,
     *        'deprecated'  => false,
     *    ],
     *    ...
     *]</pre>
     *
     * @param array      $requestBody <span style="color:#E97230;">[Operation] requestBody</span>
     * <a href="https://swagger.io/specification/#request-body-object" style="color:#5A9BF6;">标准文档</pre>
     * <div style="color:#E97230;">直接给出 ['schema'=>[...],'example'=>[..]] 格式的按照 multipart/form-data 方式注册，否则按照标准注册</div>
     *
     * @param string[][] $responses <span style="color:#E97230;">[Operation] 路由返回数据示例</span>
     * <pre style="color:#3982F7;">[
     *    200 => [
     *        'description' => 'Success',
     *        'headers'     => [
     *            'x-header' => [
     *                'description' => '描述',
     *                'schema' => [
     *                    'type' => 'integer',
     *                    ...
     *                ],
     *            ]
     *        ],
     *    ]
     *]</pre>
     *
     * @param array      $callbacks <span style="color:#E97230;">[Operation] </span>
     * @param bool       $deprecated <span style="color:#E97230;">[Operation] 声明此方法是否已被废弃</span>
     * @param null       $security <span style="color:#E97230;">[Operation] 安全声明</span>
     * @param array      $servers <span style="color:#E97230;">[Operation] 服务器列表</span>
     * <a href="https://swagger.io/specification/#server-object" style="color:#5A9BF6;">标准文档</pre>
     * <hr/>
     *
     * @param array      $extend <span style="color:#E97230;">[Operation] 扩展选项</span>
     * <div style="color:#E97230;">用于扩展方法的选项、也可以用于强制替换方法选项</div>
     *
     * @param string     $g_openapi <span style="color:#E97230;">[OpenAPI] OpenAPI 规范版本  (此行以下参数全局声明一次即可)</span>
     * @param array      $g_info <span style="color:#E97230;">[OpenAPI] 文档信息</span>
     * <pre style="color:#3982F7;">[
     *    'title'          => '项目名称',
     *    'description'    => '项目描述',
     *    'version'        => '0.0.0',
     *    'termsOfService' => 'http://localhost/service.html',
     *    'contact'        => [
     *        'name'  => '联系人',
     *        'url'   => 'http://localhost/contact.html',
     *        'email' => 'example@example.com'
     *    ],
     *    'license'        => [
     *        'name' => 'API许可',
     *        'url'  => 'http://localhost/license.html'
     *    ]
     *]</pre>
     *
     * @param array      $g_servers <span style="color:#E97230;">[OpenAPI] 接口服务器列表</span>
     * <pre style="color:#3982F7;">[
     *    [
     *        'url'         => 'https://development.gigantic-server.com/v1',
     *        'description' => 'Development server'
     *    ],
     *    [
     *        'url'         => 'https://{username}.gigantic-server.com:{port}/{basePath}',
     *        'description' => 'The production API server',
     *        'variables'   => [
     *            'username' => [
     *                'default'     => 'demo',
     *                'description' => 'description'
     *            ],
     *            'port'     => [
     *                'default'     => 'demo',
     *                'enum'        => [
     *                    '8443',
     *                    '443',
     *                ]
     *            ],
     *            'basePath' => [
     *                'default'     => 'v2',
     *            ],
     *        ]
     *    ],
     *    ...
     *]</pre>
     * @param array      $g_components <span style="color:#E97230;">[OpenAPI] 公共组件</span>
     * @param array      $g_securitySchemes <span style="color:#E97230;">[OpenAPI] 认证方式声明</span>
     * @param array      $g_security <span style="color:#E97230;">[OpenAPI] 全局可选认证方式</span>
     * @param array      $g_tags <span style="color:#E97230;">[OpenAPI] Tag 描述列表</span>
     * <pre style="color:#3982F7;">[
     *    'name'         => '标签名称',
     *    'description'  => '标签描述',
     *    'externalDocs'    => [
     *        'description' => '外部文档描述',
     *        'url'         => '外部文档链接',
     *    ]
     *]</pre>
     *
     * @param array      $g_externalDocs <span style="color:#E97230;">[OpenAPI] 服务器列表</span>
     * <a href="https://swagger.io/specification/#server-object" style="color:#5A9BF6;">标准文档</pre>
     *
     * @param array      $g_extend <span style="color:#E97230;">[OpenAPI] 扩展选项</span>
     * <div style="color:#E97230;">用于扩展根对象下的选项、也可以用于强制替换全局设置</div>
     *
     * @param null       $validator <span style="color:#E97230;">自定义方法参数验证器，设置后默认验证器将失效</span>
     *
     * @link https://swagger.io/specification/ OpenAPI 标准
     */
    public function __construct(
        // 路由参数
        protected $route = '',              // <span style="color:#E97230;">路由</span>
        protected $method = 'get',          // <span style="color:#E97230;">路由响应的请求方法</span>
        protected $middleware = [],         // <span style="color:#E97230;">路由使用的中间件</span>
        protected $openapi = null,          // <span style="color:#E97230;">是否在 OpenAPI 文档中显示，/api/* 默认显示，其他自声明</span>
        // TODO 应该实现常用数据格式快速配置
        // 快速配置参数
        protected $cookie = [],             // <span style="color:#E97230;">cookie 数据</span>
        protected $header = [],             // <span style="color:#E97230;">header 数据</span>
        protected $get = [],                // <span style="color:#E97230;">get 数据</span>

        protected $post = [],               // <span style="color:#E97230;">post 数据</span>
        protected $json = [],               // <span style="color:#E97230;">json 数据</span>
        protected $xml = [],                // <span style="color:#E97230;">xml 数据</span>
        protected $file = [],               // <span style="color:#E97230;">上传文件数据</span>

        protected $requireBody = false,     // <span style="color:#E97230;">body 是否必须</span>
        // 标准方法参数
        protected $tags = [],               // <span style="color:#E97230;">方法分组标签</span>
        protected $summary = '',            // <span style="color:#E97230;">方法简介</span>
        protected $description = '',        // <span style="color:#E97230;">方法详细说明</span>
        protected $externalDocs = [],       // <span style="color:#E97230;">方法外部文档</span>
        protected $operationId = null,      // <span style="color:#E97230;">方法操作 ID</span>
        protected $parameters = [],         // <span style="color:#E97230;">方法参数</span>
        protected $requestBody = [],        // <span style="color:#E97230;">方法请求 Body</span>
        protected $responses = [],          // <span style="color:#E97230;">方法响应示例</span>
        protected $callbacks = [],          // <span style="color:#E97230;"></span>
        protected $deprecated = false,      // <span style="color:#E97230;">方法是否已被弃用</span>
        protected $security = [],           // <span style="color:#E97230;">方法使用的认证方法</span>
        protected $servers = [],            // <span style="color:#E97230;">方法备用服务器地址列表</span>
        protected $extend = [],             // <span style="color:#E97230;">方法扩展选项</span>
        // OpenAPI 公共参数
        protected $g_openapi = '3.0.3',     // <span style="color:#E97230;">OpenAPI 规范版本，设为false则禁用文档</span>
        protected $g_info = [],             // <span style="color:#E97230;">文档信息</span>
        protected $g_servers = [],          // <span style="color:#E97230;">接口服务器列表</span>
        protected $g_components = [],       // <span style="color:#E97230;">公共组件</span>
        protected $g_securitySchemes = [],  // <span style="color:#E97230;">认证方式声明</span>
        protected $g_security = [],         // <span style="color:#E97230;">全局可选认证方式</span>
        protected $g_tags = [],             // <span style="color:#E97230;">Tag 的描述列表</span>
        protected $g_externalDocs = [],     // <span style="color:#E97230;">外部文档列表</span>
        protected $g_extend = [],           // <span style="color:#E97230;">扩展选项</span>
        protected $validator = null         // <span style="color:#E97230;">路由参数自定义验证器</span>
    ) {
        // 路由路径预处理
        $this->path = (string)preg_replace("/^\.\//", '', $this->route);

        // 路由请求方法
        $this->method = [strtoupper($method)];

        // 响应值
        $this->responses = array_replace_recursive(['default' => ['description' => '']], $this->responses);

        /** 全局设置 */
        OpenAPI::setOpenAPIVersion($this->g_openapi);
        OpenAPI::setInfo($this->g_info);
        OpenAPI::setServers($this->g_servers);
        OpenAPI::setComponents($g_components);
        OpenAPI::setSecuritySchemes($this->g_securitySchemes);
        OpenAPI::setSecurity($this->g_security);
        OpenAPI::setTags($this->g_tags);
        OpenAPI::setExternalDocs($this->g_externalDocs);
        OpenAPI::setExtend($this->g_extend);
    }

    /**
     * <h2 style="color:#E97230;">注册路由</h2>
     *
     * @param mixed $callback <span style="color:#E97230;">路由调用方法</span>
     */
    public function add(mixed $callback): RouteObject {
        $callback = RouteClass::convertToCallable($this->path, $callback);

        return RouteClass::add(
            $this->method,
            $this->path,
            function (Request $request, ...$parameters) use ($callback) {
                //  应注意作用域问题！
                $custom_validator = $this->validator;
                $config           = $this->config;

                // 默认验证器
                $verifiedData = Validator::validate($request, $config);

                // 用户自定义验证器
                if (is_callable($custom_validator)) {
                    $verifiedData = $custom_validator($verifiedData);
                }

                // 传递验证后的数据
                $request->verifiedData = $verifiedData;

                return $callback($request, ...$parameters);
            }
        )->middleware($this->middleware);
    }

    /**
     * <h2 style="color:#E97230;">注册到 OpenAPI</h2>
     */
    public function addToOpenAPI() {
        if ($this->openapi || ($this->openapi !== false && str_starts_with($this->path, '/api/'))) {

            // 处理路由路径
            $paths       = (new Std)->parse($this->path)[0];
            $path        = '';
            $path_params = [];
            foreach ($paths as $folder) {
                if (is_array($folder)) {
                    $path_params[$folder[0]] = [$folder[1], 0];
                    $folder                  = "{{$folder[0]}}";
                }
                $path .= "{$folder}";
            }

            // ================================
            // 处理 parameters header cookie get
            $parameters = [];
            $this->prepareParams($this->cookie, 'cookie', $parameters);
            $this->prepareParams($this->header, 'header', $parameters);
            $this->prepareParams($this->get, 'query', $parameters);
            $this->prepareParams($this->parameters, false, $parameters);
            // 处理路径参数
            $path_name_list = [];
            foreach ($path_params as $name => $conf) {
                // 读取出路径参数正则内的注释
                preg_match("/(\(\?#[^(]*(\([^()]*(?R)*\))*[^(]*\))/", $conf[0], $matches);
                // 生成字段描述
                $desc             = count($matches) > 0 ? preg_replace("/(^\(\?#|\)$)/", '', $matches[1]) : '路径参数';
                $path_name_list[] = [
                    'name'        => $name,
                    'in'          => 'path',
                    'required'    => true,
                    'description' => $desc,
                    'schema'      => [
                        'type'    => 'string',
                        'pattern' => "^" . str_replace($matches[1], '', $conf[0]) . "$",
                    ],
                ];

            }
            array_unshift($parameters, ...$path_name_list);

            /** 处理 requestBody */
            $this->prepareBody($this->post);
            $this->prepareBody($this->json, 'json');
            $this->prepareBody($this->xml, 'xml');
            $this->prepareBody($this->file, 'file');


            //读取需要添加到全局 tags 表的 tag
            $tags = [];
            foreach ($this->tags as $tag) {
                if (is_array($tag)) {
                    OpenAPI::addTag($tag);
                    $tags[] = $tag['name'];
                } else {
                    $tags[] = $tag;
                }
            }

            // 生成方法文档数组
            $operation = [
                'tags'        => $tags,
                'summary'     => $this->summary,
                'description' => $this->description,
                'operationId' => $this->operationId,
                'responses'   => $this->responses,
                'deprecated'  => $this->deprecated,
            ];
            count($parameters) > 0 && $operation['parameters'] = $parameters;
            count($this->externalDocs) > 0 && $operation['externalDocs'] = $this->externalDocs;
            count($this->callbacks) > 0 && $operation['callbacks'] = $this->callbacks;
            count($this->servers) > 0 && $operation['servers'] = $this->servers;
            count($this->security) > 0 && $operation['security'] = $this->security;

            if (count($this->requestBody) > 0) {
                $body                     = $this->requestBody;
                $body['required']         = $this->requireBody;
                $operation['requestBody'] = $body;
            }
            $operation = array_replace_recursive($operation, $this->extend);

            $method = strtolower($this->method[0]);

            $this->config = ['path' => $path, 'method' => $method, 'operation' => $operation];

            OpenAPI::addPath([$path => [$method => $operation]]);
        }
    }

    protected function prepareParams($data, $type = false, &$parameters = [],) {
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                if (!isset($item['name'])) {
                    $item['name'] = $key;
                }
                $type && $item['in'] = $type;
            } else {
                $item = ['name' => $item];
                $type && $item['in'] = $type;
            }
            $default      = ['in' => 'query', 'schema' => ['type' => 'string']];
            $item         = array_replace_recursive($default, $item);
            $parameters[] = $item;
        }
    }

    protected function prepareBody($data, $type = 'post',) {
        if (count($data) == 0) return null;
        $properties = [];
        //
        $request_type = match ($type) {
            'file' => 'multipart/form-data',
            'json' => 'application/json',
            'xml' => 'application/xml',
            default => 'application/x-www-form-urlencoded'
        };
        $required     = [];
        foreach ($data as $key => $conf) {
            if (is_array($conf)) {
                if (isset($conf['required'])) {
                    $conf['required'] && $required[] = $key;
                    unset($conf['required']);
                }
                $properties[$key] = $conf;

                // post
                // 携带文件上传字段的话转成 multipart/form-data
                // 因为 webman 框架的 $request->file() 只 支持这种形式的上传
                if (
                    isset($conf['type']) && $conf['type'] == 'file' && $type == 'post'
                    || count($this->file) > 0
                ) {
                    $request_type = 'multipart/form-data';
                }
            } else {
                $properties[$conf] = [
                    'type' => 'string'
                ];
                if ($type == 'file') {
                    $properties[$conf]['type'] = 'file';
                }
            }
        }
        $this->requestBody = array_replace_recursive(
            [
                'content' => [
                    $request_type => [
                        'schema' => [
                            'required'   => $required,
                            'type'       => 'object',
                            'properties' => $properties,
                        ],
                    ]
                ]
            ],
            $this->requestBody
        );

    }
}

