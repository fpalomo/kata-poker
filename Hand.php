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
    const LADDER = 5;
    const COLOR = 6;

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
            if ($card->number < 1 || $card->number > 13) {
                throw new \exception("the card number is not valid");
            }
        }

        $this->cards = $cards;
    }


    public function winnerCombination()
    {
        $numbers = array();
        $suits = array();
        $result = 0;
        foreach ($this->cards as $card) {
            array_push($numbers, $card->number);
            array_push($suits, $card->suit);
        }
        $values = array_count_values($numbers);
        $totalSuites = array_count_values($suits);
        // color
        if (count($totalSuites) == 1) {
            $result = self::COLOR;
        }


        // ladder
        if ($result < self::COLOR) {
            sort($numbers);
            $result = self::LADDER;
            for ($i = 1; $i < count($numbers); $i++) {
                if ($numbers[$i] != $numbers[$i - 1] + 1) {
                    $result = null;
                    break;
                }
            }
            if ($result < self::LADDER) {
                foreach ($values as $number) {
                    // trio
                    if ($number == 3) {
                        if ($result < self::TRIO) {
                            $result = self::TRIO;
                        }
                    }
                    if ($number == 2) {
                        // double couple
                        if ($result == self::COUPLE) {
                            $result = self::DOUBLE_COUPLE;
                        } else {
                            // couple
                            if ($result < self::COUPLE) {
                                $result = self::COUPLE;
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }


}