<?php

namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#server-object 规范文档
 */
class server {
  /**
   * <div style="color:#E97230;">string 必须</div>
   * <span style="color:#E97230;">目标服务器 URL</span>
   */
  const url = 'url';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">服务器描述，可用 CommonMark 语法</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">Map[ string, Server Variable Object ]</div>
   * <span style="color:#E97230;">变量名与值之间的映射。用于替换服务器的 URL 模板。</span>
   *
   * @see serverVariable
   */
  const variables = 'variables';
}