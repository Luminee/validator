
# Luminee Validator - Laravel 增强验证器

## 安装

```bash
composer require luminee/validator
```

## 快速开始

### 1. 创建验证请求

```bash
php artisan validator:make-request CustomRequest
```

生成的请求类将继承 `Luminee\Validator\Requests\BaseRequest`

若使用模块化项目，请自行将生成的 `CustomRequest.php` 文件移动到对应的目录中

### 2. 定义验证规则

```php
const NAME = 'required|max:50';

public function rules()
{
    return array_merge(parent::rules(), [
        //
        'name' => self::NAME,
        'brothers' => 'required|between:0,10',
        'sisters' => ['required', 'between:0,10'],
        'age' => [self::required(), self::between(1, 150)]
    ]);
}
```

上面四种方式均可
1. 在 `BaseRequest` 或当前类中配置常用常量
2. 直接使用官方的字符串方式
3. 直接使用官方的数组方式
4. 使用配置好的规则方法的数组形式

`messages()` 和 `attributes()` 同样使用官方的方式在 `BaseRequst` 或当前类配置

### 3. 自定义验证规则

```bash
php artisan validator:make-rule CustomRule
```

规则文件将生成在 `app/Http/Requests/Rules/` 目录，实现 `passes()` 和 `message()` 方法即可

如果使用了模块化项目，需自行将生成的 `CustomRule.php` 文件移动到对应的目录中

使用自定义规则：
```php
return array_merge(parent::rules(), [
    'reward' => ['required', new CustomRule()],
]);
```

### 4. 验证请求
```php
use App\Http\Requests\CustomRequest;

$validator = Validator::validate(CustomRequest::class);
if ($validator->fails())
    return response()->json(['error' => $validator->messages()->first()], 422);

// 获取验证后的参数
$params = $validator->getData();
// 或
$params = $this->all();
```

### 动态改写验证规则
```php
$request = app()->make(CustomRequest::class);
$validator = Validator::validate($request, [
    'user_id' => 'required|between:1,100',
    'age' => [$request->required(), $request->between(18, 100)],
], [
    'required' => ':attribute 字段不能为空'
], [
    'user_id' => '用户ID'
]);
```

参数说明：
1. 第一个参数可以是类名或请求实例
2. 参数2-4分别对应 `rules()`, `messages()`, `attributes()` 的改写
