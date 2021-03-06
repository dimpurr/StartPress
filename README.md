# StartPress
一个可以快速开始新 WordPress 主题创作的空主题

### 特点

* 完善的注释说明
* 仅进行基本文章输出，没有多余的标签、容器和 ID \ Class
* 文章输出默认剥离到 `content.php` ，无内置 `single.php` 和 `page.php`
* 内置了导航栏、侧边栏、语言包的注册函数
* 内置了评论、页码、检查更新、使用统计等常用函数
* 仅内置了 Reset 重置样式表和一个 `#page` 页面容器，无多余样式

### 注意

* 请将 `,'dpt'` 使用编辑器查找替换为 `,'主题的文本域'` ，当然也可以直接使用 dpt
* 若需使用检查更新，请将 `func/info.json` 上传到服务器，并填写正确的版本号、安装包地址，更新时只需更新 `info.json `和安装包
* 若需使用使用统计，请将 `func/theme_tj.php` 上传到服务器并设置数据库和密码

### 授权
* 使用 GNU General Public License(GPL) 继承自 WordPress
* 自由分发，不强制署名
* 如果愿意，可以在衍生主题的页脚或发布页注明 'Based on <a href="https://github.com/dimpurr/StartPress">StartPress</a>'