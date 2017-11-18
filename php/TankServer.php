<?php
namespace tank\php;

error_reporting(E_ALL);

require_once '/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';
use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = realpath(dirname(__FILE__).'/../') . '/gen_php';
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift','/thrift/lib/php/lib/');
$loader->registerDefinition('tank',$GEN_DIR);
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set('display_errors',"stderr");
}

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class PlayerServerHandler implements \tank\player\PlayerServerIf{

    public function uploadMap(array $gamemap){
        var_dump($gamemap);
    }
    /**
     * @param \tank\player\Args $arguments
     */
    public function uploadParamters(\tank\player\Args $arguments){

    }
    /**
     * Assign a list of tank id to the player.
     * each player may have more than one tank, so the parameter is a list.
     *
     *
     * @param int[] $tanks
     */
    public function assignTanks(array $tanks){

    }
    /**
     * Report latest game state to player.
     *
     *
     * @param \tank\player\GameState $state
     */
    public function latestState(\tank\player\GameState $state){

    }
    /**
     * Ask for the tank orders for this round.
     * If this funtion does not return orders within the given round timeout, game engine will make all this player's tank to stick around.
     *
     * @return \tank\player\Order[]
     */
    public function getNewOrders(){

    }
}
header('Content-Type','application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo PHP_EOL;
}

$handler = new \tank\php\PlayerServerHandler();
$processor = new \tank\player\PlayerServerProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport,true,true);

$transport->open();
$processor->process($protocol,$protocol);
$transport->close();