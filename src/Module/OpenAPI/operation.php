<?php


namespace WebmanPress\AutoRoute\Module\OpenAPI;

/**
 * @link https://swagger.io/specification/#operation-object 规范文档
 */
class operation {
  /**
   * <div style="color:#E97230;">[string]</div>
   * <span style="color:#E97230;">标签分组列表</span>
   */
  const tags = 'tags';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">操作简介</span>
   */
  const summary = 'summary';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">详细介绍，可用CommonMark语法</span>
   */
  const description = 'description';
  /**
   * <div style="color:#E97230;">External Documentation Object</div>
   * <span style="color:#E97230;">外部文档</span>
   *
   * @see externalDoc
   */
  const externalDocs = 'externalDocs';
  /**
   * <div style="color:#E97230;">string</div>
   * <span style="color:#E97230;">唯一 ID，必须唯一，区分大小写。工具和库可以使用operationId标识一个操作，建议遵循命名约定。</span>
   */
  const operationId = 'operationId';
  /**
   * <div style="color:#E97230;">[Parameter Object | Reference Object]</div>
   * <span style="color:#E97230;">参数列表，不可删除上级定义的参数仅可覆盖</span>
   *
   * @see parameter
   * @see reference
   */
  const parameters = 'parameters';
  /**
   * <div style="color:#E97230;">Request Body Object | Reference Object</div>
   * <span style="color:#E97230;">此操作可发送的数据正文 Body</span>
   *
   * @see requestBody
   * @see reference
   */
  const requestBody = 'requestBody';
  /**
   * <div style="color:#E97230;">Responses Object 必须</div>
   * <span style="color:#E97230;">可能的响应列表。规范必须，但本库以给出默认值、使用时可不填。</span>
   *
   * @see response
   */
  const responses = 'responses';
  /**
   * <div style="color:#E97230;">Map[string, Callback Object | Reference Object]</div>
   *
   * @see callback
   * @see reference
   */
  const callbacks = 'callbacks';
  /**
   * <div style="color:#E97230;">boolean</div>
   * <span style="color:#E97230;">声明此方法已被弃用，默认 false</span>
   */
  const deprecated = 'deprecated';
  /**
   * <div style="color:#E97230;">[Security Requirement Object]</div>
   * <span style="color:#E97230;">将覆盖全局声明</span>
   *
   * @see securityRequirement
   */
  const security = 'security';
  /**
   * <div style="color:#E97230;">[Server Object]</div>
   * <span style="color:#E97230;">备用服务器列表，将覆盖全局声明</span>
   *
   * @see server
   */
  const servers = 'servers';
}