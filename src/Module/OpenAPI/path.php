<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#path-item-object 规范文档
 */
class path {
  /**
   * <div style="color:#E97230;">string</div>
   */
  const ref = '$ref';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">路由简介</span>
   */
  const summary = 'summary';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">路由详细说明</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const get = 'get';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const put = 'put';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const post = 'post';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const delete = 'delete';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const options = 'options';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const head = 'head';
  /**
   * <div style="color:#E97230;">Operation Object</div>
   *
   * @see operation
   */
  const trace = 'trace';
  /**
   * <div style="color:#E97230;">[Server Object]</div>
   * <span style="color:#E97230;">此路由所有操作的备用服务器。</span>
   *
   * @see server
   */
  const servers = 'servers';
  /**
   * <div style="color:#E97230;">[Parameter Object | Reference Object]</div>
   * <span style="color:#E97230;">此路由下所有操作通用参数，不可删除仅可覆盖</span>
   *
   * @see parameter
   * @see reference
   */
  const parameters = 'parameters';
}