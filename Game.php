<?php

namespace CardPairs;

include_once('Runnable.php');
include_once('Deck.php');

class Game implements Runnable{
	
	/**
	 * @var Deck
	 */
	protected $_deck;
	
	/**
	 * @var Array
	 */
	protected $_Matches;
	
	/**
	 * @var Array
	 */
	protected $_Found;
	
	/**
	 * @var integer
	 */
	protected $_Turns;	
	
	public function __construct() {
		echo 'Lets play pairs...' . PHP_EOL . PHP_EOL;
		
		$this->_deck = new Deck();
		$this->_Found = array();
		$this->_Matches = array();
		$this->_Turn = 0;
		echo PHP_EOL . 'The Deck is now shuffled playing game' . PHP_EOL . PHP_EOL;
	}

	/**
	 * (non-PHPdoc)
	 * @see \CardPairs\Runnable::Run()
	 */
	public function Run() {
	
		do {

			$choice1 = rand(0, $this->_deck->getLength()-1);
			$choice2 = rand(0, $this->_deck->getLength()-1);
			
			if($choice1 != $choice2) {
				echo $this->_deck->cardAt($choice1);
				echo $this->_deck->cardAt($choice2);
			
				if($this->_deck->getCardAt($choice1)->faceValueIsEqual($this->_deck->getCardAt($choice2))) {
					echo 'The cards match' . PHP_EOL;
					$this->_deck->removeCard($choice1);
					$this->_deck->removeCard($choice2);
				}
				
				else {
					echo 'The cards do not match' . PHP_EOL;
				}
				$this->_Turns++;
				printf('%d cards left to match %s', $this->_deck->getLength(), PHP_EOL);
			}
		}
		while($this->_deck->getLength()-1 > 2);
		
		printf('Completed in %d turns', $this->_Turns);
	}
}

$game = new Game();
$game->Run();


