<?php

trait storeroomModelTrait
{
    function getStoreroomAjax($get)
    {
        $columns = array(
            array('db' => 'product_vids_id', 'dt' => 0),
            array(
                'db' => 'product_vids_id', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array('db' => 'sr_name', 'dt' => 2),
            array(
                'db' => 'sr_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT spi_count AS count FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1";
                    $result = $this->doSelect($sql, array($row['product_vids_id']), 1);
                    return $result['count'] == null ? 0 : $result['count'];
                }
            ),
            array(
                'db' => 'sr_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT spi_count AS count FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1";
                    $result = $this->doSelect($sql, array($row['product_vids_id']), 1);
                    $count = $result['count'] == null ? 0 : $result['count'];
                    if($count>0){
                        return '<button class="btn btn-success btn-xs">موجود</i></button>';
                    } else {
                        return '<button class="btn btn-danger btn-xs">ناموجود</i></button>';
                    }
                }
            ),
            array(
                'db' => 'product_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT spi_count AS count, spi_purchase_date AS date FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1";
                    $result = $this->doSelect($sql, array($row['product_vids_id']), 1);

                    $btn= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش موجودی کالا" data-target="#edit-inventory-Modal" id="btn-edit-inventory-' . $row['product_vids_id'] . '" data-id="' . $row['product_vids_id'] . '" data-count="' . $result['count'] . '" data-date="' . $result['date'] . '" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
                    $btn.= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش کالا" data-target="#edit-Modal" id="btn-edit-' . $row['product_vids_id'] . '" data-id="' . $row['product_vids_id'] . '" data-name="' . $row['sr_name'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کالا" data-target="#del-Modal" id="btn-del-style-' . $row['product_vids_id'] . '" data-id="' . $row['product_vids_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE storeroom_id=".$get['id'];
        }else{
            $where.=" AND storeroom_id=".$get['id'];
        }

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_storeroom_product $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(product_vids_id) FROM tbl_storeroom_product $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(product_vids_id) FROM tbl_storeroom_product");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addStoreroom($post)
    {
        $result = $this->doSelect("SELECT * FROM tbl_storeroom WHERE s_name=?", array($post['name']));

        if (sizeof($result) > 0) {
            $this->response_warning("انبار دیگری با این مشخصات قبلا ثبت شده است", "exist");
        } else {
            $vids = $this->getLastId("storeroom");

            $sql2 = "INSERT INTO tbl_storeroom (storeroom_vids_id,s_name,s_storekeeper,branch_id,s_date,s_status) VALUES (?,?,?,?,?,?)";
            $params = [$vids, $post['name'], $post['storekeeper'], $post['branch'], $this->jaliliDate("Y/m/d"), 1];
            $this->doQuery($sql2, $params);

            $this->ActivityLog("افزودن " . $post['name']." در لیست انبارها");
            $this->updateLastId("storeroom");

            $this->response_success("انبار ".$post['name']." با موفقیت ثبت شد");
        }
    }

    function addPieces($post)
    {
        $sql = "SELECT * FROM tbl_storeroom_product WHERE storeroom_id=? AND sr_name=?";
        $param = array($post['storeroom'], $post['name']);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            $this->response_warning("کالای دیگری با این مشخصات قبلا ثبت شده است", "exist");
        } else {
            $vids = $this->getLastId("product");

            $params = array($vids, $post['storeroom'], $post['name']);
            $this->doQuery("INSERT INTO tbl_storeroom_product (product_vids_id,storeroom_id,sr_name) VALUES (?,?,?)", $params);

            $this->updateLastId("product");

            $count=0;
            if($post['countPiece']!="" AND is_numeric($post['countPiece'])){
                $count = $post['countPiece'];
            }

            if($count>0) {
                $sql = "INSERT INTO tbl_storeroom_product_inventory (storeroom_id,product_id,spi_total_inventory,spi_count,spi_create_date,spi_purchase_date,spi_existing_completion_date,spi_status) VALUES (?,?,?,?,?,?,?,?)";
                $params = array($post['storeroom'], $vids, $count, $count, self::jaliliDate(), $post['purchase_date'], NULL, 1);
                $this->doQuery($sql, $params);
            }

            $result = $this->doSelect("SELECT * FROM tbl_storeroom WHERE storeroom_vids_id=?", array($post['storeroom']), 1);

            $this->ActivityLog("افزودن " . $post['name']." به انبار ".$result['s_name']);
            $this->response_success("کالای ".$post['name']." با موفقیت به انبار ".$result['s_name']." ثبت شد");
        }
    }

    function getStoreroomListAjax($get)
    {
        $columns = array(
            array('db' => 'storeroom_vids_id', 'dt' => 0),
            array('db' => 's_name', 'dt' => 1),
            array(
                'db' => 'branch_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($d != 0){
                        $result = $this->doSelect("SELECT b_name FROM tbl_branches WHERE branch_vids_id=?", array($d), 1);
                        return $result['b_name'];
                    } else {
                        return "-";
                    }
                }
            ),
            array(
                'db' => 's_storekeeper', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array(
                'db' => 's_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['storeroom_vids_id'] . '" data-id="' . $row['storeroom_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['storeroom_vids_id'] . '" data-id="' . $row['storeroom_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array(
                'db' => 'storeroom_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '<a style="margin: 1px;" class="btn btn-success btn-xs" title="مشاهده کالاهای انبار" href="'.ADMIN_PATH.'/storeroom/products/' . $row['storeroom_vids_id'] . '"><i class="fa fa-shopping-cart"></i></a>';
                    $btn.= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش انبار" data-target="#edit-Modal" id="btn-edit-' . $row['storeroom_vids_id'] . '" data-id="' . $row['storeroom_vids_id'] . '" data-name="' . $row['s_name'] . '" data-storekeeper="' . $row['s_storekeeper'] . '" data-branch="' . $row['branch_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف انبار" data-target="#del-Modal" id="btn-del-style-' . $row['storeroom_vids_id'] . '" data-id="' . $row['storeroom_vids_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT s.* FROM tbl_storeroom s  $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(storeroom_vids_id) FROM tbl_storeroom s $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(storeroom_vids_id) FROM tbl_storeroom");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusStoreroomList($post)
    {
        try {
            $this->doQuery("UPDATE tbl_storeroom SET s_status=(case when s_status=1 then 0 else 1 end) WHERE storeroom_vids_id=?", array($post['id']));
            $result = $this->doSelect("SELECT s_status,s_name FROM tbl_storeroom WHERE storeroom_vids_id=?", array($post['id']), 1);

            if ($result['s_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت " . $result['s_name'] . " در بخش انبارها ");
                $this->response_success("انبار " . $result['s_name'] . " باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت " . $result['s_name'] . " در بخش انبارها ");
                $this->response_success("انبار " . $result['s_name'] . " باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delStoreroomList($post)
    {
        try {
            $result = $this->doSelect("SELECT s_name FROM tbl_storeroom WHERE storeroom_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_storeroom WHERE storeroom_vids_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_storeroom_product WHERE storeroom_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_storeroom_product_inventory WHERE storeroom_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_product WHERE storeroom_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['s_name'] . " از لیست انبارها");
                $this->response_success("انبار ".$result['0']['s_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("انبار مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delPieces($post)
    {
        try {
            $result = $this->doSelect("SELECT sp.sr_name,s.s_name FROM tbl_storeroom_product sp LEFT JOIN tbl_storeroom s ON sp.storeroom_id=s.storeroom_vids_id WHERE product_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_storeroom_product WHERE product_vids_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_storeroom_product_inventory WHERE product_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_product WHERE product_id=?", array($post['id']));

                $this->ActivityLog("حذف کالای " . $result['0']['sr_name'] . " از انبار" . $result['0']['s_name']);
                $this->response_success("کالای ".$result['0']['sr_name']." باموفقیت از انبار ".$result['0']['s_name']." حذف شد");
            } else {
                $this->response_error("کالای مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editPieces($post)
    {
        $result = $this->doSelect("SELECT * FROM tbl_storeroom_product WHERE sr_name=? and product_vids_id!=?", array($post['nameEdit'], $post['id']));

        if (sizeof($result) > 0) {
            $this->response_warning("کالای دیگری با این مشخصات قبلا ثبت شده است", "exist");
        } else {
            $sql = "UPDATE tbl_storeroom_product SET sr_name=? WHERE product_vids_id=?";
            $this->doQuery($sql, array($post['nameEdit'], $post['id']));

            $this->ActivityLog("ویرایش اطلاعات کالای " . $post['nameEdit']);
            $this->response_success("اطلاعات کالای ".$post['nameEdit']." با موفقیت ویرایش شد");
        }
    }

    function editPiecesInventory($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_storeroom_product WHERE product_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("کالای مورد نظر یافت نشد");
            } else {
                $sql = "SELECT * FROM tbl_storeroom_product_inventory WHERE product_id=? AND spi_purchase_date=?";
                $result = $this->doSelect($sql, array($post['id'], $post['purchase_dateEdit']));

                $existing_completion_date = self::jaliliDate();
                $status = 0;
                if ($post['countPieceEdit'] > 0) {
                    $status = 1;
                    $existing_completion_date = NULL;
                }

                if (sizeof($result) > 0) {
                    $sql = "UPDATE tbl_storeroom_product_inventory SET spi_total_inventory=?, spi_count=?, spi_existing_completion_date=?, spi_status=? WHERE product_id=? AND spi_purchase_date=?";
                    $this->doQuery($sql, array($post['countPieceEdit'], $post['countPieceEdit'], $existing_completion_date, $status, $post['id'], $post['purchase_dateEdit']));
                } else {
                    $sql = "INSERT INTO tbl_storeroom_product_inventory (storeroom_id,product_id,spi_total_inventory,spi_count,spi_create_date,spi_purchase_date,spi_existing_completion_date,spi_status) VALUES (?,?,?,?,?,?,?,?)";
                    $params = array($post['storeroom'], $post['id'], $post['countPieceEdit'], $post['countPieceEdit'], self::jaliliDate(), $post['purchase_dateEdit'], $existing_completion_date, $status);
                    $this->doQuery($sql, $params);
                }

                $result = $this->doSelect("SELECT * FROM tbl_storeroom_product WHERE product_vids_id=?", array($post['id']), 1);
                $this->ActivityLog("ویرایش اطلاعات موجودی کالای " . $result['sr_name']);
                $this->response_success("اطلاعات موجودی کالای ".$post['title']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getStoreroomForSaleAjax($post)
    {
        if (isset($post)) {
            $sql = "SELECT CONCAT(sr_name, ' - ') as text, product_vids_id as id
                    FROM tbl_storeroom_product
                    WHERE sr_status=1 AND storeroom_id=?
                    AND sr_name LIKE '%" . $post['searchTerm'] . "%'";
            $params = array($post['storeroom']);
            $result = $this->doSelect($sql, $params);

            if (sizeof($result) > 0) {
                echo json_encode($result);
            } else {
                echo "notfound";
            }
        }
    }

    function getStoreroomList($id='')
    {
        if($id=='') {
            $result = $this->doSelect("SELECT * FROM tbl_storeroom WHERE s_status=1");
        } else {
            $result = $this->doSelect("SELECT * FROM tbl_storeroom WHERE storeroom_vids_id=?", array($id), 1);
        }

        return $result;
    }

    function getIssetStoreroom($id)
    {
        $result = $this->doSelect("SELECT storeroom_vids_id FROM tbl_storeroom WHERE storeroom_vids_id= ?", array($id));
        return $result;
    }

    function editStoreroom($post)
    {
        $result = $this->doSelect("SELECT * FROM tbl_storeroom WHERE storeroom_vids_id=?", array($post['id']));

        if (sizeof($result) <= 0) {
            $this->response_error("انبار مورد نظر یافت نشد");
        } else {
            $sql = "UPDATE tbl_storeroom SET s_name=?, s_storekeeper=?, branch_id=? WHERE storeroom_vids_id=?";
            $params = array($post['nameEdit'], $post['storekeeperEdit'], $post['branchEdit'], $post['id']);
            $this->doQuery($sql, $params);

            $this->ActivityLog("ویرایش اطلاعات " . $post['nameEdit'] . " در بخش انبار");
            $this->response_success("اطلاعات انبار ".$post['nameEdit']." با موفقیت ویرایش شد");
        }
    }

    function getStoreroomInfoEdit($attrId)
    {
        $sql = "SELECT * FROM tbl_storeroom WHERE storeroom_vids_id=? ";
        $result = $this->doSelect($sql, array($attrId));

        return $result;
    }

    function getPieceInfoEdit($attrId)
    {
        $sql = "SELECT * FROM tbl_storeroom_product WHERE product_vids_id=?";
        $param = array($attrId);
        $result = $this->doSelect($sql, $param);

        return $result;
    }

}
