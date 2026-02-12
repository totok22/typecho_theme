<?php
/**
 * default-ultra theme for Typecho
 *
 * @package default-ultra
 * @version 2.8
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="col-sm-12 <?php if ($this->options->sidebarStatus == 'yes'): ?>col-md-8<?php endif; ?>" id="main">
    <?php while ($this->next()): ?>
        <?php
        // 如果文章属于私有分类，且用户未登录，则跳过
        if (isPostPrivate($this) && !isUserLoggedIn()) {
            continue;
        }
        ?>
        <article class="post">
            <h2 class="post-title">
                <a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
            </h2>
            <ul class="post-meta">
                <li><?php $this->date(); ?></li>
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
            <div class="post-summary">
                <?php
                // 优先显示自定义description字段，没有则显示文章摘要
                $description = getPostDescription($this);
                if ($description) {
                    echo $description;
                } else {
                    $this->excerpt(500, '');
                }
                ?>
            </div>
        </article>
    <?php endwhile; ?>
    <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div>
<?php $this->options->sidebarStatus == 'yes' ? $this->need('sidebar.php') : ''; ?>
<?php $this->need('footer.php'); ?>
