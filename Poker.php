<?php 
namespace Test;

use PHPUnit\Framework\TestCase;


class Poker extends TestCase{
     const VALID_CARDS = [2,3,4,5,6,7,8,9,10,11,12,13,14];

    function maxLenghtCards( array $cards ){
        if( count($cards) > 7 ){
            return false;
        }
        return true;
    }

    function isValidCard(int $card){
        return in_array($card, self::VALID_CARDS);
    }

    function isValidCards(array $cards){
        foreach($cards as $card ){
            if( !$this->isValidCard($card) ){
               return false;
            }
        }
        return true;
    }

    public function isStraight( array $cards): bool{
        if( !$this->maxLenghtCards($cards) ){
            return false;
        }
        if(!$this->isValidCards($cards)){
            return false;
        }
        sort( $cards );
        $hits = 0;
        $last_card = $cards[count($cards) - 1];
        foreach ($cards as $key => $card) {
            //echo("card: ". $card." \n");
            $previous_card =  $cards[ $key - 1 ] ?? null;
            if( ($card == 2 && $last_card == 14 ) || ($previous_card == $card - 1)){
                $hits++;  
            }else{
                $hits = 0;
            }
            //echo("hits: ". $hits." \n");
            if( $hits >= 4){
                return true;
            }
        }
        return false;
    }

    function __contructor(){

    }

    public function testAlgoritmo(){
        // escalera
        $results1 = $this->isStraight([2, 3, 4 ,5, 6]);
        $this->assertEquals($results1, true, "2, 3, 4 ,5, 6");
        // escalera
        $results2 = $this->isStraight([14, 5, 4 ,2, 3]);
        $this->assertEquals($results2, true, "14, 5, 4 ,2, 3");
        // No escalera
        $results3 = $this->isStraight([7, 7, 12 ,11, 3, 4, 14]);
        $this->assertEquals($results3, false, "7, 7, 12 ,11, 3, 4, 14");
        // No escalera
        $results4 = $this->isStraight([7, 3, 2]);
        $this->assertEquals($results4, false, "7, 3, 2");
        
        //escalera
        $results5 = $this->isStraight([10,11,12,13,14,2,3]);
        $this->assertEquals($results5, true, "10,11,12,13,14,2,3,4");

        //valor invalidos
        $results5 = $this->isStraight([10,11,12,13,14,15,3]);
        $this->assertEquals($results5, false, "15 is not valid");

        //escalera
        $results5 = $this->isStraight([10,11,12,13,14,2,3,6]);
        $this->assertEquals($results5, false, "10,11,12,13,14,2,3,4,6 limit cards");

    }

}