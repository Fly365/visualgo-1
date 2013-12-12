<?php
  class Heap{
    protected $heapArr;

    public function __construct(){
      $this->heapArr = array();
      $this->heapArr[] = INFINITY;
    }

    public function seedRng($seed){
      mt_srand($seed);
    }

    public function buildRandomHeap($amt){
      $values = array();

      for($i = 0; $i < $amt; $i++){
        $newElement = mt_rand(1,99);
        if(!in_array($newElement, $values){
          $values[] = $newElement;
        }
        else $i--;
      }

      $this->heapify($values);
    }

    public function buildUnshiftedHeap($amt){
      $values = array();

      for($i = 0; $i < $amt; $i++){
        $newElement = mt_rand(1,99);
        if(!in_array($newElement, $values){
          $values[] = $newElement;
        }
        else $i--;
      }
    }

    public function heapify($arr){
      $this->heapArr = array_merge($this->heapArr, $arr);

      $shiftedDown = array();

      for($i = count($this->heapArr)-1; $i >= 1; $i--){
        $value = $this->heapArr[$i];
        $shiftDownSequence = array();
        $this->shiftDown($i);
        if(count($shiftDownSequence)>0) $shiftedDown[] = $value;
      }

      return $shiftedDown;
    }

    public function toGraphState(){
      $graphState = array("vl" => array(), "el" => array());

      for($i = 1; $i < count($this->heapArr); $i++){
        $level = (int)log($i,2);
        $nodeInLevel = (int)pow(2,$level);
        vertexState = array(
          "cxPercentage" => ($i/2)*(100/$nodeInLevel) + ($i - $i/2)*(100/($nodeInLevel*2)),
          "cyPercentage" => 10*($level + 1),
          "text" => $value
          );
        $graphState["vl"] += array($i => $vertexState);
        if($i != 1){
          $edgeState = array(
            "vertexA" => $this->parent($i),
            "vertexB" => $i
            );
          $graphState["el"] += array($i => $edgeState);
        }
      }

      foreach($this->heapArr as $value){
        $vertexState = array(
          "cxPercentage" => $value->cxPercentage,
          "cyPercentage" => $value->cyPercentage,
          "text" => $value
          );
        $graphState["vl"] += array($key => $vertexState);
        if(!$isRoot){
          $edgeState = array(
            "vertexA" => $value->parent->key,
            "vertexB" => $value->key
            );
          $graphState["el"] += array($key => $edgeState);
        }
      }

      return $graphState;
    }

    public function getHeapArray(){
      return $this->heapArr();
    }

    public function insert($val){
      $shiftUpSequence = array();
      if(in_array($val, $this->heapArr)) return;
      $this->heapArr[] = $val;
      $this->shiftUp(count($this->heapArr) - 1, $shiftUpSequence);
      return $shiftUpSequence;
    }

    public function extractMax(){
      $shiftDownSequence = array();
      $maxValue = $this->heapArr[1];
      $this->heapArr[1] = $this->heapArr[count($this->heapArr)-1];
      unset($this->heapArr[count($this->heapArr)-1];
      $this->shiftDown(1);
      return $shiftDownSequence;
    }

    public function heapSort(){
      while(count($this->heapArr) > 1){
        $this->extractMax();
      }
    }

    public function size(){
      return count($this->heapArr) - 1;
    }

    protected function shiftUp($i, &$shiftUpSequence){
      if($this->heapArr[$i] > $this->heapArr[$this->parent($i)]){
        $shiftUpSequence[] = $$this->heapArr[$this->parent($i)];
        $temp = $this->heapArr[$i];
        $this->heapArr[$i] = $this->heapArr[$this->parent($i)];
        $this->heapArr[$this->parent($i)] = $temp;
        $this->shiftUp($this->parent($i), $shiftUpSequence);
      }
    }

    protected function shiftDown($i, &$shiftDownSequence){
      $leftChild = -1;
      $rightChild = -1;

      if($this->left($i) > count($this->heapArr)-1) return;

      $leftChild = $this->heapArr[$this->left($i)];
      if($this->right($i) > count($this->heapArr)-1) $rightChild = $this->heapArr[$this->right($i)];
      if($this->heapArr[$i] < max($leftChild, $rightChild)){
        $temp = $this->heapArr[$i];
        if($leftChild > $rightChild){
          $shiftDownSequence[] = $this->heapArr[$this->left($i)];
          $this->heapArr[$i] = $this->heapArr[$this->left($i)];
          $this->heapArr[$this->left($i)] = $temp;
          $this->shiftDown($this->left($i), $shiftDownSequence);
        }
        else if($rightChild != -1){
          $shiftDownSequence[] = $this->heapArr[$this->right($i)];
          $this->heapArr[$i] = $this->heapArr[$this->right($i)];
          $this->heapArr[$this->right($i)] = $temp;
          $this->shiftDown($this->right($i), $shiftDownSequence);
        }
        
      }
    }

    protected function parent($i){
      return floor($i/2);
    }

    protected function left($i){
      return $i*2;
    }

    protected function right($i){
      return $i*2+1;
    }
  }
?>