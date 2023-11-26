<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\BookingRepository;

class CalculateBookingPriceTest extends TestCase
{
    private $bookingRepository;
    public function setUp(): void
    {
        parent::setUp();
        $this->bookingRepository = new BookingRepository();
    }
    public function test_CalculateBookingPrice()
    {
        $price = $this->bookingRepository->GetPrice(1, 1, 3);
        $this->assertEquals(100, $price);
    }
}
