<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Test class to Command ProcessFileCommand.
 */
class ProcessFileCommandTest extends KernelTestCase
{

    public function testExecute(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:process-file');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file' => 'tests/demoData1.json',
        ]);
        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('</TarificacionThirdPartyRequest>', $output);
    }
}
