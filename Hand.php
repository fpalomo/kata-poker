<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 14/06/13
 * Time: 13:43
 * To change this template use File | Settings | File Templates.
 */
namespace Poker;

class Hand
{

    const COUPLE = 2;
    const DOUBLE_COUPLE = 3;
    const TRIO = 4;

    public $cards;

    public function __construct(array $cards)
    {
        if (count($cards) != 5) {
            throw new \exception ("wrong number of cards");
        }
        foreach ($cards as $card) {
            if (!$card instanceof Card) {
                throw new \exception("that is not a card!");
            }
        }

        $this->cards = $cards;
    }


    public function winnerCombination()
    {
        $numbers = array();
        $result = null;
        foreach ($this->cards as $card) {
            array_push($numbers, $card->number);
        }
        $values = array_count_values($numbers);
        foreach ($values as $number) {
            // pareja
            if ($number == 2) {
                if ($result == self::COUPLE) {
                    $result = self::DOUBLE_COUPLE;
                } else {
                    $result = self::COUPLE;
                }
            }

        }

        return $result;
    }


}