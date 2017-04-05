<?php
namespace Larakit\Event;

use Illuminate\Console\Command;

class CommandEvent extends Command {
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:show:event';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Показать все зарегистрированные события';
    
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
        $this->table(['Event Name', 'File', 'Line', 'Description',], Event::events());
    }
    
}