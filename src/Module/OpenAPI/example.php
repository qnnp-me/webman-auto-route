<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#example-object 规范文档
 */
class example {
  /**
   * <div style="color:#E97230;">string</div>
   */
  const summary = 'summary';
  /**
   * <div style="color:#E97230;">string</div>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">Any</div>
   */
  const value = 'value';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">示例 URL ，和 value 互斥。</span>
   */
  const externalValue = 'externalValue';
}