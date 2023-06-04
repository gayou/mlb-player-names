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
     * 引退した選手は名前を取得できない
     * 
     */
    public function testRetirePlayer()
    {
        // 松井秀喜
        $this->assertSame(MlbPlayersName::japanize('Hideki Matsui'), '');
    }
}