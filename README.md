<h1 align="center"> geetest </h1>

<p align="center"> The geetest for php.</p>
简单封装了下极验的行为验证库，参照官方的使用方法。


## 安装

```shell
$ composer require zlh/geetest
```

## 使用示例

````
$captchaId = '1231231232131313213123'; //极验应用id
$privateKey = 'keykeykeykeykey'; //极验应用key
$userId = 1; //用户id
$ip = 112.12.52.52  //用户ip
$geetest = new Geetest();
$geetest->StartCaptchaServlet($captchaId,$privateKey,$ip,$userId); //AIP1 获取极验验证
$geetest->VerifyLoginServlet($captchaId,$privateKey,$ip,$userId); //AIP2 二次验证（后端验证）
````

## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/zlh/geetest/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/zlh/geetest/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
