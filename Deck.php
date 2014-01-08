<?php

namespace CardPairs;

include_once('Card.php');

class Deck {
	/**
	 * Constants defining our suites
	 */
	const SUITE_CLUBS = 1;
	const SUITE_SPADES = 2;
	const SUITE_HEARTS = 3;
	const SUITE_DIAMONDS = 4;
	
	/**
	 * Array of card names mapping to the constants
	 *
	 * @var array
	 */
	protected static $_suites = array (
			self::SUITE_CLUBS => 'Clubs',
			self::SUITE_SPADES => 'Spades',
			self::SUITE_HEARTS => 'Hearts',
			self::SUITE_DIAMONDS => 'Diamonds' 
	);
	
	/**
	 * Array of face values for the cards normalised to 0 index
	 *
	 * @var array
	 */
	protected static $_faceValues = array (
			'Two',
			'Three',
			'Four',
			'Five',
			'Six',
			'Seven',
			'Eight',
			'Nine',
			'Ten',
			'Jack',
			'Queen',
			'King',
			'Ace' 
	);
	
	/**
	 * @var array
	 */
	protected $_cardDeck = array();
	
	
	public function __construct() {
		
		echo 'Creating Deck' . PHP_EOL;
		
		$this->_cardDeck = array();
		//Add our jokers
		$this->_cardDeck[] = new Card(NULL, NULL, TRUE);
		$this->_cardDeck[] = new Card(NULL, NULL, TRUE);
		
		foreach(self::$_suites as $key=>$value) {
			for($card = 0; $card < count(self::$_faceValues); $card++) {
				$this->_cardDeck[] = new Card($card, $key);
			}
		}
		
		echo 'Shuffling Deck' . PHP_EOL;
		
		shuffle($this->_cardDeck);
	}
	
	
	/**
	 *
	 * @return multitype:array
	 */
	public static function getFaceValues() {
		return self::$_faceValues;
	}
	
	/**
	 *
	 * @return multitype:array
	 */
	public static function getSuites() {
		return self::$_suites;
	}
	
	/**
	 * @param integer $faceValue
	 * @return string
	 */
	public static function getFaceValue($faceValue) {
		return self::$_faceValues[$faceValue];
	}
	
	/**
	 * @param integer $suite
	 * @return string
	 */
	public static function getSuite($suite) {
		return self::$_suites[$suite];
	}
	
	/**
	 * @param integer $position
	 * @return a string representation of the card
	 */
	public function cardAt($position) {
		printf("At position %d the card is %s %s", $position+1, $this->_cardDeck[$position],PHP_EOL);
	}
	
	/**
	 * @param integer $position
	 * @return Card
	 */
	public function getCardAt($position) {
		return $this->_cardDeck[$position];
	}
	
	/**
	 * Gets the remaining cards in the deck
	 * @return number
	 */
	public function getLength() {
		return count($this->_cardDeck);
	}
	
	/**
	 * Removes a matched card from the deck
	 * @param number $position
	 */
	public function removeCard($position) {
		$temp = $this->_cardDeck;
		unset($temp[$position]);
		$this->_cardDeck = array_values($temp);
	}
}

