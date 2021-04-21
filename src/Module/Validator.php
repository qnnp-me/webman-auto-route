<?php


namespace WebmanPress\AutoRoute\Module;


use Exception;
use support\Request;

class Validator {
    /**
     * @throws Exception
     */
    static function validate(Request $request, $config) {
        $path      = $config['path'];
        $method    = $config['method'];
        $operation = $config['operation'];

        if (isset($operation['deprecated']) && $operation['deprecated'])
            throw new Exception('此操作已被弃用', 400);

        $security    = isset($operation['security']) ? $operation['security'] : [];
        $parameters  = isset($operation['parameters']) ? $operation['parameters'] : [];
        $requestBody = isset($operation['requestBody']) ? $operation['requestBody'] : [];

        $paths   = [];
        $headers = [];
        $cookies = [];
        $query   = [];

        // 分配 parameters
        foreach ($parameters as $parameter) {
            switch ($parameter['in']) {
                case'path':
                    $paths[$parameter['name']] = $parameters;
                    break;
                case'cookie':
                    $cookies[strtolower($parameter['name'])] = $parameters;
                    break;
                case'header':
                    $headers[strtolower($parameter['name'])] = $parameters;
                    break;
                default:
                    $query[$parameter['name']] = $parameter;
            }
        }

        // 分配 security
        // foreach ($security as $type => $conf) {
        //     switch ($type) {
        //         default:
        //             $headers[$type] = [];
        //     }
        // }

        // 分配 requestBody
        if (isset($requestBody['content']))
            foreach ($requestBody as $type => $conf) {

            }
        if (isset($requestBody['required']) && $requestBody['required'] && !$request->rawBody())
            throw new Exception('body 要求数据', 400);


        // ==============================
        $result = $config;

        return json_decode(json_encode($result));
    }
}