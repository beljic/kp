<?php
use PHPUnit\Framework\TestCase;
use src\app\Resource\Database\Database;
use src\app\Resource\Database\UserRepository;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;
    private $mysqliMock;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $dbMock = $this->createMock(Database::class);
        $this->mysqliMock = $this->createMock(mysqli::class);
        $dbMock->method('getConnection')->willReturn($this->mysqliMock);
        $this->userRepository = new UserRepository($dbMock);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testEmailExists()
    {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('bind_result')->willReturn(true);
        $stmtMock->method('fetch')->willReturn(true);

        $this->mysqliMock->method('prepare')->willReturn($stmtMock);

        $this->assertTrue($this->userRepository->emailExists('test@example.com'));
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testCreateUser()
    {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')->willReturn(true);

        $this->mysqliMock->method('prepare')->willReturn($stmtMock);

        $this->assertTrue((bool)$this->userRepository->createUser('test@example.com', 'password'));
    }
}
