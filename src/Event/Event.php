<?php
namespace Larakit\Event;

class Event {
    
    protected static $dispatcher = null;
    protected static $events     = [];
    
    static function dispatcher() {
        if(is_null(self::$dispatcher)) {
            self::$dispatcher = new \sfEventDispatcher();
        }
        
        return self::$dispatcher;
    }
    
    /**
     * Навешиваем слушателя на событие
     *
     * @param $event_name
     * @param $callback
     */
    static function listener($event_name, $callback) {
        self::dispatcher()
            ->connect($event_name, $callback);
    }
    
    /**
     * Уведомляем приложение о событии
     *
     * @param       $event_name
     * @param array $parameters
     * @param null  $subject
     */
    static function notify($event_name, $parameters = [], $subject = null, $desc = null) {
        self::$events[$event_name] = $desc ? $desc : $event_name;
        $event                     = new \sfEvent($subject, $event_name, $parameters);
        self::dispatcher()
            ->notify($event);
    }
    
    /**
     * Уведомляем приложение о событии, ждем запуска хотя бы одного слушателя
     * Возвращаем логическое значение - был ли запущен хот я бы один слушатель
     *
     * @param       $event_name
     * @param array $parameters
     * @param null  $subject
     *
     * @return bool
     */
    static function notifyUntil($event_name, $parameters = [], $subject = null, $desc = null) {
        self::$events[$event_name] = $desc ? $desc : $event_name;
        $event                     = new \sfEvent($subject, $event_name, $parameters);
        $event                     = self::dispatcher()
            ->notifyUntil($event);
        
        return $event->isProcessed();
    }
    
    /**
     * Фильтр по событию
     *
     * @param       $event_name
     * @param null  $default
     * @param array $parameters
     * @param null  $subject
     *
     * @return mixed
     */
    static function filter($event_name, $default = null, $parameters = [], $subject = null, $desc = null) {
        self::$events[$event_name] = $desc ? $desc : $event_name;
        $event                     = new \sfEvent($subject, $event_name, $parameters);
        self::dispatcher()
            ->filter($event, $default);
        
        return $event->getReturnValue();
    }
    
    static function events() {
        $ret = [];
        foreach(self::$events as $event_name => $desc) {
            $ret[] = [$event_name, $desc];
        }
        
        return $ret;
    }
    
}