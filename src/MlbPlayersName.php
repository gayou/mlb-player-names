<?php namespace Gayou\MlbPlayersName;

use Gayou\MlbPlayersName\MlbPlayersNameConst;

/**
 * MLB選手の名前を日本語表記にする
 *
 */
class MlbPlayersName {
    
    private static $map = [];
    
    function __construct()
    {
    }

    
    public static function init()
    {
        // 選手名のmapを作成
        self::$map = self::loadCsvData();
    }


    private static function loadCsvData() : array
    {
        $map = [];

        // csvファイルをロードして選手名のmapを生成
        $fp = fopen(MlbPlayersNameConst::DATA_FILEPATH, 'r');

        while ($line = fgetcsv($fp)) {
            $map[$line[0]] = $line[1];
        }

        fclose($fp);

        return $map;
    }


    /**
     * 選手名を日本語表記（カタカナ、日本語）で返す
     */
    public static function japanize(string $name) : string
    {
        if (array_key_exists($name, self::$map)) {
            return self::$map[$name];
        }

        return '';
    }
    
}
