<?php namespace Gayou\MlbPlayersName\Test;

use PHPUnit\Framework\TestCase;
use Gayou\MlbPlayersName\CsvDataCreator;
use Gayou\MlbPlayersName\MlbPlayersName;

class MlbPlayersNameTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        CsvDataCreator::setup();
        MlbPlayersName::init();
    }

    /**
     * 現役選手の名前を取得できること
     * 
     */
    public function testJapanize()
    {
        // マイク・トラウト
        $this->assertSame(MlbPlayersName::japanize('Mike Trout'), 'マイク・トラウト');

        // 大谷翔平
        $this->assertSame(MlbPlayersName::japanize('Shohei Ohtani'), '大谷翔平');
    }

    /**
     * 現役選手の名前を取得できること（正規化した名前）
     * 
     */
    public function testJapanizeNormalize()
    {
        // Rafael Marchán -> ラファエル・マルチャン
        $this->assertSame(MlbPlayersName::japanize('Rafael Marchán'), 'ラファエル・マルチャン');

        // Yohan Ramírez -> ヨハン・ラミレス
        $this->assertSame(MlbPlayersName::japanize('Yohan Ramírez'), 'ヨハン・ラミレス');
        
        // José Berríos -> ホセ・ベリオス
        $this->assertSame(MlbPlayersName::japanize('José Berríos'), 'ホセ・ベリオス');

        // Reynaldo López -> レイナルド・ロペス
        $this->assertSame(MlbPlayersName::japanize('Reynaldo López'), 'レイナルド・ロペス');

        // Nasim Nuñez -> ナシム・ヌニェス
        $this->assertSame(MlbPlayersName::japanize('Nasim Nuñez'), 'ナシム・ヌニェス');
    }

    /**
     * 引退した選手は名前を取得できない
     * 
     */
    public function testRetirePlayer()
    {
        // 松井秀喜
        $this->assertSame(MlbPlayersName::japanize('Hideki Matsui'), null);
    }
}