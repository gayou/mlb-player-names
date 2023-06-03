<?php namespace Gayou\MlbPlayersName\Test;

use PHPUnit\Framework\TestCase;
use Gayou\MlbPlayersName\MlbPlayersName;

class MlbPlayersNameTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        MlbPlayersName::init();
    }


    public function testJapanize()
    {
        // ホセ・アブレイユ
        $this->assertSame(MlbPlayersName::japanize('Jose Abreu'), 'ホセ・アブレイユ');

        // 松井秀喜
        $this->assertSame(MlbPlayersName::japanize('Hideki Matsui'), '松井秀喜');
    }
}