<?php

namespace CardPairs;

include_once('CardInterface.php');

class Card implements CardInterface {
	
	/**
	 * @var boolean
	 */
	protected $_isJoker = FALSE;
	
	/**
	 * @var integer
	 */
	protected $_faceValue;
	
	/**
	 * @var integer
	 */
	protected $_suite;
	
	/**
	 * Constructor that creates an instance of a card
	 * @param $cardValue integer        	
	 * @param $cardSuite const        	
	 * @param $isJoker boolean        	
	 * @throws Exception
	 */
	public function __construct($cardValue = NULL, $cardSuite = NULL, $isJoker = FALSE) {
		$this->_isJoker = $isJoker;
		
		if (array_key_exists ( $cardSuite, Deck::getSuites() ) === FALSE && $isJoker === FALSE) {
			throw new \Exception ( 'Unknown suite used in card initialisation' );
		}
		
		$this->_suite = $cardSuite;
		
		if (($cardValue < 0 || $cardValue > count ( Deck::getFaceValues() )) && $isJoker === FALSE) {
			throw new \Exception ( 'Face value is out of bounds' );
		}
		$this->_faceValue = $cardValue;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public function isJoker() {
		return $this->_isJoker;
	}
	
	/**
	 * @see CardInterface
	 */
	public function isInSuite($testSuite) {
		return $this->_suite === $testSuite;
	}
	
	/**
	 * @see CardInterface
	 */
	public function faceValueIsEqual($testCard) {
		if (($testCard instanceof Card) == FALSE) {
			throw new \Exception ( 'An instance of a card needs to be tested against' );
		}
		
		if ($testCard->isJoker ()) {
			return true;
		}
		
		if ($testCard->getValue () == $this->getValue ()) {
			return true;
		}
		return false;
	}
	
	/**
	 *
	 * @see CardInterface
	 */
	public function getValue() {
		return $this->_faceValue;
	}
	
	/**
	 * Method to get a string representation of the card
	 * @return string
	 */
	public function __toString() {
		if ($this->isJoker ()) {
			return "a Joker";
		}
		return sprintf ( "the %s of %s", $this->_getFaceValue (), $this->_getSuite () );
	}
	
	/**
	 * Method to get the string representation of the cards face value
	 * @return string
	 */
	protected function _getFaceValue() {
		return Deck::getFaceValue($this->_faceValue);
	}
	
	/**
	 * Method to get the string representation of the cards suite
	 * @return string
	 */
	protected function _getSuite() {
		return Deck::getSuite($this->_suite);
	}
}
