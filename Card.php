<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 14/06/13
 * Time: 13:41
 * To change this template use File | Settings | File Templates.
 */
namespace Poker;

class Card
{
    const HEARTS = 0;
    const DIAMONDS = 1;
    const PIKES = 2;
    const CLUBS = 3;


    public $number;
    public $suit;

    public function __construct($number, $suit)
    {
        $this->number = $number;
        $this->suit = $suit;
    }

}