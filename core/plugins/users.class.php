<?php

class Users {

    private static $con;
    private $user_id;
    private $username;
    private $email;

    public function __construct() {
        self::$con = new Conn;
        if (Session::get_param('m_id') && Session::check()) {
            $this->user_id = Session::get_param('m_id');
            $this->username = Session::get_param('username');
            $this->email = Session::get_param('email');
        }
    }

    public function setUserID($user_id) {
        $this->user_id = $user_id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getName($user_id) {
        if (is_null($user_id))
            $user_id = $this->user_id;
        $result = self::$con->db_query("SELECT username,fname,lname,m_id FROM `members` WHERE m_id='" . $user_id . "'");
        $row = mysql_fetch_assoc($result);
        return $row['fname'] . ' ' . $row['lname'];
    }

    public function getId($username) {
        $result = self::$con->db_query("SELECT m_id FROM `members` WHERE username='" . $username . "'");
        $row = mysql_fetch_assoc($result);
        return $row['m_id'];
    }

    public function isLogged() {
        if (isset($this->user_id) && Session::check())
            return true;
        else
            return false;
    }

    public function getUsername() {
        if (isset($this->username))
            return ucwords($this->username);
        else
            return false;
    }

    public function getEmail() {
        if (isset($this->email))
            return $this->email;
        else
            return false;
    }

    public function getUsernameByID($id) {
        $result = self::$con->db_query("SELECT username FROM `members` WHERE m_id='" . $id . "'");
        $row = mysql_fetch_assoc($result);
        return $row['username'];
    }

    public function checkEmail($email) {
        $result = self::$con->db_query("SELECT username,fname,lname,m_id FROM `members` WHERE email='" . $email . "'");
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    public function getLoggedUsername() {
        return Session::get_param('username');
    }

    public function getRowData($fields, $table) {
        $result = self::$con->db_query("SELECT " . $fields . " FROM `" . $table . "` WHERE m_id='" . $this->user_id . "'");
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    public function seeWhich() {
        $result = self::$con->db_query("SELECT (SELECT bp_id FROM brand_partner WHERE m_id='" . $this->user_id . "') as bp,(SELECT do_id FROM domain_owner WHERE m_id='" . $this->user_id . "') as do,(SELECT ld_id FROM logo_designers WHERE m_id='" . $this->user_id . "') as ld ,(SELECT do_id FROM domain_owner WHERE m_id='" . $this->user_id . "') as do,(SELECT sp_id FROM strategic_partners WHERE m_id='" . $this->user_id . "') as sp");
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    public function getFieldsData($arg) {
        $default = "fname,lname,email,country";
        switch ($arg) {
            case "member":
                $result = self::$con->db_query("SELECT " . $default . ",DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birth, '00-%m-%d')) as age,birth,sex,city,zip_code,occupation,str_addr1,str_addr2,str_addr3,phone,qualification_level,avatar,avatar_status,bus_sector,educ_institute,comp_name,job_title,post_box,region,introduced,skype,twitter,facebook,alt_phone,alt_email,website,salutation FROM `members` WHERE m_id='" . $this->user_id . "'");
                break;
            case "brand":
                $result = self::$con->db_query("SELECT " . $default . ",bs_id,bus_descr FROM `brand_partner` NATURAL JOIN `members` WHERE members.m_id='" . $this->user_id . "'");
                break;
            case "logo":
                $result = self::$con->db_query("SELECT " . $default . ",port_link,self_descr FROM `logo_designers` NATURAL JOIN `members` WHERE members.m_id='" . $this->user_id . "'");
                break;
            case "domain":
                $result = self::$con->db_query("SELECT " . $default . ",do_id,(SELECT group_concat(d_name) FROM `domains` NATURAL JOIN `domain_owner` WHERE deleted_date IS NULL) as d_name, (SELECT group_concat(domain_cost) FROM `domains` NATURAL JOIN `domain_owner` WHERE deleted_date IS NULL) as d_cost FROM `domain_owner` NATURAL JOIN `members` WHERE members.m_id='" . $this->user_id . "'");
                break;
            case "strategic":
                $result = self::$con->db_query("SELECT " . $default . ",work_partners FROM `strategic_partners` NATURAL JOIN `members` WHERE members.m_id='" . $this->user_id . "'");
                break;
        }
        $row = mysql_fetch_assoc($result);
        return $row;
    }

    public function showUserDomains($name, $price) {
        //init array
        $domains = array();
        //parse domain name and price
        $name = explode(",", $name);
        $price = explode(",", $price);
        for ($i = 0; $i < count($name); $i++)
            $domains[$i]['domain'] = $name[$i] . " - $" . $price[$i];

        return $domains;
    }

    public function updateDomains($do_id, $d_name, $domains) {
        $d_name = explode(",", $d_name);
        //check if any old domains are deleted from the list
        $found = false;
        foreach ($d_name as $name) {
            foreach ($domains as $item) {
                if ($name == $item['name']) {
                    $found = true;
                    break;
                }
                $found = false;
            }
            if (!$found)
            //do not use this anymore just delete the domain
            //self::$con->db_query("UPDATE domains set deleted_date=NOW() WHERE d_name='" . $name . "' AND do_id='" . $do_id . "'");
                self::$con->db_query("DELETE FROM domains WHERE d_name='" . $name . "' AND do_id='" . $do_id . "'");
        }

        foreach ($domains as $item) {
            self::$con->db_query("INSERT IGNORE INTO `domains` (do_id,d_name,name_length,vowels,consonants,numbers,hyphens,domain_cost,char_types)
      VALUES('" . $do_id . "','" . $item['name'] . "','" . $item['length'] . "','" . $item['vowels'] . "','" . $item['cons'] . "','" . $item['numbers'] . "','" . $item['hyphens'] . "','" . $item['price'] . "','" . $item['char_types'] . "')");
        }
    }

    public function getPurchases() {
        $data = array();
        $result = self::$con->db_query("SELECT purchase_date,(SELECT d_name from domains WHERE d_id=orders.d_id) as name,
                                                (SELECT current_sale_price from domains WHERE d_id=orders.d_id) as price
                                                 FROM `orders` WHERE m_id='" . $this->user_id . "' AND status IS NOT NULL ORDER BY purchase_date DESC");
        $i = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $dir_name = str_replace('.com', '_com', $row['name']);
            $dir = dirname(CORE_DIR) . '/brands/' . $dir_name;
            $files = Security::openDir($dir, array("zip", "rar"));
            $data[$i] = $row;
            $data[$i]['files'] = $files;
            $data[$i]['dir_name'] = $dir_name;
            $i++;
        }
        return $data;
    }

    public function getCredits() {
        $data = array();
        $result = self::$con->db_query("SELECT * FROM `credits` WHERE m_id='" . $this->user_id . "' ORDER BY data DESC");
        while ($row = mysql_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }

    public function isLD() {
        $result = self::$con->db_query("SELECT ld_id FROM logo_designers NATURAL JOIN members WHERE members.m_id='" . $this->user_id . "'");
        if (mysql_num_rows($result) == 1)
            return true;
        else
            return false;
    }

    public function checkPurchasedDomains() {
        self::$con->db_query("DELETE FROM orders WHERE DATE_ADD(purchase_date, INTERVAL " . ORDER_EXPIRE . " DAY)<NOW()");
    }

}

?>