<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MTodoStatus extends ModelEx {
        protected $table      = 'm_todo_statuses';
        protected $primaryKey = 'todo_status_id';
    }
}