<?php
    
    class model_search extends Model
    {
        function __construct()
        {
            parent::__construct();
        }

        function addWordSearch($get, $count)
        {
            $sql = "SELECT s_id, s_phrase FROM tbl_searches WHERE s_phrase=?";
            $result = $this->doSelect($sql, array($get));

            if(sizeof($result)==0){
                $sql = "INSERT INTO tbl_searches (s_phrase,s_count_result,s_count_search,s_suggest_search,s_management_selection,s_date) VALUES (?,?,?,?,?,?)";
                $value = array($get, $count, 1, 0, 0, self::jalali_date());
                $this->doQuery($sql, $value);
            } else {
                $sql = "UPDATE tbl_searches SET s_count_result=?, s_count_search=s_count_search+1 WHERE s_phrase=?";
                $this->doQuery($sql, array($count, $get));
            }
        }
        
        function findMag($userId, $get)
        {
            $_where = "WHERE a.b_status=1 AND (a.subtitle LIKE '%" . htmlspecialchars($get['s']) . "%' OR a.title LIKE '%" . htmlspecialchars($get['s']) . "%' OR a.description LIKE '%" . htmlspecialchars($get['s']) . "%')";
            $_input = array();
            $_order = "ORDER BY a.n_id DESC";
            $_limit = "";
            $_join = "";
            return $this->getBlogData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
        }

        function findService($userId, $get)
        {
            $_where = "WHERE s_status=1 AND (s_title LIKE '%" . htmlspecialchars($get['s']) . "%' OR s_title_en LIKE '%" . htmlspecialchars($get['s']) . "%' OR s_description LIKE '%" . htmlspecialchars($get['s']) . "%' OR s_slug LIKE '%" . htmlspecialchars($get['s']) . "%' OR s_mainKeyword LIKE '%" . htmlspecialchars($get['s']) . "%' OR seo_title LIKE '%" . htmlspecialchars($get['s']) . "%')";
            $_input = array();
            $_order = "ORDER BY s.s_id DESC";
            $_limit = "";
            $_join = "";
            return $this->getServiceData(False, $userId, $_where, $_order, $_limit, $_input, $_join, False);
        }
    }

?>