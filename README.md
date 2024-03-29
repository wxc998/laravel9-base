github未及时更新，请移步gitee：https://gitee.com/wangfor/laravel9-basic-project
## 环境

- Nginx/Apache
- MySQL
- PHP >= 8.0

## 配置
数据库（配置根目录下 .env 文件）
```
DB_CONNECTION=mysql
// host地址
DB_HOST=127.0.0.1
// 端口号
DB_PORT=3306
// 数据库名
DB_DATABASE=laravel9
// 用户名
DB_USERNAME=root
// 密码
DB_PASSWORD=
```

## 扩展包
只安装了项目最常用的几个，如果有需要可以从下面链接里看一下
[下载量最高的 100 个 Laravel 扩展包推荐](https://learnku.com/laravel/t/2530/the-highest-amount-of-downloads-of-the-100-laravel-extensions-recommended)

- 代码提示工具
```laravel-ide-helper```


- 语言包
```caouecs/laravel-lang```


- 开发调试利器（debugbar 在 dev 环境安装）
  ```laravel-debugbar```

## 统一 Response 响应

1、返回成功信息
```php
return $this->success($data);
```
2、返回失败信息
```php
return $this->fail($codeResponse);
```
3、抛出异常
```php
$this->throwBusinessException($codeResponse);
```
4、分页
```php
return $this->successPaginate($data);
```
## 统一表单参数输入校验

### 使用
1、验证参数是否为ID
```php
$this->verifyId('key');
```
2、验证参数是否为整数
```php
$this->verifyInteger('key');
```
3、验证参数是否为字符串
```php
$this->verifyString('key');
```
4、验证参数是否为布尔值
```php
$this->verifyBoolean('key');
```
....

### 案例
有一个 ```index``` 方法，我们在获取参数时使用 ```verifyId``` 来校验请求的参数
```php
public function index()
{
    $id = $this->verifyId('id', null);
}
```
当我们请求时，因为传入的参数是字符串
```
http://127.0.0.1:8000/api/user/index?id=xddd
```
所以返回 ```The id must be an integer``` ，提示id必须为整数

![Laravel9 开发 API 总结](https://cdn.learnku.com/uploads/images/202203/15/69325/73Yf2SI32F.png!large)

## 服务层 Service
如果项目比较小，接口较少，业务逻辑放在 controller 和 model 层就可以。否则就需要创建一个 Service 层来存放一些较复杂些的业务逻辑。
一、在 ```app``` 目录下，创建名叫 ```Services``` 的文件夹

![Laravel 开发 API 心得](https://cdn.learnku.com/uploads/images/202203/16/69325/GSPYII6h0q.png!large)

二、在新创建的 ```Services``` 目录下创建基类 ```BaseService.php``` ，采用单例模式避免对内存造成浪费，也方便调用
```php
<?php

namespace App\Services;

use App\Helpers\ApiResponse;

class BaseService
{
    // 引入api统一返回消息
    use ApiResponse;

    protected static $instance;

    public static function getInstance()
    {
        if (static::$instance instanceof static){
            return self::$instance;
        }
        static::$instance = new static();
        return self::$instance;
    }

    protected function __construct(){}

    protected function __clone(){}

}

```
三、使用
例如要实现一个获取用户信息的功能
1、在 Service 层创建一个 ```UserService.php``` 的文件
```php
<?php

namespace App\Services;

use App\Services\BaseService;

class UserService extends BaseService
{
    // 获取用户信息
    public function getUserInfo()
    {
        return ['id' => 1, 'nickname' => '张三', 'age' => 18];
    }

}
```
2、在控制器 ```UserController``` 中增加一个 ```info``` 方法，并调用服务层中的 getUserInfo() 方法
```php
use App\Services\UserService;

public function info()
{
    $user = UserService::getInstance()->getUserInfo();
    return $this->success($user);
}
```
3、返回

![Laravel 开发 API 心得](https://cdn.learnku.com/uploads/images/202203/16/69325/D1dnCY6rNp.png!large)

## 博客
[博客地址](https://blog.konghou.xyz/article/192 "博客")

## 不喜勿喷，如有错误或建议欢迎指出提出，持续更新中...

