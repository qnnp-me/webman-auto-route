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
 * @link https://swagger.io/specification/#parameter-object 规范文档
 */
class parameter {
  /**
   * <div style="color:#E97230;">string 必须</div>
   * <span style="color:#E97230;">参数的名称，区分大小写</span>
   */
  const name = 'name';
  /**
   * <div style="color:#E97230;">string 必须</div>
   * <span style="color:#E97230;">参数位置，可能是（query, header, path, cookie）</span>
   */
  const in = 'in';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">参数的简要说明，可包含使用示例，可用CommonMark语法。</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">boolean</div>
   * <span style="color:#E97230;">参数是否必须，如果参数位置是 path 则此项必为 true ，默认 false 。</span>
   */
  const required = 'required';
  /**
   * <div style="color:#E97230;">boolean</div>
   * <span style="color:#E97230;">参数是否必须，如果参数位置是 path 则此项必为 true ，默认 false 。</span>
   */
  const deprecated = 'deprecated';
  /**
   * <div style="color:#E97230;">Schema Object | Reference Object</div>
   * <span style="color:#E97230;">定义参数类型模式。</span>
   *
   * @see schema
   * @see reference
   */
  const schema = 'schema';
  /**
   * <div style="color:#E97230;">Map[string, Media Type Object]</div>
   * <span style="color:#E97230;">只能包含一条</span>
   * <span style="color:#E97230;"></span>
   */
  const content = 'content';
  /**
   * <div style="color:#E97230;">string</div>
   *
   * @see style
   */
  const style = 'style';
  // TODO
  const explode       = 'explode';
  const allowReserved = 'allowReserved';
  const example       = 'example';
  const examples      = 'examples';

}