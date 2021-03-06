### 一：文件上传需要注意php.ini文件 
------
* `/etc/php.ini` 的配置选项有很多，查找设置即可

| 配置项 | 功能说明  | 
| :----  | :----  |
| `file_upload`  | On为开始文件上传功能，off为关闭  |
| `post_max_size`  | 系统允许的POST传参的最大值 |
| `upload_max_filesize`  | 系统允许的上传文件的最大值  |
| `memory_limit`  | 内存使用限制  |

建议尺寸 : `file_size`(文件大小) < `upload_max_filesize` < `post_max_size` < `memory_limit`

另外，需要注意的是脚本执行时间。

`max_execution_time`,单位为秒。这个参数是设定脚本的最大执行时间。也可以根据需求做适当的改变，通常不需要来修改，系统默认即可。超大文件上传的时候，可能会涉及到这一参数的修改。

上传时间太长，会超时。如果你将此参数设置为0，则是不限制超时时间，不建议使用。

完成了`php.ini`的相关配置，我们就可以开始试着完成第一次文件上传了。

### 二：文件上传的步骤
------
> 系统返回的错误码详解

#### 1、判断是否有错误码

| 错误码 | 说明  | 
| :----:  | :----  |
| 0  | 无误，可以继续进行文件上传的后续操作  |
| 1  | 超出上传文件的最大限制，`upload_max_filesize = 2M` **php.ini**中设置，一般默认为**2M**。可以根据项目中的实际需求来修改  |
| 2  | 超出了制定的文件大小，根据项目的业务需求制定上传文件的大小限制  |
| 3  | 只有部分文件被上传  |
| 4  | 文件没有被上传  |
| 6  | 找不到临时文件夹，可能目录不存在或没权限  |
| 7  | 文件写入失败，可能磁盘空间不足或没有权限  |

**注**：错误码中没有5

#### 2、自定义判断是否超出文件大小范围

在开发上传功能时，除了`php.ini`中规定的上传的最大值外，我们通常还会设定一个值，是业务规定的上传大小限制。

**例如：**<br>
新浪微博或者QQ空间只准单张头像图片2M。而在上传图册的时候又可以超过2M来上传。

所以说，系统是支持更大文件上传的。

此处的判断文件大小，我们用于限制实际业务中我们想要规定的上传的文件大小。

#### 3、判断后缀名和mime类型是否符合
在网络世界里面也有坏人，他们把图片插入病毒，在附件中上传病毒，他们会在网页中插入病毒或者黄色图片。

我们需要对于上传的文件后缀和mime类型都要进行判断才可以。

**MIME**（Multipurpose Internet Mail Extensions）是多用途互联网邮件扩展类型。是设定某种扩展名的文件用一种应用程序来打开的方式类型，当扩展名文件被访问的时候，浏览器会自动使用指定的应用程序来打开。多用于指定一些客户端自定义的文件名，以及一些媒体文件打开方式。

在判断后缀和**MIME**类型的时候，我们会用到PHP的一个函数`in_array()`该函数传入两个参数。<br>
第一个参数是要判断的值；<br>
第二个参数是范围数组。

我们用这个函数来判断文件的后缀名和mime类型是否在允许的范围内

#### 4、生成文件名
我们的文件上传成功了，不会让它保存原名，因为，有些人在原名中有敏感关键词会违反我国的相关法律和法规。

我们可以采用`date()`、`mt_rand()`或者`unique()`生产随机的文件名。

#### 5、判断是否是上传文件
文件上传成功后，系统会将上传的临时文件上传到系统的临时目录中，产生一个临时文件。

同时会产生临时文件名。我们需要做的事情是将临时文件移动到系统指定的目录中。

而移动前不能瞎移动，或者移动错了都是不科学的。移动前我们需要使用相关函数判断上传的文件是不是临时文件。

`is_uploaded_file()`传入一个参数（$_FILES中的缓存文件名），判断传入的名称是不是上传文件。

#### 6、移动临时文件到指定位置
临时文件是真实的临时文件，我们需要将其移动到我们的网站目录下面。

让我们网站目录的数据，其他人可以访问到。

我们使用：`move_uploaded_file()`
这个函数是将上传文件移动到指定位置，并命名。<br>
传入两个参数：<br>
第一个参数是指定移动的上传文件；<br>
第二个参数是指定的文件夹和名称拼接的字符串。

### 三：文件上传表单注意事项
------

1、form表单中的`method`必须为`post`，若为`get`是无法进行文件上传的。<br>
2、enctype必须为`multipart/form-data`



