<?php

namespace Roots\AcornFseHelper\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Roots\Acorn\Application;

use function Laravel\Prompts\confirm;

class CreateBlockCommand extends Command
{
    protected string $name;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:block {name* : The name of the block}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new block.';

    /**
     * The required Acorn version.
     */
    protected string $version = '4.2.0';

    /**
     * The editor style token.
     */
    protected string $styleToken = '}, 100);';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (! $this->isValidAcornVersion()) {
            $this->components->error("Full-site editing support requires <fg=red>Acorn {$this->version}</> or higher.");

            return;
        }

        if (
            app()->isProduction() &&
            ! confirm('<fg=white>You are currently in</> <fg=red;options=bold>Production</>. <fg=white>Do you still wish to continue?</>', default: false)
        ) {
            return;
        }

        $this->name = $this->qualifyClass($this->getNameInput());

        $this->createDirectory();
        $this->createBlockFile();
        $this->createBlockIndexFile();
        $this->createBlockEditFile();
        $this->createBlockViewFile();
    }

    /**
     * Return the view destination path.
     *
     * @return string
     */
    public function getBlocksPath()
    {}

    /**
     * Return the view destination path.
     *
     * @return string
     */
    public function getViewPath()
    {}

    /**
     * Create the Block Directory
     */
    protected function createDirectory(): void
    {}

    protected function createBlockFile(): void
    {}

    protected function createBlockIndexFile(): void
    {}

    protected function createBlockEditFile(): void
    {}

    protected function createBlockViewFile(): void
    {}

    /**
     * Determine if the current Acorn version is supported.
     */
    protected function isValidAcornVersion(): bool
    {
        $version = Application::VERSION;

        if (Str::contains($version, 'dev')) {
            return true;
        }

        return version_compare($version, $this->version, '>=');
    }
}
