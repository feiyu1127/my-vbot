# blacklist
黑名单扩展

可检测各种类型消息的发送频率，检测规则：针对消息类型，10秒内发送4次触发警告，7次直接拉黑。

拉黑后会进行消息阻拦，阻拦后其他扩展将收不到消息传入，加载扩展请把此扩展放在首位位置。

## 要求

安装 redis

## 安装

```
composer require vbot/blacklist
```

## 扩展属性

```php
name: blacklist
zhName: 黑名单
author: HanSon
```

## 触发关键字

无

## 配置项

type 为需要检测的消息类型，为一个数组项

warn 与 block 都是一个匿名函数

```
// ...
'extension' => [
    // 管理员配置（必选），优先加载 remark_name
    'admin' => [
        'remark'   => '',
        'nickname' => 'vbot',
    ],
    'blacklist' => [
        'type' => [
            'text', 'emoticon'
        ],
        'warn' => function ($message) {
            $nickname = $message['fromType'] == 'Group' ? $message['sender']['NickName'] : $message['from']['NickName'];
            \Hanson\Vbot\Message\Text::send($message['from']['UserName'], "@{$nickname} 警告！你的消息频率略高！");
        },
        'block' => function ($message) {
            $nickname = $message['fromType'] == 'Group' ? $message['sender']['NickName'] : $message['from']['NickName'];
            \Hanson\Vbot\Message\Text::send($message['from']['UserName'], "@{$nickname} 你已被永久拉黑！");
        },
    ]
],
```

## 扩展负责人

[HanSon](https://github.com/HanSon)

h@hanc.cc
