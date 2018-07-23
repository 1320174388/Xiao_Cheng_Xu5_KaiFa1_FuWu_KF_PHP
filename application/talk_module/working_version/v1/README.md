Talk_Module : 客服功能模块
===============

> 模块基于ThinkPHP5.1目录开发，以项目开发基础目录为标准

## 目录结构

~~~
├─talk_module                       模块目录
│  ├─config                         配置目录
│  │  ├─v1_tableName.php            数据表配置文件
│  │  ├─v1_config.php               权限管理模块路由
│  │  └─ ...                        更多配置
│  ├─working_version                工作版本目录
│  │  ├─v1                          版本3目录
│  │  │  ├─controller               控制器目录
│  │  │  ├─dao                      数据持久层目录
│  │  │  ├─library                  自定义类目目录
│  │  │  ├─model                    模型目录
│  │  │  ├─service                  逻辑层目录
│  │  │  ├─validator                验证层目录
│  │  │  ├─README.md                版本说明文件
│  │  │  ├─talk_route_v1_api.php    版本路由文件
│  │  │  ├─talk_v1_sql.php.php      可执行数据库迁移文件
│  │  │  └─Right_v3_IsAdmin.php.php 执行验证的中间件
│  │  └─ ...                        更多版本目录      
│  └─common.php                     模块函数文件
├─README.md                         模块说明文件
~~~

## 模块使用说明：
### `文件：/talk_module/config/v1_tableName.php`
### `说明：修改表名为项目使用的表名`
<br/>
### `文件：/talk_module/working_version/v1/talk_route_v1_api.php`
### `说明：保存到项目 /route 目录下,路由自动生效`
<br/>
### `文件：/talk_module/working_version/v1/talk_v1_sql.php`
### `说明：需要修改配置数组信息，对应项目的数据表名，库名`
### `使用：执行命令 php right_v1_sql.php 自动生成数据表`
<br/>
### `文件：/right_module/working_version/v1/Right_v3_IsAdmin.php`
### `说明：验证是不是管理员的中间件，如使用请参考ThinkPHP5.1中间件使用`
### `使用：使用的是权限管理第3版本的中间件控制`
<br/>
## v1版本接口说明：客服功能

### `功能：用户申请成为管理员`
### `传值：post`
### `接口：/v3/right_module/apply_init`
### `参数：userToken  => '用户身份标识'`
### `参数：applyName  => '用户名称'`
### `参数：applyPhone => '用户电话'`
### `响应：{"errNum":0,"retMsg":"申请成功","retData":true}`
### `响应：{"errNum":1,"retMsg":"没有发送用户身份标识","retData":false}`
### `响应：{"errNum":2,"retMsg":"请输入姓名","retData":false}`
### `响应：{"errNum":3,"retMsg":"请输入电话","retData":false}`
### `响应：{"errNum":4,"retMsg":"已申请管理员","retData":false}`
