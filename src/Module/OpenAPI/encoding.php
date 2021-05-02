<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#encoding-object 规范文档
 */
class encoding {
  /**
   * <div style="color:#E97230;">string</div>
   */
  const contentType = 'contentType';
  /**
   * <div style="color:#E97230;">Map[string, Header Object | Reference Object]</div>
   *
   * @see tag
   * @see reference
   */
  const headers = 'headers';
  /**
   * <div style="color:#E97230;">string</div>
   */
  const style = 'style';
  /**
   * <div style="color:#E97230;">boolean</div>
   * <span style="color:#E97230;"></span>
   */
  const explode = 'explode';
  /**
   * <div style="color:#E97230;">boolean</div>
   * <span style="color:#E97230;">是否允许RFC3986:/?＃[]@!$＆'()*+,;=的保留字符，
   * 不进行百分比编码，默认值为false，如果请求类型不是application/x-www-form-urlencoded，应忽略。</span>
   */
  const allowReserved = 'allowReserved';
}