<?php
// db/authormapper.php

namespace OCA\MyApp\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

class FilecacheStatusMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'myapp_filecache_status', '\OCA\MyApp\Db\FilecacheStatus');
    }


    /**
     * @throws \OCP\AppFramework\Db\DoesNotExistException if not found
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException if more than one result
     */
    public function find($id) {
        $sql = 'SELECT * FROM `*PREFIX*myapp_filecache_status` ' .
            'WHERE `id` = ?';
        return $this->findEntity($sql, [$id]);
    }


    // public function findAll($limit=null, $offset=null) {
    //     $sql = 'SELECT * FROM `*PREFIX*myapp_filecache_status`';
    //     return $this->findEntities($sql, $limit, $offset);
    // }

    public function findAll() {
        $sql = 'SELECT * FROM *PREFIX*myapp_filecache_status';
        return $this->findEntities($sql);
    }


    // public function authorNameCount($name) {
    //     $sql = 'SELECT COUNT(*) AS `count` FROM `*PREFIX*myapp_filecache_status` ' .
    //         'WHERE `name` = ?';
    //     $stmt = $this->execute($sql, [$name]);

    //     $row = $stmt->fetch();
    //     $stmt->closeCursor();
    //     return $row['count'];
    // }

}