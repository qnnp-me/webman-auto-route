## [__在线文档 (Link)__](https://thoughts.aliyun.com/workspaces/60803fedd61dc1001a37cee9)

[__Webman Auto Route__](https://packagist.org/packages/qnnp/webman-auto-route) 是一个基于 PHP8 注解开发的一个
[__Webman__](https://www.workerman.net/doc/webman) 扩展组件。

***

## Webman Auto Route 可以做什么

- 为 Webman 项目的控制器提供注解路由功能

- 保留 Webman 路由中间件能力

- 根据注解信息实时生成 [__OpenAPI 3.0__](https://swagger.io/specification/) 文档

- 提供 OpenAPI 规范的输入提示能力

- 自带 [__Swagger UI__](https://swagger.io/tools/swagger-ui/) 提供接口自测、对接

- 根据注解信息自动验证过滤输入信息 ( 1.0.0开始提供 )

***

## 快速开始

`composer require qnnp/webman-auto-route`

```php
<?php #config/route.php

use Webman\Route;
use WebmanPress\AutoRoute\Module\AutoRoute;

// 直接使用
AutoRoute::load();


// 加载自定义组件
AutoRoute::load(
    // 注解路由默认会扫描 /app 下的所有PHP文件
    // 如果需要扫描其他文件夹或者组件的路由可以这样设置
    [
        [
            'WebmanPress\Controller',   // 命名空间根路径
            WP_LIB_PATH . '/Controller' // 对应文件夹路径
        ],
    ],
    true // false 禁用 OpenAPI 文档
    
    // 注意：组件扫描文件时会自动跳过 . 开头的文件文件夹和 model view 文件夹
);

/**
 * 因注解路由可注解加载中间件
 * 防止需要中间件的被直接加载
 * 安全起见关闭默认路由
 * 需要自定义路由组或者其他自
 * 定义路由可按照 Webman 文
 * 档正常自行配置
 */
Route::disableDefaultRoute();
```

***

## 路由示例

```php
<?php

namespace app\controller;

use support\Request;
use support\Response;
use Throwable;
use WebmanPress\AutoRoute\Attributes\Route;
use WebmanPress\AutoRoute\Module\OpenAPI\contact;
use WebmanPress\AutoRoute\Module\OpenAPI\info;
use WebmanPress\AutoRoute\Module\OpenAPI\license;
use WebmanPress\AutoRoute\Module\OpenAPI\media;
use WebmanPress\AutoRoute\Module\OpenAPI\requestBody;
use WebmanPress\AutoRoute\Module\OpenAPI\response as res;
use WebmanPress\AutoRoute\Module\OpenAPI\schema;

class Index {

  #[
    Route('test1',
      Info: [  // 大写字母开头的，或者 g_* 开头的参数一般为 OpenAPI 文档根节
               // 点参数，全项目只需要声明一次，多次声明会被自动覆盖
        info::title          => 'WebmanPress', // 对应的 OpenAPI 节点信息可以使用对应的对象提示
        info::description    => '项目描述',
        info::version        => '0.0.1',
        info::termsOfService => 'http://localhost/service.html',
        info::contact        => [
          contact::name  => 'qnnp',
          contact::url   => 'http://localhost/contact.html',
          contact::email => 'qnnp@qnnp.me'
        ],
        info::license        => [
          license::name => 'MIT License',
          license::url  => 'https://opensource.org/licenses/MIT'
        ],

      ],
      Security: [ // 全局认证声明
        [
          'token' => []
        ]
      ],
      SecuritySchemes: [ // 此项为 components -> securitySchemes 节点参数
        'token' => [
          'type' => 'apiKey',
          'name' => 'Authorization',
          'in'   => 'header',
        ]
      ],
    ),
    Route('/the-test', 'post',
      openapi: true,  // /api/* 下的会自动加进文档、非 /api/* 路径下的需要加入文档可将此项设为 true 
      post: [
        'key' => [
          schema::required => true
        ]
      ],
      requestBody: [
        requestBody::required    => true,
        requestBody::content     => [
          'application/x-www-form-urlencoded' => [
            media::schema => [
              schema::type       => 'object',
              schema::properties => [
                'key' => [
                  schema::type => 'integer'
                ]
              ]
            ]
          ]
        ],
        requestBody::description => 'Body 描述',
      ],
      responses: [
        200 => [
          res::description => 'asd',
          res::content     => [
            'application/json' => [
              media::schema  => [
                schema::properties => [
                  'key' => [
                    schema::type => 'string'
                  ]
                ]
              ],
              media::example => [
                'key' => 'value'
              ],
            ]
          ],
        ]
      ]
    )
  ]
  public function test(
    Request $request
  ): Response {
    return json(['code' => 200, 'message' => 'success', 'data' => 'Hello !']);
  }
}


```

[comment]: <> (Swagger 效果)

[comment]: <> (![]&#40;https://tcs-devops.aliyuncs.com/storage/112416531c7cd9d41915d978281c6f715881?Signature=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJBcHBJRCI6IjVlODQ0MTNlZTEwZjY0NDE0NzZlNzI0YyIsIl9hcHBJZCI6IjVlODQ0MTNlZTEwZjY0NDE0NzZlNzI0YyIsIl9vcmdhbml6YXRpb25JZCI6IiIsImV4cCI6MTYyMDU1MDE5NywiaWF0IjoxNjE5OTQ1Mzk3LCJyZXNvdXJjZSI6Ii9zdG9yYWdlLzExMjQxNjUzMWM3Y2Q5ZDQxOTE1ZDk3ODI4MWM2ZjcxNTg4MSJ9.zM3hbllGTcpj4men06mNBGCur_o1LNudoJvjhu8nZvQ&download=image.png ""&#41;)

***

## OpenAPI 文档示例

```json
{
  "components": {
    "securitySchemes": []
  },
  "externalDocs": [],
  "info": {
    "title": "项目名称",
    "description": "项目描述",
    "version": "0.0.0",
    "termsOfService": "http://localhost/service.html",
    "contact": {
      "name": "联系人",
      "url": "http://localhost/contact.html",
      "email": "example@example.com"
    },
    "license": {
      "name": "API许可",
      "url": "http://localhost/license.html"
    }
  },
  "openapi": "3.0.3",
  "security": [],
  "servers": [],
  "tags": [],
  "paths": {
    "/api/example/test": {
      "get": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "post": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "put": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "patch": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "delete": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "head": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "options": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      }
    },
    "/test1": {
      "get": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false,
        "requestBody": {
          "content": {
            "multipart/form-data": {
              "schema": {
                "required": [
                  "field2"
                ],
                "type": "object",
                "properties": {
                  "file": {
                    "type": "file"
                  },
                  "field1": {
                    "type": "integer"
                  },
                  "field2": {
                    "type": "boolean"
                  }
                }
              }
            },
            "application/json": {
              "schema": {
                "required": [],
                "type": "object",
                "properties": {
                  "field1": {
                    "type": "string"
                  },
                  "field2": {
                    "type": "string"
                  }
                }
              }
            }
          },
          "required": false
        }
      }
    },
    "/api/wp/v1/options": {
      "get": {
        "tags": [
          "系统"
        ],
        "summary": "获取系统选项列表",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      }
    },
    "/api/wp/v1/users": {
      "get": {
        "tags": [
          "用户"
        ],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false,
        "parameters": [
          {
            "in": "query",
            "schema": {
              "type": "string",
              "enum": [
                "status",
                "last_active_time",
                "created_at"
              ]
            },
            "name": "orderBy"
          },
          {
            "in": "query",
            "schema": {
              "type": "string",
              "enum": [
                "asc",
                "desc"
              ]
            },
            "default": "desc",
            "name": "order"
          },
          {
            "in": "query",
            "schema": {
              "type": "integer"
            },
            "default": 1,
            "name": "page"
          },
          {
            "in": "query",
            "schema": {
              "type": "string"
            },
            "default": 10,
            "name": "limit"
          }
        ]
      }
    },
    "/api/wp/v1/users/me": {
      "get": {
        "tags": [
          "用户"
        ],
        "summary": "获取当前用户信息",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      },
      "patch": {
        "tags": [
          "用户"
        ],
        "summary": "修改当前用户信息",
        "description": "详细说明",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false,
        "requestBody": {
          "content": {
            "application/x-www-form-urlencoded": {
              "schema": {
                "required": [],
                "type": "object",
                "properties": {
                  "username": {
                    "type": "string"
                  },
                  "email": {
                    "type": "string"
                  },
                  "email_code": {
                    "type": "string"
                  },
                  "phone": {
                    "type": "string"
                  },
                  "phone_code": {
                    "type": "string"
                  },
                  "password": {
                    "type": "string"
                  },
                  "password_confirmation": {
                    "type": "string"
                  },
                  "salt": {
                    "type": "string"
                  }
                }
              }
            }
          },
          "required": false
        }
      }
    },
    "/api/wp/v1/users/token": {
      "post": {
        "tags": [
          "用户"
        ],
        "summary": "创建用户认证 Token",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false,
        "requestBody": {
          "content": {
            "application/x-www-form-urlencoded": {
              "schema": {
                "required": [
                  "identity",
                  "password"
                ],
                "type": "object",
                "properties": {
                  "identity": {
                    "type": "string"
                  },
                  "password": {
                    "type": "string"
                  },
                  "ttl": {
                    "type": "integer"
                  }
                }
              }
            }
          },
          "required": false
        }
      },
      "get": {
        "tags": [
          "用户"
        ],
        "summary": "验证用户 Token 有效",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false
      }
    },
    "/api/wp/v1/users/{user_ID}": {
      "get": {
        "tags": [],
        "summary": "",
        "description": "",
        "operationId": null,
        "responses": {
          "default": {
            "description": ""
          }
        },
        "deprecated": false,
        "parameters": [
          {
            "name": "user_ID",
            "in": "path",
            "required": true,
            "description": "用户ID",
            "schema": {
              "type": "string",
              "pattern": "^\\w+$"
            }
          }
        ]
      }
    }
  }
}

```
