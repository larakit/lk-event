<?php
namespace Larakit\Event;

use Illuminate\Console\Command;

class CommandEvent extends Command {
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:settings:event';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'События';
    
    /**
     * Пусть для сохранения сгенерированных данных
     *
     * @var string
     */
    protected $path;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->info('123');
    }
    
}