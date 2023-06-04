# mlb-players-name
メジャーリーグの選手名を日本語表記にするライブラリ。

## 使い方
### インストール、初期設定
```
# install
git clone git@github.com:gayou/mlb-players-name.git

# setup
cd mlb-players-name
composer setup-mlb-players-name
```

`composer setup-mlb-players-name` で選手名の英語表記、日本語表記のcsvファイルを生成。

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
