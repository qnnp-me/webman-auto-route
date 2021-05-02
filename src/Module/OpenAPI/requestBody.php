<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#request-body-object 规范文档
 */
class requestBody {
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">简短描述，可包含使用示例。 CommonMark语法可用。</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">Map[string, Media Type Object] 必须</div>
   * <pre style="color:#3982F7;">['application/json' => Media Type Object]</pre>
   *
   * @see media
   */
  const content = 'content';
  /**
   * <div style="color:#E97230;">boolean</div>
   */
  const required = 'required';
}