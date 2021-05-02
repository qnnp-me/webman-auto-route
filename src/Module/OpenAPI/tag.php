<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#tag-object 规范文档
 */
class tag {
  /**
   * <div style="color:#E97230;">string</div>
   */
  const name = 'name';
  /**
   * <div style="color:#E97230;">string</div>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">External Documentation Object</div>
   *
   * @see externalDoc
   */
  const externalDocs = 'externalDocs';
}