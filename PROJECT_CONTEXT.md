
# 🚀 Typecho 主题开发 AI 上下文文档

## 1. 项目基本信息 (Project Essence)

* **项目类型：** Typecho 博客主题开发。
* **当前版本：** Typecho v1.3.0。
* **目标主题：** `default-ultra`（基于原版主题的极致优化版）。
* **项目状态：** 备案中，目前通过公网 IP进行访问调试。

## 2. 服务器环境 (Infrastructure)

* **位置：** 腾讯云轻量应用服务器 (Lighthouse)，北京地域。
* **硬件配置：** 2核 CPU，2GB 内存。
* **操作系统：** Ubuntu 22.04 LTS。
* **管理面板：** 1Panel (基于 Docker 的容器化管理)。

## 3. 技术栈细节 (Technology Stack)

* **PHP 版本：** **8.4.6** (注意：此版本极新，请确保建议的代码符合 PHP 8.x 规范，严禁使用已弃用的函数)。
* **PHP 关键扩展：** `pdo_mysql`, `gd`, `mbstring`, `opcache`, `curl`。
* **数据库：** MySQL 5.7.44 (容器内地址: `mysql`, 端口: `3306`)。
* **Web 服务器：** OpenResty (Nginx 分支)。

## 4. 目录结构与路径 (Paths)

* **Web 根目录：** `/opt/1panel/apps/openresty/openresty/www/sites/62.234.56.174/index/`
* **主题目录：** `/usr/themes/default-ultra/`
* **附件上传目录：** `/usr/uploads/` 

## 5. 编码规范与偏好 (Development Logic)

* **性能优先：** 尽量减少数据库查询，充分利用 Typecho 原生函数。
* **代码风格：** PHP 8 标准，逻辑清晰，注释详尽。

```
export PS1="\[\e[32m\]\u@\h:\[\e[34m\]\W\[\e[0m\]# "
```

!! git push 使用ssh方式。

注意参考：https://docs.typecho.org/phpcoding
https://docs.typecho.org/plugins/advanced