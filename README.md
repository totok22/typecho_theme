# default-ultra

> [!NOTE]
> 本仓库是 [typecho-default-ultra-theme](https://github.com/visduo/typecho-default-ultra-theme) 的 Fork 版本，基于原版主题进行一些改造。

网站：[https://p0li.space/](https://p0li.space/)

网站基于 Typecho。

## 链接

| 链接 | 地址 |
|------|------|
| 登录控制台 | [https://p0li.space/admin/](https://p0li.space/admin/) |
| 网站首页 | [https://p0li.space/](https://p0li.space/) |
| 原版使用说明 | [https://www.duox.dev/post/65.html](https://www.duox.dev/post/65.html) |
| 更新记录 | [CHANGELOG.md](CHANGELOG.md) |
| 技术文档 | [DOCUMENTATION.md](DOCUMENTATION.md) |
| 项目上下文 | [PROJECT_CONTEXT.md](PROJECT_CONTEXT.md) |

## 写作入口

1. 打开登录控制台并登录。
2. 左上角菜单点击“撰写文章”。
3. 选择分类、填写正文、发布或保存草稿。

## 选择分类

- 注意选择正确分类，应为 BITFSAE 下的分类。
- 如需新增分类，联系 [我](mailto:3226534205@qq.com)。

## 正文规范

- 正文使用 Markdown 格式。
- 支持公式，行内公式与块级公式都可直接使用 `$` 或 `$$` 包裹。
- 可先在 Obsidian、Typora 等 Markdown 编辑器中编辑，再复制到正文框。
- Markdown 基础语法请自行参考通用教程。

公式示例：

```md
行内公式：$E = mc^2$

块级公式：
$$
\int_a^b f(x) \, dx
$$
```

## 图片使用

- 图片统一使用图床链接。
- 推荐写法：

```md
![图片标题](https://img.p0li.space/img/20260402xxxx.png)
```

- 如需配置 PicGo，或使用车队共用电脑上的 PicGo，联系 [我](mailto:3226534205@qq.com)。

### PicGo 上传

1. 下载并安装 PicGo：[https://molunerfinn.com/PicGo/](https://molunerfinn.com/PicGo/)
2. 联系网站管理员获取腾讯云 COS 配置。
3. 在 PicGo 中配置腾讯云 COS 图床。
4. 拖拽或粘贴图片上传。
5. 将自动复制的图床链接粘贴到 Markdown 中。

### 图片建议

- 格式优先使用 `.jpg` 或 `.webp`。
- 文件大小尽量控制在 500KB 以内，不要超过 1MB。
- 压缩可使用 [https://docsmall.com/image-compress](https://docsmall.com/image-compress)。

## 链接写法

### 站内文章链接

推荐优先使用相对路径，迁移域名时更省事。

```md
[这篇文章值得继续看](/post/123.html)
[关于页面](/page/about.html)
[跳到评论区](/post/123.html#comments)
```

也支持同域绝对地址：

```md
[这篇文章值得继续看](https://p0li.space/post/123.html)
```

### 站内锚点

```md
[跳到本页评论区](#comments)
```

### 外链

```md
[Typecho 官网](https://typecho.org/)
```

如主题设置中开启“文章外链新窗口打开”，站外链接会自动新窗口打开，站内链接不受影响。

### 不走 PJAX

```html
<a href="/post/123.html" no-pjax>普通跳转打开文章</a>
```

### 指定新窗口打开

```html
<a href="/post/123.html" target="_blank" rel="noopener noreferrer">在新窗口打开站内文章</a>
```

## 其他

- 代码块支持语法高亮和复制按钮。
- 文章支持 KaTeX 公式渲染。
- 文章自定义字段 `description` 会优先作为摘要展示。
- 详细主题功能与配置说明见 [DOCUMENTATION.md](DOCUMENTATION.md)。

原版完整安装说明与主题细节请参考原版使用说明。
