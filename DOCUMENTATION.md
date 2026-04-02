# 📚 Default-Ultra 主题技术文档

> **版本：** 2.10
> **作者：** 多仔
> **主页：** https://www.duox.dev
> **适用平台：** Typecho v1.3.0+

---

## 目录

1. [项目概述](#1-项目概述)
2. [文件结构](#2-文件结构)
3. [核心文件详解](#3-核心文件详解)
   - [functions.php - 核心函数库](#31-functionsphp---核心函数库)
   - [header.php - 页面头部](#32-headerphp---页面头部)
   - [footer.php - 页面底部](#33-footerphp---页面底部)
   - [index.php - 首页模板](#34-indexphp---首页模板)
   - [post.php - 文章页模板](#35-postphp---文章页模板)
   - [page.php - 独立页面模板](#36-pagephp---独立页面模板)
   - [archive.php - 归档页模板](#37-archivephp---归档页模板)
   - [comments.php - 评论区模板](#38-commentsphp---评论区模板)
   - [sidebar.php - 侧边栏模板](#39-sidebarphp---侧边栏模板)
   - [timeline.php - 时间轴模板](#310-timelinephp---时间轴模板)
   - [404.php - 错误页模板](#311-404php---错误页模板)
4. [样式系统](#4-样式系统)
5. [JavaScript 功能](#5-javascript-功能)
6. [配置选项](#6-配置选项)
7. [插件兼容性](#7-插件兼容性)

---

## 1. 项目概述

**default-ultra** 是一款基于 Typecho 原生默认主题深度优化的博客主题，采用现代化的设计理念和丰富的功能特性。主题遵循 PHP 8.x 编码规范，充分利用 Typecho 原生函数以优化性能。

### 主要特性

- 🎨 **多主题模式**：支持亮色/深色/护眼/跟随系统四种模式
- ⚡ **PJAX 无刷新**：全站 PJAX 支持，提升用户体验
- 📖 **TOC 目录**：自动生成文章目录，支持滚动高亮
- 🖼️ **图片优化**：懒加载、灯箱效果、防盗链处理
- 📊 **数据统计**：文章字数、阅读时长、阅读量统计
- 💬 **评论增强**：博主标识、IP 归属地显示
- 📱 **响应式设计**：完美适配各种设备尺寸

---

## 2. 文件结构

```
default-ultra/
├── index.php          # 主题入口文件 & 首页模板
├── functions.php      # 核心函数库
├── header.php         # 页面头部模板
├── footer.php         # 页面底部模板
├── post.php           # 文章详情页模板
├── page.php           # 独立页面模板
├── archive.php        # 归档/分类/标签页模板
├── comments.php       # 评论区模板
├── sidebar.php        # 侧边栏模板
├── timeline.php       # 时间轴独立页面模板
├── 404.php            # 404 错误页模板
├── screenshot.png     # 主题预览图
├── css/
│   ├── style.css      # 主样式文件（开发版）
│   ├── style.min.css  # 主样式文件（压缩版）
│   ├── grid.min.css   # 栅格布局系统
│   └── normalize.min.css # CSS 重置
└── images/
    ├── favicon.ico    # 网站图标
    ├── icon-search.png    # 搜索图标
    └── icon-search@2x.png # 搜索图标（高清）
```

---

## 3. 核心文件详解

### 3.1 functions.php - 核心函数库

[`functions.php`](functions.php) 是主题的核心功能文件，包含所有自定义函数和主题配置面板。

#### 3.1.1 主题配置函数 [`themeConfig()`](functions.php:15)

```php
function themeConfig($form)
```

**功能说明：** 定义主题后台配置面板的所有选项。

**配置分组：**

| 分组 | 配置项 | 说明 |
|------|--------|------|
| **基础设置** | `pjaxStatus` | 是否启用全站 PJAX |
| | `faviconUrl` | favicon 图标路径 |
| | `footerText` | 版权信息 |
| | `analyticsCode` | 网站统计代码 |
| **主题模式** | `themeModeSelectStatus` | 是否启用主题模式切换 |
| | `defaultThemeMode` | 默认外观（auto/light/dark/read） |
| **顶部菜单** | `menuBlock` | 菜单显示内容（分类/独立页面） |
| **侧边栏** | `sidebarStatus` | 是否启用侧边栏 |
| | `sidebarBlock` | 侧边栏显示内容 |
| | `sidebarStickyStatus` | 是否启用粘性布局 |
| **文章设置** | `weservStatus` | 绕过图片防盗链 |
| | `imageLazyloadStatus` | 图片懒加载 |
| | `imageLightBoxStatus` | 图片灯箱 |
| | `postWordCountVisibleStatus` | 显示文章字数 |
| | `postReadingTimeVisibleStatus` | 显示阅读时长 |
| | `readingSpeed` | 默认阅读速度（字/分钟） |
| | `postViewVisibleStatus` | 显示阅读数 |
| | `randMinPostView` / `randMaxPostView` | 随机阅读数范围 |
| | `elinkTargetBlankStatus` | 外链新窗口打开 |
| | `statementStatus` / `statementText` | 文章声明 |
| **评论设置** | `commentAuthorIp2RegionStatus` | 显示 IP 归属地 |
| **悬浮工具** | `tocMinitoolStatus` | TOC 目录按钮 |
| | `tocDefaultVisibleStatus` | 默认打开 TOC 面板 |
| | `tocDefaultExpandedStatus` | 默认展开 TOC 列表 |
| | `themeModeMinitoolStatus` | 主题模式切换按钮 |
| | `topMinitoolStatus` | 返回顶部按钮 |
| | `playbackMinitoolStatus` | 放映模式按钮 |

#### 3.1.2 文章阅读数统计 [`postView()`](functions.php:440)

```php
function postView($archive)
```

**功能说明：** 统计并返回文章阅读数。

**实现逻辑：**
1. 检查数据库是否存在 `views` 字段，不存在则自动创建
2. 首次访问时在配置的范围内随机生成初始阅读数
3. 在文章详情页（`is('single')`）时自动 +1

**数据库操作：**
```php
// 创建字段（MySQL）
ALTER TABLE `typecho_contents` ADD `views` INT(10) DEFAULT 0;

// 更新阅读数
$db->query($db->update('table.contents')
    ->rows(array('views' => (int) $exist + 1))
    ->where('cid = ?', $cid));
```

#### 3.1.3 文章字数统计 [`postWordCount()`](functions.php:483)

```php
function postWordCount($archive)
```

**功能说明：** 统计文章字数，支持中英文混合内容。

**实现逻辑：**
1. 获取文章原始内容
2. 使用正则表达式移除 Markdown 标记
3. 按规则计数：
   - 单个中文字符算 1 字
   - 连续英文/数字序列算 1 字
   - 中文标点算 1 字
4. 向上取整到 10 的倍数

**Markdown 清理规则：**
```php
$rules = [
    '/<!--markdown-->/' => '',           // Markdown 标记
    '/^#{1,6}\s+/m' => '',               // 标题
    '/(\*{1,2}|_{1,2})/' => '',          // 加粗/斜体
    '/\[([^\]]+)\]\([^)]+\)/' => '$1',   // 链接
    '/!\[([^\]]*)\]\([^)]+\)/' => '$1',  // 图片
    '/```.*?\R/' => '',                  // 代码块开始
    '/\R```/' => '',                     // 代码块结束
    '/`/' => '',                         // 行内代码
    // ... 更多规则
];
```

#### 3.1.4 阅读时长计算 [`postReadingTime()`](functions.php:554)

```php
function postReadingTime($archive)
```

**功能说明：** 根据文章字数和阅读速度计算预计阅读时长（分钟）。

**计算公式：**
```php
return ceil($wordCount / $readingSpeed);
```

#### 3.1.5 统计函数

| 函数名 | 功能 | 代码位置 |
|--------|------|----------|
| [`postTotalCount()`](functions.php:567) | 全站文章总数 | Line 567 |
| [`commentTotalCount()`](functions.php:576) | 全站评论总数 | Line 576 |
| [`categoryTotalCount()`](functions.php:585) | 全站分类总数 | Line 585 |
| [`tagTotalCount()`](functions.php:594) | 全站合集总数 | Line 594 |
| [`postViewTotalCount()`](functions.php:603) | 全站阅读总数 | Line 603 |

#### 3.1.6 随机文章小工具 [`Widget_Post_rand`](functions.php:612)

```php
class Widget_Post_rand extends Widget_Abstract_Contents
```

**功能说明：** 自定义 Widget 类，用于获取随机推荐文章。

**数据库兼容：**
- MySQL/MariaDB: 使用 `RAND()` 函数
- PostgreSQL/SQLite: 使用 `RANDOM()` 函数

#### 3.1.7 首页过滤与 description 渲染

- [`Widget_Post_Index_Filtered`](functions.php) 在查询阶段过滤未登录用户不可见的私有分类文章，避免首页分页取到的整页文章都在模板中被 `continue` 跳过，导致访客首页空白。
- [`renderMarkdownText()`](functions.php) 负责将 Markdown 文本转成 HTML，并复用 [`parseContent()`](functions.php) 继续处理图片懒加载、灯箱与防盗链。
- [`renderPostDescription()`](functions.php) 用于渲染文章自定义字段 `description`。
- [`renderSiteDescription()`](functions.php) 用于渲染站点描述。

#### 3.1.8 文章内容解析 [`parseContent()`](functions.php:770)

```php
function parseContent($content)
```

**功能说明：** 处理 HTML 内容中的图片标签。

**处理逻辑：**
1. **图片懒加载**：将 `src` 替换为默认占位图，真实 URL 放入 `data-original`
2. **防盗链处理**：通过 weserv 服务代理外链图片
3. **灯箱效果**：用 `<a>` 标签包裹图片，添加 `data-fancybox` 属性

**典型使用场景：**
- 文章正文渲染后处理
- 自定义 `description` Markdown 转 HTML 后的图片处理
- 站点描述 Markdown 转 HTML 后的图片处理

---

### 3.2 header.php - 页面头部

[`header.php`](header.php) 定义了网站的头部区域，包括 HTML 元信息、导航栏、站点描述渲染和主题模式初始化。

#### 3.2.1 文件结构

```php
<!doctype html>
<html lang="zh-CN">
<head>
    // 元信息、样式表、favicon
</head>
<body theme-mode="">
    // 主题模式初始化脚本
    <header id="header">
        // 站点名称、搜索框、主题选择器、导航菜单
    </header>
    <div id="body">
        // 主内容区域开始
```

#### 3.2.2 关键功能

**标题生成：**
```php
<?php $this->archiveTitle([
    'category' => '分类 %s 下的文章',
    'search'   => '包含关键字 %s 的文章',
    'tag'      => '合集 %s 下的文章',
    'author'   => '%s 发布的文章'
], '', ' - '); ?><?php $this->options->title(); ?>
```

**主题模式初始化（防止闪烁）：**
```javascript
(function() {
    const saved = localStorage.getItem('theme-mode');
    const defaultMode = '<?php echo $this->options->defaultThemeMode ?>';
    let mode = saved || defaultMode;
    if (mode === 'auto') {
        const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        mode = isDark ? 'dark' : 'light';
    }
    document.body.setAttribute('theme-mode', mode);
})();
```

**站点描述渲染：**
```php
<p class="description"><?php echo renderSiteDescription($this->options->description); ?></p>
```

- 支持在后台站点描述中直接编写 Markdown
- 渲染完成后继续复用主题图片处理链路

**导航菜单：**
```php
<?php if (!empty($this->options->menuBlock) && in_array('ShowCategory', $this->options->menuBlock)): ?>
    // 显示分类
<?php endif; ?>
<?php if (!empty($this->options->menuBlock) && in_array('ShowPage', $this->options->menuBlock)): ?>
    // 显示独立页面
<?php endif; ?>
```

---

### 3.3 footer.php - 页面底部

[`footer.php`](footer.php) 包含页面底部区域、悬浮工具栏、TOC 面板和所有 JavaScript 功能。

#### 3.3.1 悬浮工具栏

```html
<div class="minitool-group">
    <!-- 放映模式按钮 -->
    <button class="vertical-btn playback-minitool">...</button>
    <!-- TOC 目录按钮 -->
    <button class="vertical-btn toc-minitool">...</button>
    <!-- 主题模式切换按钮 -->
    <button class="vertical-btn themeMode-minitool">...</button>
    <!-- 返回顶部按钮 -->
    <button class="vertical-btn top-minitool">...</button>
</div>
```

#### 3.3.2 外部资源加载

| 资源 | 用途 | 条件 |
|------|------|------|
| jQuery 3.6.0 | 基础库 | 始终加载 |
| KaTeX | 数学公式渲染 | 始终加载 |
| Highlight.js | 代码高亮 | 始终加载 |
| jquery.pjax | PJAX 功能 | `pjaxStatus == 'yes'` |
| NProgress | 加载进度条 | `pjaxStatus == 'yes'` |
| FancyBox | 图片灯箱 | `imageLightBoxStatus == 'yes'` |
| jquery.lazyload | 图片懒加载 | `imageLazyloadStatus == 'yes'` |

#### 3.3.3 核心 JavaScript 功能

**主题模式切换：**
```javascript
function setBodyThemeMode(themeMode) {
    $body.attr('theme-mode', themeMode);
    // 同步切换代码高亮主题
    $highlightThemeCss.attr('href', themeMode === 'dark' ? 
        highlightDarkThemeCss : highlightLightThemeCss);
}
```

**TOC 目录功能：**
- [`initToc()`](footer.php:164) - 初始化目录结构
- [`highlightToc()`](footer.php:286) - 滚动高亮当前章节
- [`toggleToc()`](footer.php:348) - 打开/关闭目录面板

**PJAX 实现：**
```javascript
$(document).pjax('a[href^="..."]:not(a[target="_blank"], a[no-pjax])', {
    container: '#main',
    fragment: '#main',
    timeout: 7000
})
.on('pjax:send', function() { NProgress.start(); })
.on('pjax:complete', function() { initMain(); })
.on('pjax:end', function() { NProgress.done(); });
```

---

### 3.4 index.php - 首页模板

[`index.php`](index.php) 是主题入口文件，展示首页文章列表。

#### 3.4.1 首页文章查询

```php
<?php $this->widget('Widget_Post_Index_Filtered@index', 'pageSize=' . $this->options->pageSize)->to($indexPosts); ?>
```

**说明：**
- 首页不再直接使用当前归档对象循环输出
- 改为通过 [`Widget_Post_Index_Filtered`](functions.php) 在查询阶段过滤私有分类文章
- 这样可避免未登录用户遇到“本页取出的文章全部被模板跳过”导致的空白首页问题

#### 3.4.2 列表摘要策略

```php
$description = getPostDescription($indexPosts);
if ($description) {
    echo renderPostDescription($indexPosts);
} else {
    $indexPosts->excerpt(500, '');
}
```

**说明：**
- 优先显示文章自定义字段 `description`
- `description` 支持 Markdown 渲染
- 若未配置 `description`，则退回使用原生摘要

#### 3.4.3 布局控制

```php
<div class="col-sm-12 <?php if ($this->options->sidebarStatus == 'yes'): ?>col-md-8<?php endif; ?>" id="main">
```

- 启用侧边栏：主内容区占 8 列
- 禁用侧边栏：主内容区占满 12 列，最大宽度 850px

---

### 3.5 post.php - 文章页模板

[`post.php`](post.php) 展示单篇文章的完整内容。

#### 3.5.1 与首页的区别

- 标题使用 `<h1>` 而非 `<h2>`
- 显示完整内容（通过 [`parseContent()`](functions.php:770) 处理）
- 支持单篇文章自定义 `description` 的 Markdown 渲染
- 显示文章声明（如果启用）
- 显示上一篇/下一篇导航
- 加载评论区

#### 3.5.2 description 渲染

```php
<?php echo renderPostDescription($this); ?>
```

**说明：**
- 单篇文章页顶部描述区支持 Markdown
- 渲染后同样会复用主题图片处理逻辑

#### 3.5.3 文章声明

```php
<?php if ($this->options->statementStatus == 'yes'): ?>
    <div class="post-statement">
        <?php $this->options->statementText(); ?><br>
        如若转载，请注明出处：<?php $this->permalink() ?>
    </div>
<?php endif; ?>
```

---

### 3.6 page.php - 独立页面模板

[`page.php`](page.php) 用于展示独立页面，结构简洁。

```php
<article class="post">
    <h1 class="post-title"><?php $this->title(); ?></h1>
    <div class="post-content">
        <?php echo parseContent($this->content); ?>
    </div>
</article>
```

---

### 3.7 archive.php - 归档页模板

[`archive.php`](archive.php) 用于展示分类、标签、搜索结果等归档页面。

归档页仍使用原始归档查询结果，但在模板层对私有分类文章进行访客过滤；若当前页文章都被过滤，会显示“没有找到可显示的文章”的提示，而不是直接输出空白区域。

#### 3.7.1 归档标题

```php
<h3 class="archive-title">
    <?php $this->archiveTitle([
        'category' => '分类 %s 下的文章',
        'search'   => '包含关键字 %s 的文章',
        'tag'      => '合集 %s 下的文章',
        'author'   => '%s 发布的文章'
    ], '', ''); ?>
</h3>
```

#### 3.7.2 摘要与空结果处理

```php
$description = getPostDescription($this);
if ($description) {
    echo renderPostDescription($this);
} else {
    $this->excerpt(500, '');
}
```

```php
<?php if (!$hasVisiblePosts): ?>
    <article class="post">
        <h3>没有找到可显示的文章</h3>
    </article>
<?php endif; ?>
```

---

### 3.8 comments.php - 评论区模板

[`comments.php`](comments.php) 实现完整的评论功能，包括评论表单和评论列表。

#### 3.8.1 评论表单

**登录用户：**
```php
<?php if ($this->user->hasLogin()): ?>
    <p>登录身份: <a href="<?php $this->options->profileUrl(); ?>">
        <?php $this->user->screenName(); ?>
    </a></p>
```

**访客：**
```php
<?php else: ?>
    <!-- 昵称、Email、网站输入框 -->
<?php endif; ?>
```

#### 3.8.2 PJAX 评论支持

```php
<?php if ($this->options->commentsThreaded && $this->options->pjaxStatus == 'yes'): ?>
    <script>
        // TypechoComment 回复功能适配 PJAX
        window.TypechoComment = {
            dom: function(id) { return document.getElementById(id); },
            reply: function(cid, coid) { /* ... */ },
            cancelReply: function() { /* ... */ }
        };
    </script>
<?php endif; ?>
```

#### 3.8.3 评论列表回调函数

```php
function threadedComments($comments, $options) {
    // 评论 CSS 类
    $commentClass = '';
    if ($comments->authorId == $comments->ownerId) {
        $commentClass .= ' comment-by-author'; // 博主评论
    }
    
    // 评论 HTML 结构
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php echo $commentClass; ?>">
        <!-- 头像、作者、时间、IP 归属地、内容、回复按钮 -->
        <!-- 子评论递归 -->
        <?php if ($comments->children): ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php endif; ?>
    </li>
<?php }
```

#### 3.8.4 IP 归属地显示

```php
<?php if (class_exists('ip2region_Plugin') && $options->commentAuthorIp2RegionStatus == 'yes'): ?>
    <?php echo '评论于 '.ip2region_Plugin::get($comments->ip); ?>
<?php endif; ?>
```

---

### 3.9 sidebar.php - 侧边栏模板

[`sidebar.php`](sidebar.php) 提供可配置的侧边栏小工具。

#### 3.9.1 可用小工具

| 标识 | 名称 | 数据源 |
|------|------|--------|
| `ShowCategory` | 文章分类 | `Widget_Metas_Category_List` |
| `ShowRecentTags` | 最新合集 | `Widget_Metas_Tag_Cloud` |
| `ShowRandPosts` | 随机推荐 | `Widget_Post_rand`（自定义） |
| `ShowRecentPosts` | 近期文章 | `Widget_Contents_Post_Recent` |
| `ShowRecentComments` | 近期评论 | `Widget_Comments_Recent` |
| `ShowArchive` | 文章归档 | `Widget_Contents_Post_Date` |
| `ShowStatistics` | 数据统计 | 自定义统计函数 |

#### 3.9.2 粘性布局

```php
<div id="sidebar" style="<?php if ($this->options->sidebarStickyStatus == 'yes'): ?>
    position: sticky; top: 10px; align-items: flex-start; align-self: start
<?php endif; ?>">
```

---

### 3.10 timeline.php - 时间轴模板

[`timeline.php`](timeline.php) 是一个自定义页面模板，按时间轴展示所有文章。

#### 3.10.1 数据获取

```php
$db = Typecho_Db::get();
$archives = $db->fetchAll($db->select()->from('table.contents')
    ->where('type = ?', 'post')
    ->where('status = ?', 'publish')
    ->order('table.contents.created', Typecho_Db::SORT_DESC));
```

#### 3.10.2 HTML 结构

```html
<div class="timeline">
    <div class="year-section">
        <div class="year-header">2024 年 (共 X 篇文章)</div>
        <div class="year-content">
            <div class="month-section">
                <div class="month-header">01 月 (共 X 篇文章)</div>
                <div class="month-content">
                    <ul>
                        <li class="timeline-item">
                            <span class="timeline-date">01 日</span>
                            <a href="...">文章标题</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
```

#### 3.10.3 交互脚本

```javascript
function initTimeline() {
    // 年份折叠
    document.querySelectorAll('.year-header').forEach(header => {
        header.addEventListener('click', function() {
            this.nextElementSibling.classList.toggle('hidden');
            this.classList.toggle('collapsed');
            this.classList.toggle('expanded');
        });
    });
    // 月份折叠
    document.querySelectorAll('.month-header').forEach(header => {
        header.addEventListener('click', function() {
            this.nextElementSibling.classList.toggle('hidden');
            this.classList.toggle('expanded');
        });
    });
}
```

---

### 3.11 404.php - 错误页模板

[`404.php`](404.php) 提供简洁的 404 错误页面。

```php
<div class="error-page">
    <h2 class="post-title">404 - 页面没找到</h2>
</div>
```

---

## 4. 样式系统

### 4.1 CSS 变量

主题使用 CSS 变量实现多主题模式切换：

```css
:root {
    --bg-color: #FFFFFF;           /* 背景色 */
    --text-color: #333333;         /* 文字色 */
    --link-color: #3354AA;         /* 链接色 */
    --secondary-color: #999999;    /* 次要文字色 */
    --border-color: #EEEEEE;       /* 边框色 */
    --muted-color: #F5F5F5;        /* 柔和背景色 */
    --body-font-famliy: "Dream Han Serif CN W8", ...;
    --code-font-famliy: "Maple Mono NF CN", ...;
}

[theme-mode="dark"] {
    --bg-color: #1E1E1E;
    --text-color: #A6A6A6;
    --link-color: #6B92C7;
    /* ... */
}

[theme-mode="read"] {
    --bg-color: #F2F1EA;           /* 护眼米色 */
    --text-color: #474135;
    /* ... */
}
```

### 4.2 字体配置

| 用途 | 字体 | 来源 |
|------|------|------|
| 正文 | Dream Han Serif CN W8 | static-lab.6os.net |
| 代码 | Maple Mono NF CN | static-lab.6os.net |
| Emoji | Noto Color Emoji | static-lab.6os.net |

### 4.3 响应式断点

```css
@media (max-width: 768px) {
    body { font-size: 90%; }
    #header { text-align: center; }
}
```

### 4.4 主要样式模块

| 模块 | 选择器 | 说明 |
|------|--------|------|
| 全局样式 | `body`, `a`, `pre`, `code` | 基础元素样式 |
| 导航区 | `#header`, `#nav-menu`, `#search` | 顶部导航 |
| 文章区 | `.post`, `.post-content`, `.post-meta` | 文章展示 |
| 评论区 | `#comments`, `.comment-list` | 评论系统 |
| 侧栏区 | `#sidebar`, `.widget` | 侧边栏 |
| 底栏区 | `#footer` | 页脚 |
| 悬浮工具 | `.minitool-group`, `.toc-panel` | 右下角工具 |
| 时间轴 | `.timeline` | 时间轴页面 |
| 代码高亮 | `.hljs` | Highlight.js 主题适配 |

---

## 5. JavaScript 功能

### 5.1 初始化流程

```javascript
function initMain() {
    hljs.highlightAll();                    // 代码高亮
    renderMathInElement(document.body);     // 数学公式
    $('img.lazyload').lazyload();           // 图片懒加载
    initToc();                              // TOC 目录
    initTimeline();                         // 时间轴
    initAISummary();                        // AI 摘要（适配）
    initElink();                            // 外链处理
}
```

### 5.2 PJAX 事件流程

```
用户点击链接
    ↓
pjax:send → NProgress.start()
    ↓
PJAX 请求页面内容
    ↓
pjax:beforeReplace → 处理评论提交
    ↓
pjax:complete → initMain()
    ↓
pjax:end → NProgress.done()
```

### 5.3 TOC 目录功能

**目录生成：**
1. 查找 `.post-content` 内的所有标题（h1-h6）
2. 计算标题层级偏移量
3. 生成嵌套的目录列表 HTML
4. 为标题添加 ID 用于锚点跳转

**滚动高亮：**
```javascript
function highlightToc() {
    // 找到视口内最顶部的标题
    for (let i = 0; i < $headings.length; i++) {
        const rect = $heading[0].getBoundingClientRect();
        if (rect.top <= 50) { // 视口顶部偏移量
            currentId = $heading.attr('id');
        }
    }
    // 更新高亮状态
    $('.toc-item.toc-active').removeClass('toc-active');
    $(`.toc-item[data-id="${currentId}"]`).addClass('toc-active');
}
```

### 5.4 主题模式切换

```javascript
// 切换逻辑（悬浮按钮）
$('.themeMode-minitool').click(function() {
    const mode = $body.attr('theme-mode');
    if (mode === 'light') {
        $themeModeSelect.val('dark').trigger('change');
    } else if (mode === 'dark') {
        $themeModeSelect.val('read').trigger('change');
    } else {
        $themeModeSelect.val('light').trigger('change');
    }
});
```

---

## 6. 配置选项

### 6.1 基础设置

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `pjaxStatus` | radio | no | 全站 PJAX 开关 |
| `faviconUrl` | text | - | 自定义 favicon 路径 |
| `footerText` | textarea | - | 页脚版权信息 |
| `analyticsCode` | textarea | - | 统计代码 |

### 6.2 主题模式设置

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `themeModeSelectStatus` | radio | no | 主题模式切换开关 |
| `defaultThemeMode` | radio | auto | 默认主题模式 |

### 6.3 侧边栏设置

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `sidebarStatus` | radio | no | 侧边栏开关 |
| `sidebarBlock` | checkbox | - | 侧边栏内容选择 |
| `sidebarStickyStatus` | radio | no | 粘性布局开关 |

### 6.4 文章设置

其中“内部文章分类名称”会影响访客可见范围：配置中的分类及其全部子分类文章，会在未登录状态下被视为内部文章。

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `weservStatus` | radio | no | 图片防盗链服务 |
| `imageLazyloadStatus` | radio | no | 图片懒加载 |
| `imageLightBoxStatus` | radio | no | 图片灯箱 |
| `postWordCountVisibleStatus` | radio | no | 显示文章字数 |
| `postReadingTimeVisibleStatus` | radio | no | 显示阅读时长 |
| `readingSpeed` | text | 200 | 阅读速度（字/分钟） |
| `postViewVisibleStatus` | radio | no | 显示阅读数 |
| `randMinPostView` | text | 800 | 随机阅读数最小值 |
| `randMaxPostView` | text | 1200 | 随机阅读数最大值 |
| `elinkTargetBlankStatus` | radio | no | 外链新窗口打开 |
| `statementStatus` | radio | no | 文章声明开关 |
| `statementText` | textarea | - | 文章声明内容 |

### 6.5 悬浮工具设置

| 选项 | 类型 | 默认值 | 说明 |
|------|------|--------|------|
| `tocMinitoolStatus` | radio | no | TOC 目录按钮 |
| `tocDefaultVisibleStatus` | radio | no | 默认打开 TOC |
| `tocDefaultExpandedStatus` | radio | no | 默认展开 TOC |
| `themeModeMinitoolStatus` | radio | no | 主题模式按钮 |
| `topMinitoolStatus` | radio | no | 返回顶部按钮 |
| `playbackMinitoolStatus` | radio | no | 放映模式按钮 |

---

## 7. 插件兼容性

### 7.1 ip2region 插件

**用途：** 显示评论者 IP 归属地

**检测方式：**
```php
class_exists('ip2region_Plugin')
```

**调用方法：**
```php
ip2region_Plugin::get($comments->ip)
```

### 7.2 playback 插件

**用途：** 文章放映模式（沉浸式阅读）

**检测方式：**
```php
class_exists('playback_Plugin')
```

**按钮显示条件：**
- 插件已安装
- `playbackMinitoolStatus == 'yes'`
- 当前页面存在 `.post-content`

---

## 附录

### A. 数据库字段

主题会在 `typecho_contents` 表中添加以下字段：

| 字段名 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| `views` | INT(10) | 0 | 文章阅读数 |

### B. 外部依赖

| 依赖 | 版本 | CDN |
|------|------|-----|
| jQuery | 3.6.0 | static-lab.6os.net |
| KaTeX | 0.16.28 | 主题本地 assets/katex |
| Highlight.js | 11.11.1 | static-lab.6os.net |
| jquery.pjax | 2.0.1 | static-lab.6os.net |
| NProgress | 0.2.0 | static-lab.6os.net |
| FancyBox | 3.5.7 | static-lab.6os.net |
| jquery.lazyload | 1.9.5 | static-lab.6os.net |

### C. 浏览器兼容性

- Chrome 80+
- Firefox 75+
- Safari 13+
- Edge 80+

---

*文档最后更新：2026-02-15*
