# think-model-file-make
thinkphp6模型文件生成助手
我看到了一个 `yunwuxin/think-model-helper` 自动生成模型注释的扩展,
但是创建模型文件很麻烦,所以做了这个玩意


开启exec函数

执行命令 ` php think modelfilegenerate`

----
- 自动创建app/linxyyl/model目录
- 自动读取数据库所有数据表生成thinphp6大驼峰命名model文件
- 如需重新创建手动删除linxyyl/model下的所有文件即可
- 这个功能还是当助手使用,并不建议拿来当核心model使用