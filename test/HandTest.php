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
    public function testInvalidConstructWrongNumberofCards()
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



    /**
     * //TODO specific exceptions per error
     * @expectedException exception
     */
    public function testInvalidConstructWrongContentCardWithWrongNumber()
    {
        $cards = array(
            new Card(112, 44),
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


    public function testDoubleCouples(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(1, Card::HEARTS),
            new Card(2, Card::DIAMONDS),
            new Card(2, Card::PIKES),
            new Card(9, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::DOUBLE_COUPLE, $hand->winnerCombination());

    }



    public function testTrioSimple(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(1, Card::HEARTS),
            new Card(1, Card::DIAMONDS),
            new Card(2, Card::PIKES),
            new Card(9, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::TRIO, $hand->winnerCombination());

    }

    public function testTrioWithCouple(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(1, Card::HEARTS),
            new Card(1, Card::DIAMONDS),
            new Card(2, Card::PIKES),
            new Card(2, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::TRIO, $hand->winnerCombination());

    }



    public function testLadderSimple(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(2, Card::HEARTS),
            new Card(3, Card::DIAMONDS),
            new Card(4, Card::PIKES),
            new Card(5, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::LADDER, $hand->winnerCombination());

    }



    public function testColorSimple(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(9, Card::CLUBS),
            new Card(3, Card::CLUBS),
            new Card(4, Card::CLUBS),
            new Card(5, Card::CLUBS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::COLOR, $hand->winnerCombination());

    }



    public function testColorVsLadder(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(2, Card::CLUBS),
            new Card(3, Card::CLUBS),
            new Card(4, Card::CLUBS),
            new Card(5, Card::CLUBS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::COLOR, $hand->winnerCombination());

    }



    public function testFullVsDoubleCouples(){
        $cards = array(
            new Card(1, Card::CLUBS),
            new Card(1, Card::DIAMONDS),
            new Card(1, Card::PIKES),
            new Card(5, Card::CLUBS),
            new Card(5, Card::DIAMONDS),
        );

        $hand = new Hand($cards);

        $this->assertEquals(Hand::FULL, $hand->winnerCombination());

    }





}
