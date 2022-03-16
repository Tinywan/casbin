# webman casbin 权限控制插件

[![Latest Stable Version](http://poser.pugx.org/tinywan/casbin/v)](https://packagist.org/packages/tinywan/casbin) 
[![Total Downloads](http://poser.pugx.org/tinywan/casbin/downloads)](https://packagist.org/packages/tinywan/casbin) 
[![License](http://poser.pugx.org/tinywan/casbin/license)](https://packagist.org/packages/tinywan/casbin) 
[![PHP Version Require](http://poser.pugx.org/tinywan/casbin/require/php)](https://packagist.org/packages/tinywan/casbin)
[![webman-event](https://img.shields.io/github/last-commit/tinywan/casbin/main)]()
[![webman-event](https://img.shields.io/github/v/tag/tinywan/casbin?color=ff69b4)]()

webman casbin 权限控制插件。它基于 [PHP-Casbin](https://github.com/php-casbin/php-casbin), 一个强大的、高效的开源访问控制框架，支持基于`ACL`, `RBAC`, `ABAC`等访问控制模型。

## 依赖

- [ThinkORM](https://www.workerman.net/doc/webman/db/others.html)
- [PHP-DI](https://github.com/PHP-DI/PHP-DI)

## 安装

```sh
composer require tinywan/casbin
```

## 配置

### 1、DI容器配置（必须）

修改配置`config/container.php`，其最终内容如下：

```php
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(config('dependence', []));
$builder->useAutowiring(true);
return $builder->build();
```

### 2、数据库配置

（1）修改数据库 `thinkorm` 配置

（2）创建 `casbin_rule` 数据表

```sql
CREATE TABLE `casbin_rule` (
	`id` BIGINT ( 20 ) UNSIGNED NOT NULL AUTO_INCREMENT,
	`ptype` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v0` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v1` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v2` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v3` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v4` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	`v5` VARCHAR ( 128 ) NOT NULL DEFAULT '',
	PRIMARY KEY ( `id` ) USING BTREE,
	KEY `idx_ptype` ( `ptype` ) USING BTREE,
	KEY `idx_v0` ( `v0` ) USING BTREE,
	KEY `idx_v1` ( `v1` ) USING BTREE,
	KEY `idx_v2` ( `v2` ) USING BTREE,
	KEY `idx_v3` ( `v3` ) USING BTREE,
	KEY `idx_v4` ( `v4` ) USING BTREE,
    KEY `idx_v5` ( `v5` ) USING BTREE 
) ENGINE = INNODB CHARSET = utf8mb4 COMMENT = '策略规则表';
```
（3）配置 `config/redis` 配置

## 重启webman

```
php start.php restart
```
或者
```
php start.php restart -d
```

## 用法

### 快速开始

安装成功后，可以这样使用:

```php
use Tinywan\Casbin\Permission;

// adds permissions to a user
Permission::addPermissionForUser('eve', 'articles', 'read');
// adds a role for a user.
Permission::addRoleForUser('eve', 'writer');
// adds permissions to a rule
Permission::addPolicy('writer', 'articles','edit');
```

你可以检查一个用户是否拥有某个权限:

```php
if (Permission::enforce("eve", "articles", "edit")) {
    echo '恭喜你！通过权限认证';
} else {
    echo '对不起，您没有该资源访问权限';
}
```

更多 `API` 参考 [Casbin API](https://casbin.org/docs/en/management-api) 。

## 感谢

[Casbin](https://github.com/php-casbin/php-casbin)，你可以查看全部文档在其 [官网](https://casbin.org/) 上。
