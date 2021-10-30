<?php
namespace App\Application;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class RotCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('user:rot')
            ->setDescription('Create a test user.')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::OPTIONAL);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $name = $input->getArgument('name');

        $output->writeln(
            sprintf('Электронный адрес - %s, Пароль - %s, Имя - %s', $email, $password, $name ?? 'default')
        );
        return 1;
    }
}