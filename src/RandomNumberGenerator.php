<?php

class RandomNumberGenerator
{
	private $suits = ["C" => "Clubs", "D" => "Diamonds", "H" => "Hearts", "S" => "Spades"];
    private $ranks = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J" => "Jack", "Q" => "Queen", "K" => "King", "A" => "Ace"];
    
	
    public function generate(int $min, int $max): int
    {
        return random_int($min, $max);
    }
    
    public function rouletteTable(): string
    {
        $number = $this->generate(0, 36);
        $color = ($number === 0) ? "Green" : (($number % 2 === 0) ? "Black" : "Red");
        return "{$color} {$number}";
    }
	
	public function fiveCardPokerHand(): string
    {
        $deck = array_merge(array_keys($this->ranks), array_keys($this->suits));
        shuffle($deck);
        $hand = array_slice($deck, 0, 5);
        $hand = array_map(function ($card) {
            if (array_key_exists($card, $this->ranks)) {
                return array_search($card, array_keys($this->ranks));
            }
            return $card;
        }, $hand);
        return implode(" ", $hand);
    }
}

/*
#USAGE EXAMPLE
$gen = new RandomNumberGenerator();
echo $gen->rouletteTable();

#USAGE EXAMPLE
$gen = new RandomNumberGenerator();
echo $gen->fiveCardPokerHand();
*/