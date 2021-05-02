<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#security-scheme-object 规范文档
 */
class securityScheme {
  const type             = 'type';
  const description      = 'description';
  const name             = 'name';
  const in               = 'in';
  const scheme           = 'scheme';
  const bearerFormat     = 'bearerFormat';
  const flows            = 'flows';
  const openIdConnectUrl = 'openIdConnectUrl';
}