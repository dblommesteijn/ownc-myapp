<?php

namespace OCA\MyApp;


class Transfer extends \OC\BackgroundJob\QueuedJob {

    public function run($args){

        // TODO: load user from $user_name
        // TODO: load file from $file_id

        // TODO: check permissions
        // TODO: load external config

        // TODO: start external session
        // TODO: start transfer

        // TODO: update status table

        echo "-- dostuf";
        print_r($args);
        echo PHP_EOL;
    }

}

