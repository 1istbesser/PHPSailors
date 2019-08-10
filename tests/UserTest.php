<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use  PHPSailors\Services\MainService;

final class UserTest extends TestCase
{
    public function testCanBeCreatedFromEmailAddress(): void
    {
      $mainService = new MainService();
        $this->assertInstanceOf(
            MainService::class,
            $mainService
        );
        // Register the first account
        $this->assertEquals(200, $mainService->registerUser("test@gmail.com", "test"));
        $mainService->deleteUser("test@gmail.com");
        // Register the same account twice, expecting 409 - account already exists
        $mainService->registerUser("test@gmail.com", "test");
        $this->assertEquals(409, $mainService->registerUser("test@gmail.com", "test"));
    }

}
