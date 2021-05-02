<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#oauth-flows-object 规范文档
 */
class oauthFlows {
  const implicit          = 'implicit';
  const password          = 'password';
  const clientCredentials = 'clientCredentials';
  const authorizationCode = 'authorizationCode';
}