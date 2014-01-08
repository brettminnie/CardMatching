<?php
	
	namespace CardPairs;
	
	class Card extends CardInterface {
		
		/**
		 * Constants defining our suites
		 */
		const SUITE_CLUBS  		= 1;
		const SUITE_SPADES 		= 2;
		const SUITE_HEARTS 		= 3;
		const SUITE_DIAMONDS 	= 4; 
		
		/**
		 * Array of card names mapping to the constants
		 * @var array
		 */ 
		protected $_suites = array(
			const::SUITE_CLUBS 		=> 'Clubs',
			const::SUITE_SPADES	 	=> 'Spades',
			const::SUITE_HEARTS 	=> 'Hearts',
			const::SUITE_DIAMONDS 	=> 'Diamonds',
		);
		
		/**
		 * Array of face values for the cards normalised to 0 index
		 * @var array
		 */ 
		protected $_faceValues = array (
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
			'Ace',
		);
		
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
			
			if(array_key_exists($cardSuite, $this->_suites) === FALSE && $isJoker === FALSE) {
				throw new \Exception('Unknown suite used in card initialisation');
			}
			
			$this->_suite = $cardSuite;
			
			if(($cardValue < 0 || $CardValue < count($this->_faceValues)) && $isJoker === FALSE){
				throw new \Exception('Face value is out of bounds');
			}
			$this->_faceValue = $cardValue;
		}
		
		/**
		 * Method to see if our card is a joker
		 * @return boolean
		 */ 
		public function isJoker() {
			return $this->_isJoker;
		}
		
		/**
		 * @see CardInterface
		 */
		 public function isInSuite($testSuite) {
			 return $this->_suite ===  $testSuite;
		 } 
		 
		 /**
		  * @see CardInterface
		  */
		  public function faceValueIsEqual($testCard) {
			  if(($testCard instanceof Card) == FALSE) {
				  throw new \Exception('An instance of a card needs to be tested against');
			  }
			  
		  } 
		 
		/**
		 * Method to get a string representation of the card
		 * @return string
		 */ 
		public function __toString() {
			if($this->isJoker()) {
				return "Joker";
			}
			return sprintf("%s of %s", $this->_getFaceValue(), $this->_getSuite());
	}
