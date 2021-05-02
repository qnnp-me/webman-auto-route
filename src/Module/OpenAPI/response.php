<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#response-object 规范文档
 */
class response {
  /**
   * <div style="color:#E97230;">string 必须</div>
   * <span style="color:#E97230;">返回数据简介，可用 CommonMark 语法。</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">Map[string, Header Object | Reference Object]</div>
   * <pre style="color:#3982F7;">['X-Key' => Header Object]</pre>
   *
   * @see reference
   */
  const headers = 'headers';
  /**
   * <div style="color:#E97230;">Map[string, Media Type Object]</div>
   * <pre style="color:#3982F7;">['application/json' => Media Type Object]</pre>
   *
   * @see media
   */
  const content = 'content';
  /**
   * <div style="color:#E97230;">Map[string, Link Object | Reference Object]</div>
   *
   * @see  link
   * @see  reference
   */
  const links = 'links';
}