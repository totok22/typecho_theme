<?php
/**
 * 导航区
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->archiveTitle([
                'category' => '分类 %s 下的文章',
                'search'   => '包含关键字 %s 的文章',
                'tag'      => '合集 %s 下的文章',
                'author'   => '%s 发布的文章'
        ], '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/normalize.min.css'); ?>?v=<?php echo version(); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/grid.min.css'); ?>?v=<?php echo version(); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>?v=<?php echo version(); ?>">
    <?php if ($this->options->faviconUrl):  ?>
        <link rel="shortcut icon" href="<?php $this->options->faviconUrl(); ?>" type="image/x-icon" />
    <?php else: ?>
        <link rel="shortcut icon" href="<?php $this->options->themeUrl('images/favicon.ico'); ?>" type="image/x-icon" />
    <?php endif ?>
    <?php if ($this->options->sidebarStatus != 'yes'): ?>
        <style>
            .container-md {
                max-width: 850px;
            }
        </style>
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.25/dist/katex.min.css">
    <link id="highlightThemeCss" rel="stylesheet" href="//static-lab.6os.net/highlight/11.11.1/styles/atom-one-light.min.css">
    <script>
        (function() {
            try {
                var saved = localStorage.getItem('theme-mode');
                var defaultMode = '<?php echo $this->options->defaultThemeMode ?>';
                var mode = saved || defaultMode;
                if (mode === 'auto') {
                    var isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    mode = isDark ? 'dark' : 'light';
                }
                var highlightCss = document.getElementById('highlightThemeCss');
                if (highlightCss) {
                    highlightCss.href = mode === 'dark'
                        ? '//static-lab.6os.net/highlight/11.11.1/styles/atom-one-dark.min.css'
                        : '//static-lab.6os.net/highlight/11.11.1/styles/atom-one-light.min.css';
                }
            } catch (e) {}
        })();
    </script>
    <?php $this->header(); ?>
</head>
<body theme-mode="">
    <script>
        (function() {
            try {
                const saved = localStorage.getItem('theme-mode');
                const defaultMode = '<?php echo $this->options->defaultThemeMode ?>';
                let mode = saved || defaultMode;
                if (mode === 'auto') {
                    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    mode = isDark ? 'dark' : 'light';
                }
                if (mode === 'light' || mode === 'dark' || mode === 'read') {
                    document.body.setAttribute('theme-mode', mode);
                }
            } catch (e) {
                // 忽略错误
            }
        })();
    </script>

<header id="header" class="clearfix">
    <div class="container-md">
        <div class="row">
            <div class="site-name col-md-6 col-sm-12">
                <a id="logo" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
                <p class="description"><?php $this->options->description(); ?></p>
            </div>
            <div class="site-helper col-md-6 col-sm-12">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>">
                        <input type="text" id="s" name="s" class="text" placeholder="请输入关键字搜索"/>
                        <span class="search-shortcut-hint">/</span>
                        <button type="submit" class="submit">搜索</button>
                    </form>
                <div id="themeMode-selector" style="<?php if ($this->options->themeModeSelectStatus != 'yes'): ?>display: none<?php endif; ?>">
                        <select id="themeMode">
                            <option value="auto">跟随系统</option>
                            <option value="light">亮色模式</option>
                            <option value="dark">深色模式</option>
                            <option value="read">护眼模式</option>
                        </select>
                    </div>
            </div>
            <div class="col-md-12">
                <nav id="nav-menu" class="clearfix">
                    <a href="<?php $this->options->siteUrl(); ?>">首页</a>
                    <?php if (!empty($this->options->menuBlock) && in_array('ShowCategory', $this->options->menuBlock)): ?>
                        <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
                        <?php while ($categories->next()): ?>
                            <?php
                            // 如果是私有分类或其子分类，且用户未登录，则跳过
                            if (isPrivateCategory($categories->mid) && !isUserLoggedIn()) {
                                continue;
                            }
                            ?>
                            <a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if (!empty($this->options->menuBlock) && in_array('ShowPage', $this->options->menuBlock)): ?>
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while ($pages->next()): ?>
                            <a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>
</header>
<div id="body">
    <div class="container-md">
        <div class="row" id="pjax-container">
