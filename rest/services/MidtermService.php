<?php
require_once __DIR__."/../dao/MidtermDao.php";

class MidtermService {
    protected $dao;

    public function __construct(){
        $this->dao = new MidtermDao();
    }

    /** TODO
    * Implement service method to return detailed cap-table
    */
    public function cap_table(){
        $capTable = $this->dao->cap_table();
        return $capTable;
    }
    /** TODO
    * Implement service method to return cap-table summary
    */
    public function summary(){
        $summary = $this->dao->summary();
        return $summary;
    }

    /** TODO
    * Implement service method to return list of investors with their total shares amount
    */
    public function investors(){
        $investors = $this->dao->investors();
        return $investors;
    }
}
?>
