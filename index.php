<?php
/**
 * default-ultra theme for Typecho
 *
 * @package default-ultra
 * @version 2.8.2
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
$this->widget('Widget_Post_Index_Filtered@index', 'pageSize=' . $this->options->pageSize)->to($indexPosts);
?>
<div class="col-sm-12 <?php if ($this->options->sidebarStatus == 'yes'): ?>col-md-8<?php endif; ?> post-list-main" id="main">
    <?php if ($indexPosts->have()): ?>
        <?php while ($indexPosts->next()): ?>
            <article class="post">
                <h2 class="post-title">
                    <a href="<?php $indexPosts->permalink(); ?>"><?php $indexPosts->title(); ?></a>
                </h2>
                <ul class="post-meta">
                    <li><?php $indexPosts->date(); ?></li>
                    <li class="post-meta-separator">/</li>
                    <li>
                        <?php $indexPosts->category(','); ?>
                        <?php if ($indexPosts->tags): ?>
                            & <?php $indexPosts->tags(' & ', true, ''); ?>
                        <?php endif; ?>
                    </li>
                    <li class="post-meta-separator">/</li>
                    <li style="<?php if ($this->options->postViewVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>"><?php echo postView($indexPosts); ?> 阅读</li>
                    <li class="post-meta-separator" style="<?php if ($this->options->postViewVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>">/</li>
                    <li style="<?php if ($this->options->postCommentsVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>"><a href="<?php $indexPosts->permalink(); ?>#comments"><?php $indexPosts->commentsNum('暂无评论', '%d 条评论'); ?></a></li>
                    <li class="post-meta-separator" style="<?php if ($this->options->postCommentsVisibleStatus != 'yes'): ?>display: none;<?php endif; ?>">/</li>
                    <?php if ($this->options->postWordCountVisibleStatus == 'yes'): ?>
                        <li>全文约 <?php echo postWordCount($indexPosts); ?> 字</li>
                        <li class="post-meta-separator">/</li>
                    <?php endif; ?>
                    <?php if ($this->options->postReadingTimeVisibleStatus == 'yes'): ?>
                        <li>阅读预计需要 <?php echo postReadingTime($indexPosts); ?> 分钟</li>
                    <?php endif; ?>
                </ul>
                <div class="post-summary">
                    <?php
                    $description = getPostDescription($indexPosts);
                    if ($description) {
                        echo renderPostDescription($indexPosts);
                    } else {
                        $indexPosts->excerpt(500, '');
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
        <?php $indexPosts->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php else: ?>
        <article class="post">
            <h3>没有找到可显示的文章</h3>
        </article>
    <?php endif; ?>
</div>
<?php $this->options->sidebarStatus == 'yes' ? $this->need('sidebar.php') : ''; ?>
<?php $this->need('footer.php'); ?>
