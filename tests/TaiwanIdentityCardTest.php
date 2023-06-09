<?php

namespace Meditate\IdentityCard\Tests;

use Exception;
use Meditate\IdentityCard\TaiwanIdentityCard;
use PHPUnit\Framework\TestCase;

class TaiwanIdentityCardTest extends TestCase
{
    public function testCheckValidIdNumber()
    {
        $id_card = new TaiwanIdentityCard();
        $valid_id_number = 'A123456789';

        $this->assertTrue($id_card->check($valid_id_number));
    }

    public function testCheckInvalidIdNumber()
    {
        $id_card = new TaiwanIdentityCard();
        $invalid_id_number = 'A123456780';

        $this->assertFalse($id_card->check($invalid_id_number));
    }

    public function testMakeFakeIdNumberWithRandomLocationAndGender()
    {
        $id_card = new TaiwanIdentityCard();
        $fake_id_number = $id_card->make();

        $this->assertTrue($id_card->check($fake_id_number));
    }

    public function testMakeFakeIdNumberWithSpecifiedLocationAndGender()
    {
        $id_card = new TaiwanIdentityCard();
        $fake_id_number = $id_card->make('A', 1);

        $this->assertSame(substr($fake_id_number, 0, 1), 'A');
        $this->assertSame(substr($fake_id_number, 1, 1), '1');
        $this->assertTrue($id_card->check($fake_id_number));
    }

    public function testMakeFakeIdNumberWithInvalidLocation()
    {
        $this->expectException(Exception::class);
        $id_card = new TaiwanIdentityCard();
        $id_card->make('AA');
    }

    public function testMakeFakeIdNumberWithInvalidGender()
    {
        $this->expectException(Exception::class);
        $id_card = new TaiwanIdentityCard();
        $id_card->make('A', 3);
    }

}
