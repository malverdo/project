<?php
namespace App\Application;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MyBuilder\Bundle\CronosBundle\Annotation\Cron;
use App\Application\Command\UserManager;


/**
 * @Cron(minute="/1", noLogs=true)
 */
class UserCommand extends Command
{
    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    protected function configure()
    {
        $this
            ->setName('user:create')
            ->setDescription('Create a test user.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userManager->recordEvent(
            'User23',
            'Событие произошло'
        );
    }
}