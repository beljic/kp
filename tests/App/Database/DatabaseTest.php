<?php
use PHPUnit\Framework\TestCase;
use App\Database\Database;

class DatabaseTest extends TestCase {
    private Database $dbMock;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(Database::class);
    }

    public function testQueryReturnsData(): void {
        $this->dbMock->method('query')->willReturn(['id' => 1, 'email' => 'test@example.com']);
        $result = $this->dbMock->query('SELECT * FROM user WHERE email = ?', ['test@example.com']);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
    }
}