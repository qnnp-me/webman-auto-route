<?php
/**
 * This file is part of webman-auto-route.
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    qnnp<qnnp@qnnp.me>
 * @copyright qnnp<qnnp@qnnp.me>
 * @link      https://main.qnnp.me
 * @license   https://opensource.org/licenses/MIT MIT License
 */

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