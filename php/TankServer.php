<?php
namespace hackathon\php;

error_reporting(E_ALL);
var_dump('TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT');
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

    private $arrArgument = null;
    private $intTankNum = 0;
    private $arrTanks = null;
    private $ARRAY_ORDER = array(
        0 => 'stop',
        1 => 'turnTo',
        2 => 'fire',
        3 => 'move',
    );
    private $ARRAY_DIRECTION = array(
        1 => 'UP',
        2 => 'DOWN',
        3 => 'LEFT',
        4 => 'RIGHT',
    );
    public function uploadMap(array $gamemap){
    }
    /**
     * @param rgs $arguments
     */
    public function uploadParamters(Args $arguments){
        var_dump($arguments);
        $this->arrArgument = $arguments;
    }
    /**
     * Assign a list of tank id to the player.
     * each player may have more than one tank, so the parameter is a list.
     *
     *
     * @param int[] $tanks
     */
    public function assignTanks(array $tanks){
        $this->arrTanks = $tanks;
        $this->intTankNum = count($tanks);
    }
    /**
     * Report latest game state to player.
     *
     *
     * @param \tank\player\GameState $state
     */
    public function latestState(GameState $state){
        //var_dump($state);
    }
    /**
     * Ask for the tank orders for this round.
     * If this funtion does not return orders within the given round timeout, game engine will make all this player's tank to stick around.
     *
     * @return \tank\player\Order[]
     */
    public function getNewOrders(){
        $arrOrders = array();
        $arrOrderList = array();
        for($intIndex = 0; $intIndex <= 3; $intIndex++){
            $intRandomOrder = rand(0,3);
            $intRandomDirection = rand(1,4);
            if(0 == $intRandomOrder){
                continue;
            }
            $arrOrderTmp = array();
            $arrOrderTmp['order'] = $this->ARRAY_ORDER[$intRandomOrder];
            $intTankId = $this->arrTanks[$intIndex];
            $arrOrderTmp['tankId'] = $intTankId;
            $arrOrderTmp['dir'] = $intRandomDirection;

            $objOrder = new Order($arrOrderTmp);
            $arrOrderList[] = $objOrder;
        }
        return $arrOrderList;
    }
}
header('Content-Type','application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo PHP_EOL;
}
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TForkingServer;
use Thrift\Server\TServerSocket;

$serverTransport = new TServerSocket("0.0.0.0", 80);
$clientTransport = new TTransportFactory();
$binaryProtocol = new TBinaryProtocolFactory();

$handler = new PlayerServerHandler();
$processor = new PlayerServerProcessor($handler);

$server = new TForkingServer(
    $processor,
    $serverTransport,
    $clientTransport,
    $clientTransport,
    $binaryProtocol,
    $binaryProtocol
);
$server->serve();
/*$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport,true,true);

$transport->open();
$processor->process($protocol,$protocol);
$transport->close();*/