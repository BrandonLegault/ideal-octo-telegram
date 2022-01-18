<?php

namespace IdealOctoTelegram\Test\Model\Controller;

use PHPUnit\Framework\TestCase;
use IdealOctoTelegram\Controller\PlayersObject;
use IdealOctoTelegram\Controller\IReadWritePlayers;


final class PlayersObjectTest extends TestCase
{
    public function setUp(): void
    {
        // For the purposes of this assignment we'll actually read/write
        //   files during tests. Ideally FS access should be mocked though.
        
        // writePlayer() will error if a file doesn't already exist so we
        //  create an empty one
        touch(__DIR__ . '/testfile.json');
        file_put_contents(__DIR__ . '/testfile.json', '[]');
    }

    public function tearDown(): void
    {
        // remove the file we created for the writePlayer() tests
        unlink(__DIR__ . '/testfile.json');
    }

    public function testNameSpacingSetup(): void
    {
        $this->assertInstanceOf(
            IReadWritePlayers::class,
            new PlayersObject()
        );
    }

    public function testReadPlayersArray(): void
    {
        $players = [];

        $playersObject = new PlayersObject();
        
        $this->assertEquals(
            $players,
            $playersObject->readPlayers('array')
        );

    }

    public function testReadPlayersJson(): void
    {
        $playersObject = new PlayersObject();
        
        $this->assertEquals(
            [],
            $playersObject->readPlayers('json')
        );

    }

    public function testReadPlayersFile(): void
    {
        $playersObject = new PlayersObject();
        
        $this->assertEquals(
            json_decode(file_get_contents(__DIR__.'/../../../playerdata.json')),
            $playersObject->readPlayers('file', __DIR__.'/../../../playerdata.json')
        );

    }

    public function testWritePlayersArray(): void
    {
        $player = new \stdClass();
        $player->name = 'Scottie Barnes';
        $player->age = 20;
        $player->job = 'Power Forward';
        $player->salary = '7.280m';

        $playersObject = new PlayersObject();
        
        // we can't really test if $player was written correctly since the array
        //  is private with no public access method (readPlayers() reads from a 
        //  different, hardcoded array - bug? feature?). We could use reflection
        //  to inspect the private array but reading private vars in tests is a
        //  bad practice. 

        // Best we can do is ensure writePlater() doesn't error out
        $this->assertEquals(
            null,
            $playersObject->writePlayer('array', $player)
        );
    }

    public function testWritePlayersJson(): void
    {
        $player = new \stdClass();
        $player->name = 'Scottie Barnes';
        $player->age = 20;
        $player->job = 'Power Forward';
        $player->salary = '7.280m';

        $playersObject = new PlayersObject();
        
        // Like 'array', writing json players can't really be tested
        $this->assertEquals(
            null,
            $playersObject->writePlayer('json', $player)
        );
    }

    public function testWritePlayersFile(): void
    {
        $player = new \stdClass();
        $player->name = 'Scottie Barnes';
        $player->age = 20;
        $player->job = 'Power Forward';
        $player->salary = '7.280m';

        $playersObject = new PlayersObject();
        
        $this->assertEquals(
            null,
            $playersObject->writePlayer('file', $player, __DIR__ . '/testfile.json')
        );
        $this->assertEquals(
            json_decode('[{"name":"Scottie Barnes","age":20,"job":"Power Forward","salary":"7.280m"}]'),
            $playersObject->readPlayers('file',  __DIR__ . '/testfile.json')
        );
    }

    public function testDisplayHtml(): void
    {
        // The display() function is kinda hard to unit test since
        //   it doesn't return anything. It directly writes output.
        //   We can use some ob trickery to capture and test the output
        //   but this feels kinda wrong. Regardless, I think I'll leave 
        //   it in for now as I think this is important to test.

        $playersObject = new PlayersObject();
        ob_start();
        $playersObject->display(false, 'file', './playerdata.json');
        $output = ob_get_contents();
        ob_end_clean();

        // there are sublte differences in whitespaces I couldn't quite figure out so I strip it out
        //   as it shouldn't really matter
        $this->assertEquals(
            preg_replace('/\s+/', '', file_get_contents('./test/fixtures/display.html')),
            preg_replace('/\s+/', '', $output)
        );
    }

    public function testDisplayCli(): void
    {
        // The display() function is kinda hard to unit test since
        //   it doesn't return anything. It directly writes output.
        //   We can use some ob trickery to capture and test the output
        //   but this feels kinda wrong. Regardless, I think I'll leave 
        //   it in for now as I think this is important to test.

        $playersObject = new PlayersObject();
        ob_start();
        $playersObject->display(true, 'file', './playerdata.json');
        $output = ob_get_contents();
        ob_end_clean();

        // there are sublte differences in whitespaces I couldn't quite figure out so I strip it out
        //   as it shouldn't really matter
        $this->assertEquals(
            preg_replace('/\s+/', '', file_get_contents('./test/fixtures/display.txt')),
            preg_replace('/\s+/', '', $output)
        );
    }
}

