<?php
trait categoryModelTrait
{
    function getCategoryChild($type, $id=0)
    {
        $datas = $this->doSelect("SELECT id, name FROM tbl_category WHERE id != 1 and id != 2 and status=1 and c_type=? and parent_id=? ORDER BY name ASC", array($type, $id));
        $children ='';
        $arr = json_decode($children, TRUE);
        if(sizeof($datas) > 0) {
            foreach($datas as $data) {
                $arr[] = [
                    'id' => $data['id'],
                    'text' => $data['name'],
                    'inc' => $this->getCategoryChild($type, $data['id'])
                ];
            }
        }

        return $arr;
    }

    function getCategory($type='')
    {
        if($type != ''){
            $data = $this->doSelect("SELECT * FROM tbl_category WHERE id != 1 and id != 2 and status=1 and c_type=? ORDER BY name ASC", array($type));
        } else {
            $data = $this->doSelect("SELECT * FROM tbl_category WHERE id != 1 and id != 2 and status=1 ORDER BY name ASC");
        }

        return $data;
    }

    function addCategory($post)
    {
        try {
            $sql = "SELECT * FROM tbl_category WHERE link=? and c_type=?";
            $param = array($post['slug'], $post['type']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("دسته بندی دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_category (name, parent_id, link, c_type, description, status) VALUES (?,?,?,?,?,?)";
                $params = array($post['title'], $post['parent'], $post['slug'], $post['type'], $post['description'], 1);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در دسته بندی ها");
                $this->response_success("دسته بندی ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editCategory($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_category WHERE id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("دسته بندی مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_category SET name=?, link=?, parent_id=?, description=? WHERE id=?";
                $params = array($post['titleEdit'], $post['slugEdit'], $post['parentEdit'], $post['descriptionEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات دسته " . $post['titleEdit']);
                $this->response_success("اطلاعات دسته بندی ".$post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusCategory($post)
    {
        try {
            $this->doQuery("UPDATE tbl_category SET status=(case when status=1 then 0 else 1 end) WHERE id=?", array($post['id']));
            $result = $this->doSelect("SELECT status, name FROM tbl_category WHERE id=?", array($post['id']), 1);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت دسته ".$result['name']);
                $this->response_success("دسته بندی ".$result['name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت دسته ".$result['name']);
                $this->response_success("دسته بندی ".$result['name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCategoryInfo($attrId)
    {
        $result = $this->doSelect("SELECT * FROM tbl_category WHERE id=?", array($attrId), 1);
        return $result;
    }

    function getIssetCategory($id)
    {
        return $this->doSelect( "SELECT id FROM tbl_category WHERE id= ?", array($id));
    }

    function delCategory($post)
    {
        try {
            $result = $this->doSelect("SELECT name FROM tbl_category WHERE id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_blog WHERE cat_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_category WHERE id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_variants_category WHERE cat_id=?", array($post['id']));

                $this->ActivityLog("حذف دسته بندی " . $result['0']['name']);
                $this->response_success("دسته بندی ".$result['0']['name']." باموفقیت حذف شد");
            } else {
                $this->response_error("دسته بندی مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCategoryAjax($get)
    {
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => 'link', 'dt' => 2),
            array('db' => 'parent_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d != 0){
                        $result = $this->doSelect("SELECT name FROM tbl_category WHERE id=?", array($d), 1);
                        return $result['name'];
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'count', 'dt' => 4),
            array('db' => 'status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    $btn='';
                    if($row['c_type'] == "blog"){
                        $btn .= '<a style="margin: 1px;" class="btn btn-success btn-xs" title="مشاهده دسته بندی" target="_blank" href="blog/category/' . $row['link'] . '"><i class="fa fa-eye"></i></a>';
                    }

                    if($row['c_removable'] == 1) {
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش دسته بندی" data-target="#edit-Modal" id="btn-edit-' . $row['id'] . '" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-parent-category="' . $row['parent_id'] . '" data-link="' . $row['link'] . '" data-description="' . $row['description'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف دسته بندی" data-target="#del-Modal" id="btn-del-style-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
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
            $where.="WHERE c_type='".$get['type']."'";
        }else{
            $where.=" AND c_type='".$get['type']."'";
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_category $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(id) FROM tbl_category $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(id) FROM tbl_category WHERE c_type='".$get['type']."'");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

}
