<?php namespace Gayou\MlbPlayersName;

use Gayou\MlbPlayersName\MlbPlayersNameConst;

/**
 * MLB選手の名前を日本語表記にする
 *
 */
class MlbPlayersName {
    
    private static $map = [];
        
    /**
     * 初期化処理
     * 
     */
    public static function init() : void
    {
        // 選手名のmapを作成
        self::$map = self::loadCsvData();
    }


    /**
     * csvファイルを読み込んで選手名の英語表記、日本語表記の連想配列を生成
     * 
     * @return array 選手名の英語表記、日本語表記の連想配列
     */
    private static function loadCsvData() : array
    {
        $map = [];

        // csvファイルをロードして選手名の連想配列を生成
        $fp = fopen(MlbPlayersNameConst::DATA_FILEPATH, 'r');

        while ($line = fgetcsv($fp)) {
            $map[$line[0]] = $line[1];
        }

        fclose($fp);

        return $map;
    }


    /**
     * 選手名を日本語表記（カタカナ、日本語）で返す
     * 
     * @param string $name 選手名（英語表記）
     * @param bool $normalize アルファベットの正規化を実施
     * @return string|null 選手名（日本語表記）、選手名が見つからなかった場合はnull
     */
    public static function japanize(string $name, bool $normalize = true) : string|null
    {
        $japanize = self::search($name);

        // 見つからなかった場合は正規化した人名で探す
        if ($japanize === null && $normalize) {
            $normalized_name = strtr($name, MlbPlayersNameConst::NORMALIZE_MAP);
            $japanize = self::search($normalized_name);
        }

        return $japanize;
    }


    private static function search(string $name) : string|null
    {
        if (array_key_exists($name, self::$map)) {
            return self::$map[$name];
        }

        return null;
    }
    
}
