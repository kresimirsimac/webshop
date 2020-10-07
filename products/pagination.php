<?php

class Pagination {
    private $connection, $total_records, $limit = 10;

    public function __construct($connection) {
        $this->connection = connection();
        $this->setTotalRecords();
    }

    public function setTotalRecords() {
        $statement = $this->connection->prepare('SELECT * FROM products');
        $statement->execute();
        $this->total_records = $statement->rowCount();
    }

    public function currentPage() {
        return isset($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    public function getData() {
        $start = 0;
        if ($this->currentPage() > 1) {
            $start = ($this->currentPage() * $this->limit) - $this->limit;
        }
        $statement = $this->connection->prepare("SELECT * FROM products LIMIT $start, $this->limit");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPaginationNumber() {
        return ceil($this->total_records / $this->limit);
    }

}

//class Pagination {
//    // db handle
//    private $connection;
//
//    private $total_records;
//
//    private $limit;
//
//    private $total_pages;
//
//    private $offset;
//
//    // first page and back links
//    private $firstBack;
//
//    // last page and next links
//    private $nextLast;
//
//    //current page
//    private $current;
//
//    public function __construct($connection) {
//        $this->connection = connection();
//    }
//
//    // determine total records
//    public function totalRecords($query) {
//        $statement = $this->connection->prepare($query);
//        $statement->execute();
//        $this->total_records = $statement->fetchAll(PDO::FETCH_COLUMN)[0];
//
//        if (!$this->total_records) {
//            echo 'No records found!';
//            return;
//        }
//    }
//
//    /**
//     * @return int
//     */
//    public function getLimit()
//    {
//        return $this->limit;
//    }
//
//    // set limit and number of pages
//    public function setLimit($limit) {
//        $this->limit = $limit;
//
//        // number of pages
//        if (!empty($this->total_records)) {
//            $this->total_pages = ceil($this->total_records / $this->limit);
//        }
//    }
//
//    public function test()
//    {
//        $pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
//
//        // out of range check
//        if ($pageNo > $this->total_pages) {
//            $pageNo = $this->total_pages;
//        } elseif ($pageNo < 1) {
//            $pageNo = 1;
//        }
//
//        return $pageNo;
//    }
//
//    public function currPage() {
//        $pageNo = isset($_GET['pageNo']) ? (int)$_GET['pageNo'] : 1;
//
//        // out of range check
//        if ($pageNo > $this->total_pages) {
//            $pageNo = $this->total_pages;
//        } elseif ($pageNo < 1) {
//            $pageNo = 1;
//        }
//
//        if ($pageNo > 1) {
//            $prevPage = $pageNo - 1;
//
//            $this->firstBack = "<div class='first-back'><a href='$_SERVER[PHP_SELF]?pageNo=1'>First Page</a> <a href='$_SERVER[PHP_SELF]?pageNo=$prevPage'>Previous Page</a></div>";
//        }
//
//        $this->current = "<div class=\'page-count\'>Page $pageNo of $this->total_pages</div>";
//
//        if ($pageNo < $this->total_pages) {
//            // forward
//            $nextPage = $pageNo + 1;
//
//            $this->nextLast = "<div class=\'next-last\'><a href='$_SERVER[PHP_SELF]?pageNo=$nextPage'>Next Page</a> <a href='$_SERVER[PHP_SELF]?pageNo=$this->total_pages'>Last Page</a></div>";
//        }
//        return $pageNo;
//    }
//
//
//    public function firstBack() {
//        return $this->firstBack;
//    }
//
//    public function nextLast() {
//        return $this->nextLast;
//    }
//
//    public function where() {
//        return $this->current;
//    }
//}

