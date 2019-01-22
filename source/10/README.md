### Composer
------

>到这里，我们已经能够使用PHP开发基础功能了，我们在学习一门新语言的时候，很重要的一点是要同步关注它的技术社群，多看多用多研究优秀的三方库，结合自身实际情况，运用到自己的项目中，让我们的代码更健壮。
>PHP里三方管理工具推荐使用**Composer**，需要详细了解请访问[官网](https://www.phpcomposer.com)

### 下载安装

* 官方[下载指南](https://getcomposer.org/download/)

```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

###  `composer.json`：项目安装
要开始在你的项目中使用 Composer，你只需要一个 composer.json 文件。该文件包含了项目的依赖和其它的一些元数据。

###  关于 require Key

第一件事情（并且往往只需要做这一件事），你需要在 composer.json 文件中指定 require key 的值。你只需要简单的告诉 Composer 你的项目需要依赖哪些包。

```
{
    "require": {
        "monolog/monolog": "1.0.*"
    }
}
```

你可以看到， require 需要一个 包名称 （例如 monolog/monolog） 映射到 包版本 （例如 1.0.*） 的对象。

###  包名称

包名称由供应商名称和其项目名称构成。通常容易产生相同的项目名称，而供应商名称的存在则很好的解决了命名冲突的问题。它允许两个不同的人创建同样名为 json 的库，而之后它们将被命名为 `igorw/json` 和 `seldaek/json`。

这里我们需要引入`monolog/monolog`，供应商名称与项目的名称相同，对于一个具有唯一名称的项目，我们推荐这么做。它还允许以后在同一个命名空间添加更多的相关项目。如果你维护着一个库，这将使你可以很容易的把它分离成更小的部分。

###  包版本

在前面的例子中，我们引入的 monolog 版本指定为 `1.0.*`。这表示任何从 `1.0` 开始的开发分支，它将会匹配 `1.0.0`、`1.0.2` 或者 `1.0.20`。

版本约束可以用几个不同的方法来指定。

| 名称 | 实例  |  描述  |
| :----:  | :---- |:---- |
| 确切的版本号  | `1.0.2` | 你可以指定包的确切版本 |
| 范围  | `>=1.0` `>=1.0,<2.0` `>=1.0,<1.1|>=1.2` | 通过使用比较操作符可以指定有效的版本范围。有效的运算符：`>`、`>=`、`<`、`<=`、`!=`。 你可以定义多个范围，用逗号隔开，这将被视为一个**逻辑AND**处理。一个管道符号`|`将作为**逻辑OR**处理。 AND 的优先级高于 OR。 |
| 通配符  | `1.0.*` | 你可以使用通配符`*`来指定一种模式。`1.0.*`与`>=1.0,<1.1`是等效的。 |
| 赋值运算符  | `~1.2` | 这对于遵循语义化版本号的项目非常有用。`~1.2`相当于`>=1.2,<2.0` |

###  安装依赖包

获取定义的依赖到你的本地项目，只需要调用 `composer.phar`运行 `install` 命令。

```
php composer.phar install
```

接着前面的例子，这将会找到 `monolog/monolog` 的最新版本，并将它下载到 `vendor` 目录。 这是一个惯例把第三方的代码到一个指定的目录 `vendor`。如果是 `monolog` 将会创建 `vendor/monolog/monolog` 目录。

> 小技巧： 如果你正在使用Git来管理你的项目， 你可能要添加 vendor 到你的 .gitignore 文件中。 你不会希望将所有的代码都添加到你的版本库中。

###  `composer.lock` - 锁文件

在安装依赖后，`Composer` 将把安装时确切的版本号列表写入 `composer.lock` 文件。这将锁定改项目的特定版本。

请提交你应用程序的 `composer.lock` （包括 `composer.json`）到你的版本库中

这是非常重要的，因为 `install` 命令将会检查锁文件是否存在，如果存在，它将下载指定的版本（忽略 `composer.json` 文件中的定义）。

这意味着，任何人建立项目都将下载与指定版本完全相同的依赖。你的持续集成服务器、生产环境、你团队中的其他开发人员、每件事、每个人都使用相同的依赖，从而减轻潜在的错误对部署的影响。即使你独自开发项目，在六个月内重新安装项目时，你也可以放心的继续工作，即使从那时起你的依赖已经发布了许多新的版本。

如果不存在 `composer.lock` 文件，`Composer` 将读取 `composer.json` 并创建锁文件。

这意味着如果你的依赖更新了新的版本，你将不会获得任何更新。此时要更新你的依赖版本请使用 update 命令。这将获取最新匹配的版本（根据你的 `composer.json` 文件）并将新版本更新进锁文件。

```
php composer.phar update
```

如果只想安装或更新一个依赖，你可以白名单它们：

```
php composer.phar update monolog/monolog [...]
```

> 注意： 对于库，并不一定建议提交锁文件 请参考：[库的锁文件](https://docs.phpcomposer.com/02-libraries.html#Lock-file).

###  Packagist

[packagist](https://packagist.org) 是 `Composer` 的主要资源库。 一个 `Composer` 的库基本上是一个包的源：记录了可以得到包的地方。`Packagist` 的目标是成为大家使用库资源的中央存储平台。这意味着你可以 `require` 那里的任何包。

当你访问 [packagist website](https://packagist.org)，你可以浏览和搜索资源包。

任何支持 `Composer` 的开源项目应该发布自己的包在 `packagist` 上。虽然并不一定要发布在 `packagist` 上来使用 `Composer`，但它使我们的编程生活更加轻松。

###  自动加载

对于库的自动加载信息，`Composer` 生成了一个 `vendor/autoload.php` 文件。你可以简单的引入这个文件，你会得到一个免费的自动加载支持。

```
require 'vendor/autoload.php';
```
这使得你可以很容易的使用第三方代码。例如：如果你的项目依赖 monolog，你就可以像这样开始使用这个类库，并且他们将被自动加载。
