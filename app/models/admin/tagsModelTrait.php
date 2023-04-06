<?php

trait tagsModelTrait
{
    function getPostTag($id)
    {
        $result = $this->doSelect("SELECT pt_tag_id FROM tbl_blog_tag WHERE pt_post_id=?", array($id));
        $data = array();
        foreach ($result as $res){
            $data[]=$res['pt_tag_id'];
        }
        return $data;
    }

    function getTagsAjax($get)
    {
        $columns = array(
            array('db' => 't_id', 'dt' => 0),
            array('db' => 'tag', 'dt' => 1),
            array('db' => 'date', 'dt' => 2),
            array('db' => 'status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['t_id'] . '" data-id="' . $row['t_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['t_id'] . '" data-id="' . $row['t_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش منبع" data-target="#edit-Modal" id="btn-edit-' . $row['t_id'] . '" data-id="' . $row['t_id'] . '" data-name="' . $row['tag'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف منبع" data-target="#del-Modal" id="btn-del-style-' . $row['t_id'] . '" data-id="' . $row['t_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_tags $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(t_id) FROM tbl_tags $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(t_id) FROM tbl_tags");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getTag()
    {
        $sql = "SELECT tag,t_id FROM tbl_tags WHERE status=1";
        $result = $this->doSelect($sql);

        return $result;
    }

    function addTag($post, $id)
    {
        try {
            $sql = "SELECT * FROM tbl_tags WHERE tag=?";
            $param = array($post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("کلمه کلیدی دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_tags (tag,user_id,date) VALUES (?,?,?)";
                $params = [$post['title'], $id, $this->jaliliDate()];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن عبارت " . $post['title'] . " در بخش کلمات کلیدی");
                $this->response_success("کلمه کلیدی ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editTag($post, $admin)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("کلمه کلیدی مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_tags SET tag=?, date_edit=? , user_id_edit=? WHERE t_id=?";
                $params = [$post['titleEdit'], $this->jaliliDate(), $admin, $post['id']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش عبارت " . $post['titleEdit'] . " در بخش کلمات کلیدی");
                $this->response_success("عبارت ".$post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusTag($post)
    {
        try {
            $this->doQuery("UPDATE tbl_tags SET status=(case when status=1 then 0 else 1 end) WHERE t_id=?", array($post['id']));

            $result = $this->doSelect("SELECT status, tag FROM tbl_tags WHERE t_id=?", array($post['id']), 1);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ".$result['name']." در کلمات کلیدی");
                $this->response_success("کلمه کلیدی ".$result['name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ".$result['name']." در کلمات کلیدی");
                $this->response_success("کلمه کلیدی ".$result['name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delTag($post)
    {
        try {
            $result = $this->doSelect("SELECT tag FROM tbl_tags WHERE t_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_tags WHERE t_id=?", array($post['id']));

                $this->ActivityLog("حذف عبارت " . $result['0']['tag'] . " از بخش کلمات کلیدی");
                $this->response_success("عبارت ".$result['0']['tag']." باموفقیت حذف شد");
            } else {
                $this->response_error("کلمه کلیدی مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}
