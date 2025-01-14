<?php

namespace Gayou\MlbPlayersName;

/**
 * 定数クラス
 *
 */
class MlbPlayersNameConst {

    public const RESOURCE_URL = 'https://ja.wikipedia.org/wiki/%E3%83%A1%E3%82%B8%E3%83%A3%E3%83%BC%E3%83%AA%E3%83%BC%E3%82%B0%E3%83%99%E3%83%BC%E3%82%B9%E3%83%9C%E3%83%BC%E3%83%AB%E3%81%AE%E9%81%B8%E6%89%8B%E4%B8%80%E8%A6%A7';
    
    public const CACHE_DIR = __DIR__.'/../data/';

    public const DATA_FILEPATH_ALL = __DIR__.'/../data/allplayer.csv';

    public const DATA_FILEPATH= __DIR__.'/../data/player.csv';

    public const NORMALIZE_MAP = [
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u',
        'ñ' => 'n',
        'Á' => 'A',
        'É' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ú' => 'U',
        'Ñ' => 'N'
    ];
}
