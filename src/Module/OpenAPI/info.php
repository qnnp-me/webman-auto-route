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
 * @link https://swagger.io/specification/#info-object 规范文档
 */
class info {
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">项目名称</span>
   */
  const title = 'title';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">项目描述</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">项目服务条款URL</span>
   */
  const termsOfService = 'termsOfService';
  /**
   * <div style="color:#E97230;">Contact Object</div>
   * <span style="color:#E97230;">项目联系信息</span>
   *
   * @see contact
   */
  const contact = 'contact';
  /**
   * <div style="color:#E97230;">License Object</div>
   * <span style="color:#E97230;">项目许可信息</span>
   *
   * @see license
   */
  const license = 'license';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">项目版本</span>
   */
  const version = 'version';
}