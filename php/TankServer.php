<?php
namespace hackathon\php;

error_reporting(E_ALL);
var_dump('server is runing.....................');
require_once '/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';
require_once '/hackathon/hackathon/gen_php/tank/player/PlayerServer.php';
require_once '/hackathon/hackathon/gen_php/tank/player/Types.php';
require_once '/hackathon/hackathon/gen_php/tank/player/AStarSearch.php';
use tank\player\Node;
use tank\player\Order;
use tank\player\Position;
use tank\player\Tank;
use tank\player\Shell;
use tank\player\GameState;
use tank\player\Args;
use Thrift\ClassLoader\ThriftClassLoader;
use tank\player\PlayerServerIf;
use tank\player\PlayerServerProcessor;
use tank\player\AStar;
use tank\player\myNode;


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
    private $arrState = null;
    private $flagPos = null;
    private $AStarMap = null;
    private $arrTankStates = null;
    private $myFirstTank = array();

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
    private $arrOne = array(
        array(
            'x' => 7,
            'y' => 9,
        ),
        array(
            'x' => 8,
            'y' => 8,
        ),
        array(
            'x' => 9,
            'y' => 7,
        ),
        array(
            'x' => 10,
            'y' => 6,
        ),
    );
    private $arrTwo = array(
        array(
            'x' => 12,
            'y' => 10,
        ),
        array(
            'x' => 11,
            'y' => 11,
        ),
        array(
            'x' => 10,
            'y' => 12,
        ),
        array(
            'x' => 9,
            'y' => 13,
        ),
    );

    public function uploadMap(array $gamemap){
        $this->AStarMap = $gamemap;
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
        $arrState = json_decode(json_encode($state), true);
        $this->arrTankStates = $arrState['tanks'];
        if(isset($arrState['flagPos'])){
            $this->flagPos = $arrState['flagPos'];
        }
        /*foreach($arrState['tanks'] as $arrTank){
            if($arrTank['id']){

            }
        }
        for($index = 0;$index < $this->intTankNum;$index++){
            $this->myFirstTank =
        }*/

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
        if(empty($this->flagPos)) {
            for($intIndex = 0; $intIndex <= 3; $intIndex++){
                $intRandomOrder = rand(0,3);
                $intRandomDirection = rand(1,4);
                if(0 == $intRandomOrder || 2 == $intRandomOrder){
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
        }else {
            $objEndNode = new myNode($this->flagPos['x'],$this->flagPos['y']);
            for($intIndex = 0;$intIndex < $this->intTankNum;$intIndex++){
                $intTankId = $this->arrTanks[$intIndex];
                foreach($this->arrTankStates as $arrTankStates){
                    if($intTankId == $arrTankStates['id']){
                        $objStartNode = new myNode($arrTankStates['pos']['x'],$arrTankStates['pos']['y']);
                        //echo $arrTankStates['pos']['x']  .',' .$arrTankStates['pos']['y']  . "\n";
                        //echo $this->flagPos['x'] . '-,-' . $this->flagPos['y'] . "\n";
                        $ObjAStar = new AStar($this->AStarMap);
                        $arrNextNode = $ObjAStar->aStarSearch($objStartNode, $objEndNode);
                       // echo $arrNextNode->getIntX() . '+++++' . $arrNextNode->getIntY() . "\n";
                        $tmpDir = null;
                        if($arrNextNode->getIntX() == $objStartNode->getIntX()){
                            if($arrNextNode->getIntY() < $objStartNode->getIntY()){
                                $tmpDir = 3;
                            } else {
                                $tmpDir = 4;
                            }
                        } else {
                            if($arrNextNode->getIntX() < $objStartNode->getIntX()){
                                $tmpDir = 1;
                            } else {
                                $tmpDir = 2;
                            }
                        }
                        $arrOrderTmp = array();
                        $arrOrderTmp['tankId'] = $intTankId;
                        if($tmpDir == $arrTankStates['dir']){
                            $arrOrderTmp['order'] = 'move';
                        } else {
                            $arrOrderTmp['order'] = 'turnTo';
                            $arrOrderTmp['dir'] = $tmpDir;
                        }
                        $objOrder = new Order($arrOrderTmp);
                        $arrOrderList[] = $objOrder;
                    }
                }
            }
        }
        //var_dump($arrOrderList);
        echo  count($arrOrderList) . "\n";
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