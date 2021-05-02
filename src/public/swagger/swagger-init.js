/**
 * This file is part of webman-auto-route.
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    qnnp<qnnp@qnnp.me>
 * @copyright qnnp<qnnp@qnnp.me>
 * @link      https://main.qnnp.me
 * @license   https://opensource.org/licenses/MIT MIT License
 */

window.onload = function () {
    // Begin OpenAPI UI call region
    const ui  = SwaggerUIBundle(
        {
            // displayRequestDuration: 60000,  // 请求超时时间？，毫秒
            // maxDisplayedTags    : 0,      // 显示标签组数量，0全部
            // requestSnippets     : {},     //
            // urls                : [
            //     {
            //         name: window.location.protocol + "//" + window.location.host + "/openapi.json",
            //         url : window.location.protocol + "//" + window.location.host + "/openapi.json"
            //     }
            // ],
            url         : window.location.protocol + "//" + window.location.host + "/openapi.json",
            dom_id      : '#swagger-ui',
            deepLinking : true,   // 链接自动打开 Tag
            docExpansion: 'list', // 默认标签展示方式，list|full|none
            // filter              : true,   // 标签筛选器
            tryItOutEnabled     : true,   // 测试按钮默认启用
            showExtensions      : true,   //
            showCommonExtensions: true,   //
            persistAuthorization: true,   // 保存验证信息
            syntaxHighlight     : {       // 代码高亮主题
                active: true,
                theme : 'obsidian'
            },
            tagsSorter(a, b) {              // 标签组排序
                // 将默认 Tag 排到最后
                if (a === 'default') {
                    return 1;
                }
                if (b === 'default') {
                    return -1;
                }
                // 按照中文排序
                return a.localeCompare(b, "zh-hans");
            },
            responseInterceptor(res) {  // 请求响应回调
                return res;
            },
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl,
            ],
            layout : "StandaloneLayout"
        });
    // End OpenAPI UI call region
    window.ui = ui;
};