<?php
/**
 * 文章页
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="col-sm-12 <?php if ($this->options->sidebarStatus == 'yes'): ?>col-md-8<?php endif; ?>" id="main">
    <?php
    // 如果文章属于私有分类，且用户未登录，则显示提示信息
    if (isPostPrivate($this) && !isUserLoggedIn()):
    ?>
        <article class="post">
            <h1 class="post-title"><?php $this->title(); ?></h1>
            <div class="post-content" style="margin-top: 2em">
                <p>这篇文章是内部文章，仅限已登录用户查看。</p>
                <p>请<a href="<?php $this->options->siteUrl(); ?>admin/login.php">登录</a>后访问。</p>
            </div>
        </article>
    <?php else: ?>
        <?php if (isUserLoggedIn()): ?>
        <?php
        // 获取 Markdown 原文
        $markdownContent = '';
        $db = Typecho_Db::get();
        $rs = $db->fetchRow($db->select('text')->from('table.contents')->where('cid = ?', $this->cid));
        if ($rs && isset($rs['text'])) {
            // 移除 <!--markdown--> 标记
            $markdownContent = str_replace('<!--markdown-->', '', $rs['text']);
            $markdownContent = htmlspecialchars($markdownContent, ENT_QUOTES, 'UTF-8');
        }
        ?>
        <textarea id="mdContent" style="display:none;"><?php echo $markdownContent; ?></textarea>
        <?php endif; ?>
        <article class="post">
            <h1 class="post-title"><?php $this->title(); ?>
            <?php if (isUserLoggedIn()): ?>
            <button class="md-copy-btn" id="mdCopyBtn" title="复制 Markdown 原文">
                <svg class="copy-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span class="copy-text">复制</span>
            </button>
            <?php endif; ?>
            </h1>
            <ul class="post-meta">
                <li><?php $this->date(); ?></li>
                <li class="post-meta-separator">/</li>
                <li><?php $this->author->screenName(); ?></li>
                <li class="post-meta-separator">/</li>
                <li>
                    <?php $this->category(','); ?>
                    <?php if ($this->tags): ?>
                        & <?php $this->tags(' & ', true, ''); ?>
                    <?php endif; ?>
                </li>
                <li class="post-meta-separator">/</li>
                <li style="<?php if ($this->options->postViewVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>"><?php echo postView($this); ?> 阅读</li>
                <li class="post-meta-separator" style="<?php if ($this->options->postViewVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>">/</li>
                <li style="<?php if ($this->options->postCommentsVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>"><a href="<?php $this->permalink(); ?>#comments"><?php $this->commentsNum('暂无评论', '%d 条评论'); ?></a></li>
                <li class="post-meta-separator" style="<?php if ($this->options->postCommentsVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>">/</li>
                <?php if ($this->options->postWordCountVisibleStatus == 'yes'): ?>
                    <li>全文约 <?php echo postWordCount($this); ?> 字</li>
                    <li class="post-meta-separator">/</li>
                <?php endif; ?>
                <?php if ($this->options->postReadingTimeVisibleStatus == 'yes'): ?>
                    <li>阅读预计需要 <?php echo postReadingTime($this); ?> 分钟</li>
                <?php endif; ?>
            </ul>
            <?php
            // 显示自定义description字段
            $description = getPostDescription($this);
            if ($description):
            ?>
                <div class="post-description" style="margin-top: 1em; padding: 1em; background-color: var(--muted-color); border-left: 4px solid var(--border-color); color: var(--secondary-color);">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
            <div class="post-content" style="margin-top: 2em">
                <?php echo parseContent($this->content); ?>
            </div>
        <?php if ($this->options->statementStatus == 'yes'): ?>
            <div class="post-statement">
                <?php $this->options->statementText(); ?><br>
                如若转载，请注明出处：<?php $this->permalink() ?>
            </div>
        <?php endif; ?>
        <ul class="post-near">
            <li>上一篇：<?php $this->thePrev('%s', '没有了'); ?></li>
            <li>下一篇：<?php $this->theNext('%s', '没有了'); ?></li>
        </ul>
    </article>
    <?php endif; ?>
    <?php $this->need('comments.php'); ?>
</div>
<?php $this->options->sidebarStatus == 'yes' ? $this->need('sidebar.php') : ''; ?>
<?php $this->need('footer.php'); ?>
