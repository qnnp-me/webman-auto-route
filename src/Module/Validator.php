<?php

namespace WebmanPress\AutoRoute\Module;

use Exception;
use support\Request;

class Validator {
  /**
   * @throws Exception
   */
  static function validate(Request $request, ...$params) {
    return null;
    $config    = $request->route_config;
    $path      = $config['path'];
    $method    = $config['method'];
    $operation = $config['operation'];

    // 校验 deprecated
    // if (isset($operation['deprecated']) && $operation['deprecated'])
    //     throw new Exception('此操作已被弃用', 400);

    $security    = isset($operation['security']) ? $operation['security'] : [];
    $parameters  = isset($operation['parameters']) ? $operation['parameters'] : [];
    $requestBody = isset($operation['requestBody']) ? $operation['requestBody'] : [];  // TODO 应该过滤？

    $components      = OpenAPI::getComponents();
    $securitySchemes = isset($components['securitySchemes']) ? $components['securitySchemes'] : [];

    // TODO 验证信息不应该校验器管理？
    // 分配或者校验 security
    foreach ($security as $name => $conf) {
      if (isset($securitySchemes[$name])) {
        $_security = $securitySchemes[$name];
        switch ($_security['type']) {
          case 'openIdConnect':
            $openIdConnectUrl = $_security['openIdConnectUrl'];
            break;
          case 'oauth2':
            $follows = $_security['follows'];
            break;
          case 'http':
            $scheme = $_security['scheme'];
            break;
          case 'apiKey':
            $name = $_security['name'];
            $in   = $_security['in'];
            $pass = match ($in) {
              'header' => null !== $request->header($name),
              'cookie' => null !== $request->cookie($name),
              'query' => null !== $request->get($name),
              default => false,
            };
            break;
        }
      }
    }

    $paths   = [];
    $headers = [];
    $cookies = [];
    $query   = [];

    // 分配 parameters
    foreach ($parameters as $parameter) {
      switch ($parameter['in']) {
        case'path':
          $paths[$parameter['name']] = $parameter;
          break;
        case'cookie':
          $cookies[strtolower($parameter['name'])] = $parameter;
          break;
        case'header':
          $headers[strtolower($parameter['name'])] = $parameter;
          break;
        default:
          $query[$parameter['name']] = $parameter;
      }
    }

    // 分配 requestBody
    if (isset($requestBody['content']))
      foreach ($requestBody as $type => $conf) {

      }
    if (isset($requestBody['required']) && $requestBody['required'] && !$request->rawBody())
      throw new Exception('request body 不能为空', 400);

    // ==============================
    $result = $config;

    return json_decode(json_encode($result));
  }
}