<?php
/**
 * Autogenerated by Thrift Compiler (1.0.0-dev)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


interface PlayerServerIf {
  /**
   * Upload the map to player.
   * The map is made of two-dimesional array of integer. The first dimension means row of the map. The second dimension means column of the map.
   * For example, if N is the map size, position(0,0) means upper left corner, position(0,N) means the upper right corner.
   * In the map array, 0 means empty field, 1 means barrier, 2 means woods, 3 means flag.
   * 
   * 
   * @param (int[])[] $gamemap
   */
  public function uploadMap(array $gamemap);
  /**
   * @param \Args $arguments
   */
  public function uploadParamters(\Args $arguments);
  /**
   * Assign a list of tank id to the player.
   * each player may have more than one tank, so the parameter is a list.
   * 
   * 
   * @param int[] $tanks
   */
  public function assignTanks(array $tanks);
  /**
   * Report latest game state to player.
   * 
   * 
   * @param \GameState $state
   */
  public function latestState(\GameState $state);
  /**
   * Ask for the tank orders for this round.
   * If this funtion does not return orders within the given round timeout, game engine will make all this player's tank to stick around.
   * 
   * @return \Order[]
   */
  public function getNewOrders();
}


class PlayerServerClient implements \PlayerServerIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function uploadMap(array $gamemap)
  {
    $this->send_uploadMap($gamemap);
    $this->recv_uploadMap();
  }

  public function send_uploadMap(array $gamemap)
  {
    $args = new \PlayerServer_uploadMap_args();
    $args->gamemap = $gamemap;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'uploadMap', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('uploadMap', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_uploadMap()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\PlayerServer_uploadMap_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \PlayerServer_uploadMap_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    return;
  }

  public function uploadParamters(\Args $arguments)
  {
    $this->send_uploadParamters($arguments);
    $this->recv_uploadParamters();
  }

  public function send_uploadParamters(\Args $arguments)
  {
    $args = new \PlayerServer_uploadParamters_args();
    $args->arguments = $arguments;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'uploadParamters', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('uploadParamters', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_uploadParamters()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\PlayerServer_uploadParamters_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \PlayerServer_uploadParamters_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    return;
  }

  public function assignTanks(array $tanks)
  {
    $this->send_assignTanks($tanks);
    $this->recv_assignTanks();
  }

  public function send_assignTanks(array $tanks)
  {
    $args = new \PlayerServer_assignTanks_args();
    $args->tanks = $tanks;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'assignTanks', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('assignTanks', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_assignTanks()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\PlayerServer_assignTanks_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \PlayerServer_assignTanks_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    return;
  }

  public function latestState(\GameState $state)
  {
    $this->send_latestState($state);
    $this->recv_latestState();
  }

  public function send_latestState(\GameState $state)
  {
    $args = new \PlayerServer_latestState_args();
    $args->state = $state;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'latestState', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('latestState', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_latestState()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\PlayerServer_latestState_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \PlayerServer_latestState_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    return;
  }

  public function getNewOrders()
  {
    $this->send_getNewOrders();
    return $this->recv_getNewOrders();
  }

  public function send_getNewOrders()
  {
    $args = new \PlayerServer_getNewOrders_args();
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'getNewOrders', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('getNewOrders', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_getNewOrders()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\PlayerServer_getNewOrders_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \PlayerServer_getNewOrders_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    throw new \Exception("getNewOrders failed: unknown result");
  }

}


// HELPER FUNCTIONS AND STRUCTURES

class PlayerServer_uploadMap_args {
  static $isValidate = false;

  static $_TSPEC = array(
    1 => array(
      'var' => 'gamemap',
      'isRequired' => false,
      'type' => TType::LST,
      'etype' => TType::LST,
      'elem' => array(
        'type' => TType::LST,
        'etype' => TType::I32,
        'elem' => array(
          'type' => TType::I32,
          ),
        ),
      ),
    );

  /**
   * @var (int[])[]
   */
  public $gamemap = null;

  public function __construct($vals=null) {
    if (is_array($vals)) {
      if (isset($vals['gamemap'])) {
        $this->gamemap = $vals['gamemap'];
      }
    }
  }

  public function getName() {
    return 'PlayerServer_uploadMap_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->gamemap = array();
            $_size14 = 0;
            $_etype17 = 0;
            $xfer += $input->readListBegin($_etype17, $_size14);
            for ($_i18 = 0; $_i18 < $_size14; ++$_i18)
            {
              $elem19 = null;
              $elem19 = array();
              $_size20 = 0;
              $_etype23 = 0;
              $xfer += $input->readListBegin($_etype23, $_size20);
              for ($_i24 = 0; $_i24 < $_size20; ++$_i24)
              {
                $elem25 = null;
                $xfer += $input->readI32($elem25);
                $elem19 []= $elem25;
              }
              $xfer += $input->readListEnd();
              $this->gamemap []= $elem19;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_uploadMap_args');
    if ($this->gamemap !== null) {
      if (!is_array($this->gamemap)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('gamemap', TType::LST, 1);
      {
        $output->writeListBegin(TType::LST, count($this->gamemap));
        {
          foreach ($this->gamemap as $iter26)
          {
            {
              $output->writeListBegin(TType::I32, count($iter26));
              {
                foreach ($iter26 as $iter27)
                {
                  $xfer += $output->writeI32($iter27);
                }
              }
              $output->writeListEnd();
            }
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_uploadMap_result {
  static $isValidate = false;

  static $_TSPEC = array(
    );


  public function __construct() {
  }

  public function getName() {
    return 'PlayerServer_uploadMap_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_uploadMap_result');
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_uploadParamters_args {
  static $isValidate = false;

  static $_TSPEC = array(
    1 => array(
      'var' => 'arguments',
      'isRequired' => false,
      'type' => TType::STRUCT,
      'class' => '\Args',
      ),
    );

  /**
   * @var \Args
   */
  public $arguments = null;

  public function __construct($vals=null) {
    if (is_array($vals)) {
      if (isset($vals['arguments'])) {
        $this->arguments = $vals['arguments'];
      }
    }
  }

  public function getName() {
    return 'PlayerServer_uploadParamters_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->arguments = new \Args();
            $xfer += $this->arguments->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_uploadParamters_args');
    if ($this->arguments !== null) {
      if (!is_object($this->arguments)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('arguments', TType::STRUCT, 1);
      $xfer += $this->arguments->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_uploadParamters_result {
  static $isValidate = false;

  static $_TSPEC = array(
    );


  public function __construct() {
  }

  public function getName() {
    return 'PlayerServer_uploadParamters_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_uploadParamters_result');
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_assignTanks_args {
  static $isValidate = false;

  static $_TSPEC = array(
    1 => array(
      'var' => 'tanks',
      'isRequired' => false,
      'type' => TType::LST,
      'etype' => TType::I32,
      'elem' => array(
        'type' => TType::I32,
        ),
      ),
    );

  /**
   * @var int[]
   */
  public $tanks = null;

  public function __construct($vals=null) {
    if (is_array($vals)) {
      if (isset($vals['tanks'])) {
        $this->tanks = $vals['tanks'];
      }
    }
  }

  public function getName() {
    return 'PlayerServer_assignTanks_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::LST) {
            $this->tanks = array();
            $_size28 = 0;
            $_etype31 = 0;
            $xfer += $input->readListBegin($_etype31, $_size28);
            for ($_i32 = 0; $_i32 < $_size28; ++$_i32)
            {
              $elem33 = null;
              $xfer += $input->readI32($elem33);
              $this->tanks []= $elem33;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_assignTanks_args');
    if ($this->tanks !== null) {
      if (!is_array($this->tanks)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('tanks', TType::LST, 1);
      {
        $output->writeListBegin(TType::I32, count($this->tanks));
        {
          foreach ($this->tanks as $iter34)
          {
            $xfer += $output->writeI32($iter34);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_assignTanks_result {
  static $isValidate = false;

  static $_TSPEC = array(
    );


  public function __construct() {
  }

  public function getName() {
    return 'PlayerServer_assignTanks_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_assignTanks_result');
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_latestState_args {
  static $isValidate = false;

  static $_TSPEC = array(
    1 => array(
      'var' => 'state',
      'isRequired' => false,
      'type' => TType::STRUCT,
      'class' => '\GameState',
      ),
    );

  /**
   * @var \GameState
   */
  public $state = null;

  public function __construct($vals=null) {
    if (is_array($vals)) {
      if (isset($vals['state'])) {
        $this->state = $vals['state'];
      }
    }
  }

  public function getName() {
    return 'PlayerServer_latestState_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::STRUCT) {
            $this->state = new \GameState();
            $xfer += $this->state->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_latestState_args');
    if ($this->state !== null) {
      if (!is_object($this->state)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('state', TType::STRUCT, 1);
      $xfer += $this->state->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_latestState_result {
  static $isValidate = false;

  static $_TSPEC = array(
    );


  public function __construct() {
  }

  public function getName() {
    return 'PlayerServer_latestState_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_latestState_result');
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_getNewOrders_args {
  static $isValidate = false;

  static $_TSPEC = array(
    );


  public function __construct() {
  }

  public function getName() {
    return 'PlayerServer_getNewOrders_args';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_getNewOrders_args');
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServer_getNewOrders_result {
  static $isValidate = false;

  static $_TSPEC = array(
    0 => array(
      'var' => 'success',
      'isRequired' => false,
      'type' => TType::LST,
      'etype' => TType::STRUCT,
      'elem' => array(
        'type' => TType::STRUCT,
        'class' => '\Order',
        ),
      ),
    );

  /**
   * @var \Order[]
   */
  public $success = null;

  public function __construct($vals=null) {
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
    }
  }

  public function getName() {
    return 'PlayerServer_getNewOrders_result';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 0:
          if ($ftype == TType::LST) {
            $this->success = array();
            $_size35 = 0;
            $_etype38 = 0;
            $xfer += $input->readListBegin($_etype38, $_size35);
            for ($_i39 = 0; $_i39 < $_size35; ++$_i39)
            {
              $elem40 = null;
              $elem40 = new \Order();
              $xfer += $elem40->read($input);
              $this->success []= $elem40;
            }
            $xfer += $input->readListEnd();
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('PlayerServer_getNewOrders_result');
    if ($this->success !== null) {
      if (!is_array($this->success)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('success', TType::LST, 0);
      {
        $output->writeListBegin(TType::STRUCT, count($this->success));
        {
          foreach ($this->success as $iter41)
          {
            $xfer += $iter41->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class PlayerServerProcessor {
  protected $handler_ = null;
  public function __construct($handler) {
    $this->handler_ = $handler;
  }

  public function process($input, $output) {
    $rseqid = 0;
    $fname = null;
    $mtype = 0;

    $input->readMessageBegin($fname, $mtype, $rseqid);
    $methodname = 'process_'.$fname;
    if (!method_exists($this, $methodname)) {
      $input->skip(TType::STRUCT);
      $input->readMessageEnd();
      $x = new TApplicationException('Function '.$fname.' not implemented.', TApplicationException::UNKNOWN_METHOD);
      $output->writeMessageBegin($fname, TMessageType::EXCEPTION, $rseqid);
      $x->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
      return;
    }
    $this->$methodname($rseqid, $input, $output);
    return true;
  }

  protected function process_uploadMap($seqid, $input, $output) {
    $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
    if ($bin_accel)
    {
      $args = thrift_protocol_read_binary_after_message_begin($input, '\PlayerServer_uploadMap_args', $input->isStrictRead());
    }
    else
    {
      $args = new \PlayerServer_uploadMap_args();
      $args->read($input);
      $input->readMessageEnd();
    }
    $result = new \PlayerServer_uploadMap_result();
    $this->handler_->uploadMap($args->gamemap);
    $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($output, 'uploadMap', TMessageType::REPLY, $result, $seqid, $output->isStrictWrite());
    }
    else
    {
      $output->writeMessageBegin('uploadMap', TMessageType::REPLY, $seqid);
      $result->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
    }
  }
  protected function process_uploadParamters($seqid, $input, $output) {
    $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
    if ($bin_accel)
    {
      $args = thrift_protocol_read_binary_after_message_begin($input, '\PlayerServer_uploadParamters_args', $input->isStrictRead());
    }
    else
    {
      $args = new \PlayerServer_uploadParamters_args();
      $args->read($input);
      $input->readMessageEnd();
    }
    $result = new \PlayerServer_uploadParamters_result();
    $this->handler_->uploadParamters($args->arguments);
    $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($output, 'uploadParamters', TMessageType::REPLY, $result, $seqid, $output->isStrictWrite());
    }
    else
    {
      $output->writeMessageBegin('uploadParamters', TMessageType::REPLY, $seqid);
      $result->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
    }
  }
  protected function process_assignTanks($seqid, $input, $output) {
    $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
    if ($bin_accel)
    {
      $args = thrift_protocol_read_binary_after_message_begin($input, '\PlayerServer_assignTanks_args', $input->isStrictRead());
    }
    else
    {
      $args = new \PlayerServer_assignTanks_args();
      $args->read($input);
      $input->readMessageEnd();
    }
    $result = new \PlayerServer_assignTanks_result();
    $this->handler_->assignTanks($args->tanks);
    $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($output, 'assignTanks', TMessageType::REPLY, $result, $seqid, $output->isStrictWrite());
    }
    else
    {
      $output->writeMessageBegin('assignTanks', TMessageType::REPLY, $seqid);
      $result->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
    }
  }
  protected function process_latestState($seqid, $input, $output) {
    $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
    if ($bin_accel)
    {
      $args = thrift_protocol_read_binary_after_message_begin($input, '\PlayerServer_latestState_args', $input->isStrictRead());
    }
    else
    {
      $args = new \PlayerServer_latestState_args();
      $args->read($input);
      $input->readMessageEnd();
    }
    $result = new \PlayerServer_latestState_result();
    $this->handler_->latestState($args->state);
    $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($output, 'latestState', TMessageType::REPLY, $result, $seqid, $output->isStrictWrite());
    }
    else
    {
      $output->writeMessageBegin('latestState', TMessageType::REPLY, $seqid);
      $result->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
    }
  }
  protected function process_getNewOrders($seqid, $input, $output) {
    $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
    if ($bin_accel)
    {
      $args = thrift_protocol_read_binary_after_message_begin($input, '\PlayerServer_getNewOrders_args', $input->isStrictRead());
    }
    else
    {
      $args = new \PlayerServer_getNewOrders_args();
      $args->read($input);
      $input->readMessageEnd();
    }
    $result = new \PlayerServer_getNewOrders_result();
    $result->success = $this->handler_->getNewOrders();
    $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($output, 'getNewOrders', TMessageType::REPLY, $result, $seqid, $output->isStrictWrite());
    }
    else
    {
      $output->writeMessageBegin('getNewOrders', TMessageType::REPLY, $seqid);
      $result->write($output);
      $output->writeMessageEnd();
      $output->getTransport()->flush();
    }
  }
}

