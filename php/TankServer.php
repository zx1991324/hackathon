<?php
namespace hackathon\php;

error_reporting(E_ALL);

require_once '/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';
require_once '/hackathon/hackathon/gen_php/tank/player/PlayerServer.php';
require_once '/hackathon/hackathon/gen_php/tank/player/Types.php';
use tank\player\Order;
use tank\player\Position;
use tank\player\Tank;
use tank\player\Shell;
use tank\player\GameState;
use tank\player\Args;
use Thrift\ClassLoader\ThriftClassLoader;
use tank\player\PlayerServerIf;
use tank\player\PlayerServerProcessor;


$GEN_DIR = realpath(dirname(__FILE__).'/../') . '/gen_php';
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift','/thrift/lib/php/lib/');
$loader->registerDefinition('hackathon',$GEN_DIR);
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set('display_errors',"stderr");
}

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class PlayerServerHandler implements PlayerServerIf{

    public function uploadMap(array $gamemap){
        var_dump('MAP:'. json_encode($gamemap));
        return array();
    }
    /**
     * @param \tank\player\Args $arguments
     */
    public function uploadParamters(Args $arguments){
        var_dump('Arg:' . json_encode($arguments));
        return array();
    }
    /**
     * Assign a list of tank id to the player.
     * each player may have more than one tank, so the parameter is a list.
     *
     *
     * @param int[] $tanks
     */
    public function assignTanks(array $tanks){
        var_dump('Tank:' . json_encode($tanks));
        return array();
    }
    /**
     * Report latest game state to player.
     *
     *
     * @param \tank\player\GameState $state
     */
    public function latestState(GameState $state){
        return array();
    }
    /**
     * Ask for the tank orders for this round.
     * If this funtion does not return orders within the given round timeout, game engine will make all this player's tank to stick around.
     *
     * @return \tank\player\Order[]
     */
    public function getNewOrders(){
        return array('move');
    }
}
header('Content-Type','application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo PHP_EOL;
}

$handler = new PlayerServerHandler();
$processor = new PlayerServerProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport,true,true);

$transport->open();
$processor->process($protocol,$protocol);
$transport->close();