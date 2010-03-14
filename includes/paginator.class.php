<?php
class Paginator {

    var $SQL;
    var $itemsPerPage;
    var $showFirstAndLast = false; // if you would like the first and last page options.
    var $pages; //this is only for the array for sql use the method getTotalPages()

    function setSQL($sql) {
        $this->SQL = trim($sql);
    }

    function setItemsPerPage($num) {
        $this->isValidNumber($num) ? $this->itemsPerPage = $num : die("setItemsPerPage() only accept non-zero, positive number.");
    }

    function getTotalPages() {
        $q = mysql_query($this->SQL);
        if($q == false) die("getTotalPages has invalid SQL: ".mysql_errno() . ' ' . mysql_error()."<br/>SQL:".$this->SQL);
        return ceil(mysql_num_rows($q)/$this->itemsPerPage);
    }
    function getTotalRez() {
        $q = mysql_query($this->SQL);
        if($q == false) die("getTotalPages has invalid SQL: ".mysql_errno() . ' ' . mysql_error()."<br/>SQL:".$this->SQL);
        return ceil(mysql_num_rows($q));
    }
    function getPageNumber($page_num) {
        if($this->isValidNumber($page_num) == false) die("getPageNumber() only accept non-zero, positive number.");

        $endItem = $this->itemsPerPage;
        $startItem = ($this->itemsPerPage * ($page_num - 1));

        $sql = $this->SQL;
        $limit_sql = " LIMIT $startItem , $endItem";
        $final_SQL = $this->SQL . $limit_sql;

        $q = mysql_query($final_SQL);
        return $q;
    }
    function isValidNumber($n) {
        return (is_numeric($n) && ($n > 0));
    }
    function generate($array,$page) {
        if (!empty($page)) {
            $this->page = $page;
        } else {
            $this->page = 1; // if we don't have a page number then assume we are on the first page
        }
        // Take the length of the array
        $this->length = count($array);
        // Get the number of pages
        $this->pages = ceil($this->length / $this->itemsPerPage);
        // Calculate the starting point
        $this->start = ceil(($this->page - 1) * $this->itemsPerPage);
        // Return the part of the array we have requested
        return array_slice($array, $this->start, $this->itemsPerPage);
    }
    function links() {
        // Initiate the links array
        $plinks = array();
        $links = array();
        $slinks = array();
        // Concatenate the get variables to add to the page numbering string
        if (count($_GET)) {
            $queryURL = '';
            foreach ($_GET as $key => $value) {
                if ($key != 'page') {
                    $queryURL .= '&'.$key.'='.$value;
                }
            }
        }
        // If we have more then one pages
        if (($this->pages) > 1) {
            // Assign the 'previous page' link into the array if we are not on the first page
            if ($this->page != 1) {
                if ($this->showFirstAndLast) {
                    $plinks[] = ' <a href="?page=1'.$queryURL.'">&laquo;&laquo; First </a> ';
                }
                $plinks[] = ' <a href="?page='.($this->page - 1).$queryURL.'">&laquo; Prev</a> ';
            }
            // Assign all the page numbers & links to the array
            for ($j = 1; $j < ($this->pages + 1); $j++) {
                if ($this->page == $j) {
                    $links[] = ' <a class="selected">'.$j.'</a> '; // If we are on the same page as the current item
                } else {
                    $links[] = ' <a href="?page='.$j.$queryURL.'">'.$j.'</a> '; // add the link to the array
                }
            }
            // Assign the 'next page' if we are not on the last page
            if ($this->page < $this->pages) {
                $slinks[] = ' <a href="?page='.($this->page + 1).$queryURL.'"> Next &raquo; </a> ';
                if ($this->showFirstAndLast) {
                    $slinks[] = ' <a href="?page='.($this->pages).$queryURL.'"> Last &raquo;&raquo; </a> ';
                }
            }
            // Push the array into a string using any some glue
            return implode(' ', $plinks).implode($this->implodeBy, $links).implode(' ', $slinks);
        }
        return;
    }
}
?>