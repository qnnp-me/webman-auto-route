<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#components-object 规范文档
 */
class components {
  /**
   * <div style="color:#E97230;">Map[string, Schema Object | Reference Object]</div>
   *
   * @see schema
   * @see reference
   */
  const schemas = 'schemas';
  /**
   * <div style="color:#E97230;">Map[string, Response Object | Reference Object]</div>
   *
   * @see response
   * @see reference
   */
  const responses = 'responses';
  /**
   * <div style="color:#E97230;">Map[string, Parameter Object | Reference Object]</div>
   *
   * @see parameter
   * @see reference
   */
  const parameters = 'parameters';
  /**
   * <div style="color:#E97230;">Map[string, Example Object | Reference Object]</div>
   *
   * @see example
   * @see reference
   */
  const examples = 'examples';
  /**
   * <div style="color:#E97230;">Map[string, Request Body Object | Reference Object]</div>
   *
   * @see requestBody
   * @see reference
   */
  const requestBodies = 'requestBodies';
  /**
   * <div style="color:#E97230;">Map[string, Header Object | Reference Object]</div>
   *
   * @see  tag
   * @see  reference
   */
  const headers = 'headers';
  /**
   * <div style="color:#E97230;">Map[string, Security Scheme Object | Reference Object]</div>
   *
   * @see securityScheme
   * @see reference
   */
  const securitySchemes = 'securitySchemes';
  /**
   * <div style="color:#E97230;">Map[string, Link Object | Reference Object]</div>
   *
   * @see  link
   * @see  reference
   */
  const links = 'links';
  /**
   * <div style="color:#E97230;">Map[string, Callback Object | Reference Object]    </div>
   *
   * @see callback
   * @see reference
   */
  const callbacks = 'callbacks';
}