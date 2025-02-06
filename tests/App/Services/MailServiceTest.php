<?php
use PHPUnit\Framework\TestCase;
use App\Services\MailService;

class MailServiceTest extends TestCase {
    private MailService $mailService;

    protected function setUp(): void {
        $this->mailService = new MailService();
    }

    public function testSendMail(): void {
        $this->assertTrue($this->mailService->send('test@example.com', 'Test Subject', 'Test Message'));
    }
}