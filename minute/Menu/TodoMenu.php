<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Menu {

    use Minute\Event\ImportEvent;

    class TodoMenu {
        public function adminLinks(ImportEvent $event) {
            $links = [
                'todos' => ['title' => 'Todo list', 'icon' => 'fa-list-alt', 'priority' => 3, 'href' => '/admin/todos']
            ];

            $event->addContent($links);
        }
    }
}