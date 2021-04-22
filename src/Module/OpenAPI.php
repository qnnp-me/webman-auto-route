<?php

namespace WebmanPress\AutoRoute\Module;

class OpenAPI {
    protected static string $openapi      = '3.0.0';
    protected static array  $info         = [];
    protected static array  $paths        = [];
    protected static array  $tags         = [];
    protected static array  $components   = [];
    protected static array  $security     = [];
    protected static array  $servers      = [];
    protected static array  $externalDocs = [];
    protected static array  $extend       = [];

    static function toJson(): bool|string {
        return json_encode(static::toArray());
    }

    static function toArray(): array { return static::generate(); }

    static function generate(): array {
        $info         = array_replace_recursive(
            [
                'title'          => '项目名称',
                'description'    => '项目描述',
                'version'        => '0.0.0',
                'termsOfService' => 'http://localhost/service.html',
                'contact'        => [
                    'name'  => '联系人',
                    'url'   => 'http://localhost/contact.html',
                    'email' => 'example@example.com'
                ],
                'license'        => [
                    'name' => 'API许可',
                    'url'  => 'http://localhost/license.html'
                ],
            ],
            static::$info
        );
        $doc          = [
            'components'   => static::$components,
            'externalDocs' => static::$externalDocs,
            'info'         => $info,
            'openapi'      => static::$openapi,
            'security'     => static::$security,
            'servers'      => static::$servers,
            'tags'         => static::$tags,
        ];
        $doc          = array_replace_recursive($doc, static::$extend);
        $doc['paths'] = static::$paths;

        return $doc;
    }

    static function addPath(array $paths) {
        foreach ($paths as $path => $method_config) {
            !isset(static::$paths[$path]) && static::$paths[$path] = [];
            foreach ($method_config as $method => $_values) {
                static::$paths[$path][$method] = $_values;
            }
        }
    }

    static function addTag(array $tag) {
        foreach (static::$tags as $_tag) {
            if ($_tag['name'] == $tag['name']) return null;
        }
        array_push(static::$tags, $tag);
    }

    static function setOpenAPIVersion(string $version) {
        static::$openapi = $version;
    }

    static function setInfo(array $info) {
        static::$info = array_replace_recursive(static::$info, $info);
    }

    static function setSecurity(array $security) {
        static::$security = array_replace_recursive(static::$security, $security);
    }

    static function setTags(array $tags) {
        static::$tags = array_replace_recursive(static::$tags, $tags);
    }

    static function setExternalDocs(array $externalDocs) {
        static::$externalDocs = array_replace_recursive(static::$externalDocs, $externalDocs);
    }

    public static function setExtend(array $extend): void {
        static::$extend = array_replace_recursive(static::$extend, $extend);
    }

    static function setServers($servers) {
        static::$servers = array_replace_recursive(static::$servers, $servers);
    }

    static function setSecuritySchemes($securitySchemes = []) {
        static::$components = array_replace_recursive(
            static::$components,
            [
                'securitySchemes' => $securitySchemes
            ]
        );
    }

    public static function getComponents(): array {
        return static::$components;
    }

    static function setComponents($components) {
        static::$components = array_replace_recursive(static::$components, $components);
    }
}
