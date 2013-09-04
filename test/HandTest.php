<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 14/06/13
 * Time: 13:46
 * To change this template use File | Settings | File Templates.
 */

namespace Poker;

require '../vendor/phpunit/phpunit/PHPUnit/Autoload.php';

include "../Hand.php";
include "../Card.php";


class HandTest extends \PHPUnit_Framework_TestCase
{


    public function testValidConstruct()
    {
        $cards = array(
            new Card(1, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
            new Card(4, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
        );
        $hand = new Hand($cards);
        $this->assertTrue(true);
    }

    /**
     * //TODO specific exceptions per error
     * @expectedException exception
     */
    public function testInvalidConstructWrongNumber()
    {
        $cards = array(
            new Card(2, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
            new Card(4, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

    }

    /**
     * //TODO specific exceptions per error
     * @expectedException exception
     */
    public function testInvalidConstructWrongContent()
    {
        $cards = array(
            new Card(2, 44),
            new Card(2, Card::DIAMONDS),
            new Card(4, Card::DIAMONDS),
            new Card(2, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

    }


    public function testCouple()
    {
        $cards = array(
            new Card(2, Card::CLUBS),
            new Card(2, Card::DIAMONDS),
            new Card(4, Card::DIAMONDS),
            new Card(5, Card::DIAMONDS),
            new Card(6, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::COUPLE, $hand->winnerCombination());

    }

    public function testNoValidCombination()
    {
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(2, Card::HEARTS),
            new Card(4, Card::DIAMONDS),
            new Card(7, Card::DIAMONDS),
            new Card(9, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(null, $hand->winnerCombination());

    }


}