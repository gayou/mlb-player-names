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
        $html = file_get_contents(MlbPlayersNameConst::RESOURCE_URL);

        $document = new DOMDocument();
        @$document->loadHTML($html);

        $xpath = new DOMXpath($document);
        $result = $xpath->query('//table[@class="toc plainlinks"]/tbody/tr/td/a[@href]');
        foreach ($result as $anchor) {
            $href = $anchor->getAttribute('href');
            
            $initial = $anchor->textContent;
            $cache_file_path = MlbPlayersNameConst::CACHE_DIR.$initial.'.html';

            $html = file_get_contents("https://ja.wikipedia.org".$href);
            file_put_contents($cache_file_path, $html);
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

            // htmlファイルを削除
            unlink($file_path);
        }

        file_put_contents(MlbPlayersNameConst::DATA_FILEPATH, implode("\n", $data));
    }
    
}
