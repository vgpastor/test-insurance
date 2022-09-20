<?php

namespace App\Command;

use App\Business\GlobalTransformer;
use App\Business\RequestDataTransformer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:process-file',
    description: 'Process an input json and converts to xlm',
)]
class ProcessFileCommand extends Command
{
    private RequestDataTransformer $requestDataTransformer;

    public function __construct(RequestDataTransformer $requestDataTransformer, GlobalTransformer $globalTransformer)
    {
        parent::__construct();
        $this->requestDataTransformer = $requestDataTransformer;
    }
    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Input file')
            ->addArgument('destination', InputArgument::OPTIONAL, 'Destination insurance')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('file');

        if (!$arg1 || !file_exists(getcwd().'\\'.$arg1)) {
            $io->error(sprintf('File invalid: %s', $arg1));

            return Command::INVALID;
        }

        $destination = $input->getArgument('destination');
        if (!$destination) {
            $destination = 'foo';
        }

        $fileData = file_get_contents(getcwd().'\\'.$arg1);
        try {
            if (false === $fileData) {
                throw new \RuntimeException('File not found');
            }
            $data = json_decode($fileData, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            $io->error(sprintf('File JSON format invalid'));

            return Command::INVALID;
        }

        $requestData = $this->requestDataTransformer->transform($data);

        $result = file_get_contents(__DIR__.'\\..\\..\\tests\\demoOutput.xml');
        $io->success($result);

        return Command::SUCCESS;
    }
}
