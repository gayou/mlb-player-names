# mlb-players-name
メジャーリーグの選手名を日本語表記にするライブラリ。

英語表記・日本語表記の対応表は以下のWikipediaのページをクロールして生成する。

メジャーリーグベースボールの選手一覧 - Wikipedia
https://ja.wikipedia.org/wiki/%E3%83%A1%E3%82%B8%E3%83%A3%E3%83%BC%E3%83%AA%E3%83%BC%E3%82%B0%E3%83%99%E3%83%BC%E3%82%B9%E3%83%9C%E3%83%BC%E3%83%AB%E3%81%AE%E9%81%B8%E6%89%8B%E4%B8%80%E8%A6%A7


## 使い方
### インストール、初期設定
```
# install
git clone git@github.com:gayou/mlb-players-name.git

# setup
cd mlb-players-name

# 選手名の英語表記、日本語表記のcsvファイルを生成
composer setup-mlb-players-name
```

### サンプルコード
```php
<?php
require_once "vendor/autoload.php";

use Gayou\MlbPlayersName\MlbPlayersName;

MlbPlayersName::init();
echo MlbPlayersName::japanize('Mike Troutt').PHP_EOL;
echo MlbPlayersName::japanize('Shohei Ohtani').PHP_EOL;
```

### 実行結果
```
マイク・トラウト
大谷翔平
```
