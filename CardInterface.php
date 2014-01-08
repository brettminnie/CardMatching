<?php

	namespace CardPairs;

	interface CardInterface {
		
		/**
		 * Method to test the cards suite
		 * @param string $testSuite
		 * @return boolean
		 */
		public function isInSuite($testSuite);
		
		/**
		 * Method to test the value of the card is equal
		 * @return boolean
		 * @throw Exception
		 */
		 public function faceValueIsEqual($testCard);
	}
