<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#oauth-flow-object 规范文档
 */
class oauthFlow {
  const authorizationUrl = 'authorizationUrl';
  const tokenUrl         = 'tokenUrl';
  const refreshUrl       = 'refreshUrl';
  const scopes           = 'scopes';
}