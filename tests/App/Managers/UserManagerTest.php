<?php
use PHPUnit\Framework\TestCase;
use App\Managers\UserManager;
use App\Database\Database;
use App\Models\User;

class UserManagerTest extends TestCase {
    private UserManager $userManager;
    private Database $dbMock;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(Database::class);
        $this->userManager = new UserManager($this->dbMock);
    }

    public function testRegisterUserSuccess(): void {
        $this->dbMock->method('insert')->willReturn(1);
        $user = $this->userManager->registerUser('test@example.com', 'password123');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@example.com', $user->getEmail());
    }

    public function testRegisterUserFailure(): void {
        $this->dbMock->method('insert')->willReturn(null);
        $user = $this->userManager->registerUser('test@example.com', 'password123');

        $this->assertNull($user);
    }
}