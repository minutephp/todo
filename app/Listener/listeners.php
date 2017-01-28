<?php

/** @var Binding $binding */
use Minute\Event\AdminEvent;
use Minute\Event\Binding;
use Minute\Menu\TodoMenu;

$binding->addMultiple([
    //todos
    ['event' => AdminEvent::IMPORT_ADMIN_MENU_LINKS, 'handler' => [TodoMenu::class, 'adminLinks']],
]);