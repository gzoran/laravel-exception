<h1 align="center">Laravel Exception</h1>

<p align="center">Laravel 异常处理包</p>

[![Build Status](https://travis-ci.org/gzoran/laravel-exception.svg?branch=master)](https://travis-ci.org/gzoran/laravel-exception)
![StyleCI build status](https://github.styleci.io/repos/162661181/shield) 

## 框架要求

Laravel >= 5.5

## 安装

```shell
composer require "gzoran/laravel-exception:~2.0"
```

## 发布配置文件

此命令会在框架 config 目录下生成 exception.php 配置文件。

```shell
php artisan vendor:publish --provider="Gzoran\Exception\LaravelExceptionProvider"
```

## 初始化命令

此命令会在框架 app/Exceptions 目录下生成一个 AppException 和一个包含一些异常处理类的 Handlers 文件夹。

```shell
php artisan exception:init
```

## 使用

在框架 app/Exceptions/Handler.php 中使用 ExceptionHandlerTrait 。

```php
class Handler extends ExceptionHandler
{
    use ExceptionHandlerTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];
    
    ···
```

修改 Handler 类的 render 方法如下。

```php
···

/**
 * Render an exception into an HTTP response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $exception
 * @return \Illuminate\Http\Response
 */
public function render($request, Exception $exception)
{
    // return parent::render($request, $exception);

    return $this->handlersRender($request, $exception);
}

···
```

# 配置文件

配置 config/exception.php

```php
···

// 配置 Exception 子类与对应处理类（Handler）
'handlers' => [
    App\Exceptions\AppException::class => App\Exceptions\Handlers\AppExceptionHandler::class,
],

// 配置 Exception 基类处理类（Handler），在 Exception 子类匹配不到处理类（Handler）时，会使用此处基类的处理类（Handler）
'base_exception_handler' => App\Exceptions\Handlers\ExceptionHandler::class,

// 配置 Api 接口的 url 开始特征，用以在该 url 下强制以接口形式返回。
// 若不配置此项，请求接口时必须声明头部 Content-Type:application/json 
// 否则异常将以页面形式返回
'api_starts_with' => [
    '/api'
],

···
```

## 应用异常类 AppException

更改 app/Exception/AppException.php 以应对你的具体业务

```php

class AppException extends Exception
{
    /**
     * 添加你的错误码消息列表
     *
     * @var array
     */
    protected $codeList = [
        '10000' => [
            'message' => '业务错误'
        ],
    ];
    
    ...

```

然后找个需要的地方抛出异常即可

```php

...

// 抛出业务错误，参数：错误码 $code 错误详情 $errors = [] 状态码 $httpStatus = 400
throw new AppException(10000);

...

```

## 应用异常处理类 AppExceptionHandler

更改 app/Exception/Handlers/AppExceptionHandler.php 以应对你的具体业务

```php

/**
 * 返回 API 响应，这里你可以组装你的 API 响应
 * 
 * @author Mike <zhengzhe94@gmail.com>
 * @param Request $request
 * @param $exception
 * @return mixed
 */
public function apiRender(Request $request, $exception)
{
    /**
     * @var $exception AppException
     */
    return $this->response($exception->getResponse(), $exception->getHttpStatus());
}

/**
 * 返回页面响应，这里可以根据需要返回你自定义的视图
 * 
 * @author Mike <zhengzhe94@gmail.com>
 * @param Request $request
 * @param Exception $exception
 * @return mixed
 */
public function pageRender(Request $request, Exception $exception)
{
    return response(500, 500);
}

```

## 你也可以生成自己的异常类（Exception）和异常处理类（Handler）

生成异常类（Exception），并按业务需求更改，文件路径 app/Exceptions

```shell

php artisan make:exception FooException

```

生成异常处理类（Handler），并按业务需求更改，文件路径 app/Exceptions/Handles

```shell

php artisan make:exception_handler FooExceptionHandler

```

然后在 app/config/exception.php 配置异常类（Exception）和异常处理类（Handler）的对应关系

```php

...

'handlers' => [
    App\Exceptions\AppException::class => App\Exceptions\Handlers\AppExceptionHandler::class,
    App\Exceptions\FooException::class => App\Exceptions\Handlers\FooExceptionHandler::class,
],

...

```

最后找个需要的地方抛出异常即可

```php

...

throw new FooException();

...

```

## License

MIT