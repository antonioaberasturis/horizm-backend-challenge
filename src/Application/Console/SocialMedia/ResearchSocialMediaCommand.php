<?php

declare(strict_types=1);

namespace Application\Console\SocialMedia;

use Illuminate\Console\Command;
use Shared\SocialMedia\Actions\PostsWithUserResearcherAction;

class ResearchSocialMediaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socialmedia:research';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PostsWithUserResearcherAction $researcher)
    {
        $researcher->__invoke();
        
        return 0;
    }
}
