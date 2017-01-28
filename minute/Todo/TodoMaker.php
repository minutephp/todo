<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 8/9/2016
 * Time: 5:00 PM
 */
namespace Minute\Todo {

    use Minute\Config\Config;

    class TodoMaker {
        /**
         * @var Config
         */
        private $config;

        /**
         * TodoMaker constructor.
         *
         * @param Config $config
         */
        public function __construct(Config $config) {
            $this->config = $config;
        }

        public function createManualItem($ident, $name, $description, $link = '#') {
            return ['name' => $name, 'description' => $description, 'status' => 'incomplete', 'link' => $link, 'ident' => $ident, 'manual' => true];
        }

        public function createAutoItem($key, $name, $description, $link = '#') {
            $value = $this->config->get($key);

            return ['name' => $name, 'description' => $description, 'status' => !empty($value) ? 'complete' : 'incomplete', 'link' => $link];
        }
    }
}