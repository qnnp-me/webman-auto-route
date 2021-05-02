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
 * @link https://swagger.io/specification/#media-type-object 规范文档
 */
class media {
  /**
   * <div style="color:#E97230;">Schema Object | Reference Object</div>
   *
   * @see schema
   * @see reference
   */
  const schema = 'schema';
  /**
   * <div style="color:#E97230;">Any</div>
   */
  const example = 'example';
  /**
   * <div style="color:#E97230;">Map[ string, Example Object | Reference Object]</div>
   *
   * @see example
   * @see reference
   */
  const examples = 'examples';
  /**
   * <div style="color:#E97230;">Map[string, Encoding Object]</div>
   *
   * @see encoding
   */
  const encoding = 'encoding';
}