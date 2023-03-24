<?php

trait statusesModelTrait
{
    function getStatus($type)
    {
        $result = $this->doSelect("SELECT * FROM tbl_status WHERE type=? and status=1", array($type));
        return $result;
    }

    function getStatusAjax($get)
    {
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'code', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d ?? "-";
                }
            ),
            array('db' => 'text', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return nl2br($d);
                }
            ),
            array('db' => 'status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '<button style="margin: 1px;" data-toggle="modal" title="ویرایش وضعیت" data-target="#edit-Modal" id="btn-edit-' . $row['id'] . '" data-id="' . $row['id'] . '" data-name="' . $row['title'] . '" data-code="' . $row['code'] . '" data-show_in_status="' . $row['show_in_status'] . '" data-show_in_sms="' . $row['show_in_sms'] . '" data-text="' . $row['text'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    if($row['removable'] == 1) {
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف وضعیت" data-target="#del-Modal" id="btn-del-style-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    }
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE type='".$get['type']."'";
        }else{
            $where.=" AND type='".$get['type']."'";
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_status $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(id) FROM tbl_status $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(id) FROM tbl_status WHERE type='".$get['type']."'");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addStatus($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_status WHERE title=? and type=?", array($post['title'], $post['type']));

            $statusType = "";
            $type = "";
            if($post['type'] == "service"){
                $statusType = $post['type'];
                $type = "نوبت دهی خدمات";
            }

            if (sizeof($result) > 0) {
                $this->response_warning("وضعیت دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_status (title, text, code,show_in_status,show_in_sms,type, status) VALUES (?,?,?,?,?,?,?)";
                $params = array($post['title'], $post['description'], $post['code'], $post['show_in_status'], $post['show_in_sms'], $statusType, 1);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در بخش وضعیت های ".$type);
                $this->response_success("وضعیت ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editStatus($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_status WHERE id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("وضعیت مورد نظر یافت نشد");
            } else {
                $statusType = "";
                $type = "";
                if ($post['typeEdit'] == "service") {
                    $statusType = $post['typeEdit'];
                    $type = "نوبت دهی خدمات";
                }

                $sql = "UPDATE tbl_status SET title=?, code=?, show_in_status=?, show_in_sms=?, type=?, text=? WHERE id=?";
                $params = array($post['titleEdit'], $post['codeEdit'], $post['show_in_statusEdit'], $post['show_in_smsEdit'], $statusType, $post['descriptionEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات " . $post['titleEdit'] . " در بخش وضعیت های " . $type);
                $this->response_success("اطلاعات وضعیت ".$post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusStatus($post)
    {
        try {
            $this->doQuery("UPDATE tbl_status SET status=(case when status=1 then 0 else 1 end) WHERE id=?", array($post['id']));
            $result = $this->doSelect("SELECT status, title FROM tbl_status WHERE id=?", array($post['id']), 1);
            $this->ActivityLog("ویرایش وضعیت ".$result['title']);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ".$result['title']);
                $this->response_success("وضعیت مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ".$result['title']);
                $this->response_success("وضعیت مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delStatus($post)
    {
        try {
            $result = $this->doSelect("SELECT title,type FROM tbl_status WHERE id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $type = "نامشخص";
                if ($result['0']['type'] == "service") {
                    $type = "خدمات";
                }

                $this->doQuery("DELETE FROM tbl_status WHERE id=?", array($post['id']));

                $this->ActivityLog("حذف وضعیت " . $result['0']['title'] . " از لیست وضعیت های " . $type);
                $this->response_success("وضعیت ".$result['0']['title']." باموفقیت حذف شد");
            } else {
                $this->response_error("مطلب مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}
