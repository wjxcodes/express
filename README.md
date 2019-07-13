<h1 align="center"> express </h1>

<p align="center">       聚合数据快递查询扩展。</p>


## 安装

```shell
$ composer require wjxcodes/express -vvv
```

## 配置

在使用本扩展之前，你需要去 [聚合数据](https://www.juhe.cn/docs/api/id/43) 注册账号，然后申请使用物流查询接口，获取应用的 AppKey。

## 使用

```php
use Wjxcodes\Express\Express;

$appkey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Express($appkey);
```

###  获取物流信息

```php
$response = $express->getExpressInfo($com,$no,$receiverPhone);
```



### 在 Laravel 中使用

在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：

```php
    .
    .
    .
     'express' => [
        'key' => env('JUHE_EXPRESS_APP_KEY'),
    ],
```

然后在 `.env` 中配置 `JUHE_EXPRESS_APP_KEY` ：

```env
JUHE_EXPRESS_APP_KEY=xxxxxxxxxxxxxxxxxxxxx
```

可以用两种方式来获取 `Wjxcodes\Express\Express` 实例：

#### 方法参数注入

```php
    .
    .
    .
    public function edit(Express $express) 
    {
        $response = $express->getExpressInfo($com,$no,$receiverPhone);
    }
    .
    .
    .
```

#### 服务名访问

```php
    .
    .
    .
    public function edit() 
    {
        $response = app('express')->getExpressInfo($com,$no,$receiverPhone);
    }
    .
    .
    .

```
