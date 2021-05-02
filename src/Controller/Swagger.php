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

namespace WebmanPress\AutoRoute\Controller;

use support\Response;
use WebmanPress\AutoRoute\Attributes\Route;
use WebmanPress\AutoRoute\Module\OpenAPI;

class Swagger {

  #[
    Route('/swagger{slash:[/]?}'),
    Route('/swagger/{all:.+}'),
  ]
  public function getStaticFiles(
    $request,
    $path = null,
  ): Response {
    if (empty($path) || $path == '/') $path = 'index.html';
    $custom_file  = realpath(dirname(__DIR__) . '/public/swagger/' . $path);
    $swagger_file = realpath(base_path() . '/vendor/swagger-api/swagger-ui/dist/' . $path);
    if (is_file($custom_file)) {
      return response('')->file($custom_file);
    } elseif (is_file($swagger_file)) {
      return response('')->file($swagger_file);
    }

    return response('<h1>404</h1>')->withStatus(404);
  }

  #[Route('/openapi.json')]
  public function getDoc(): Response {
    return json(OpenAPI::generate());
  }

}