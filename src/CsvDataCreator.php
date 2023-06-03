<?php namespace Gayou\MlbPlayersName;

use DOMDocument;
use DOMXpath;

use Gayou\MlbPlayersName\MlbPlayersNameConst;

/**
 * MLBの選手名のcsvデータを生成
 *
 */
class CsvDataCreator {
    
    function __construct()
    {
    }
    
    public static function setup()
    {
        // WikipediaからMLB選手の一覧を取得
        self::loadWikipedia();

        // 選手名の英語表記、日本語表記のcsvファイルを作成
        self::createCsvData();
    }


    private static function loadWikipedia()
    {
        // WikipediaからMLB選手の一覧を取得
        $html = '';
        for ($i = ord('A'); $i <= ord('Z'); $i++) {
            $cache_file_path = MlbPlayersNameConst::CACHE_DIR.chr($i).'.html';

            // ファイルキャッシュが存在する場合
            if (file_exists($cache_file_path)) {
                $html = file_get_contents($cache_file_path);
            }
            else {
                $html = file_get_contents(MlbPlayersNameConst::RESOURCE_URL.'_'.chr($i));
                file_put_contents($cache_file_path, $html);
            }
        }
    }


    private static function createCsvData()
    {
        $data = [];
        $document = new DOMDocument();
        foreach (glob(MlbPlayersNameConst::CACHE_DIR.'*.html') as $file_path) {
            // htmlファイルロード
            $html = file_get_contents($file_path);

            if (strlen($html) == 0) continue;

            @$document->loadHTML($html);

            $xpath = new DOMXpath($document);
            $result = $xpath->query('//table[@class="wikitable"]/tbody/tr[count(td) = 5]');
            foreach ($result as $row) {
                $player = $xpath->query(".//td", $row);
                $data[] = $player->item(0)->textContent.",".$player->item(1)->textContent;
            }
        }

        file_put_contents(MlbPlayersNameConst::DATA_FILEPATH, implode("\n", $data));
    }
    
}
