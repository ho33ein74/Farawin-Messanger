<?php

trait servicesModelTrait
{
    function getBranches()
    {
        $result = $this->doSelect("SELECT b_name,branch_vids_id FROM tbl_branches WHERE b_status=1");
        return $result;
    }

    function addBranch($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_branches WHERE b_name=?", array($post['name']));

            if (sizeof($result) > 0) {
                $this->response_warning("شعبه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $vids = $this->getLastId("branch");

                $sql3 = "INSERT INTO tbl_branches (branch_vids_id,b_name,b_manager,b_phone,province_id,city_id,b_address,b_date,b_status) VALUES (?,?,?,?,?,?,?,?,?)";
                $params1 = [$vids, $post['name'], $post['manager'], $post['phone'], $post['provinceId'], $post['cityId'], $post['address'], $this->jalali_date("Y/m/d"), 1];
                $this->doQuery($sql3, $params1);

                $this->updateLastId("branch");

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش شعبه ها");
                $this->response_success("شعبه " . $post['name'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getBranchesAjax($get)
    {
        $columns = array(
            array('db' => 'branch_vids_id', 'dt' => 0),
            array('db' => 'b_name', 'dt' => 1),
            array('db' => 'b_manager', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array('db' => 'b_phone', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array('db' => 'b_address', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array('db' => 'b_status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['branch_vids_id'] . '" data-id="' . $row['branch_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['branch_vids_id'] . '" data-id="' . $row['branch_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array( 'db' => 'branch_vids_id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش شعبه" data-target="#edit-Modal" id="btn-edit-' . $row['branch_vids_id'] . '" data-id="' . $row['branch_vids_id'] . '" data-name="' . $row['b_name'] . '" data-manager="' . $row['b_manager'] . '" data-address="' . $row['b_address'] . '" data-phone="' . $row['b_phone'] . '" data-provinces="' . $row['province_id'] . '" data-cities="' . $row['city_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف شعبه" data-target="#del-Modal" id="btn-del-style-' . $row['branch_vids_id'] . '" data-id="' . $row['branch_vids_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT b.* FROM tbl_branches b  $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(branch_vids_id) FROM tbl_branches b $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(branch_vids_id) FROM tbl_branches");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusBranch($post)
    {
        try {
            $this->doQuery("UPDATE tbl_branches SET b_status=(case when b_status=1 then 0 else 1 end) WHERE branch_vids_id=?", array($post['id']));
            $result = $this->doSelect("SELECT b_name,b_status FROM tbl_branches WHERE branch_vids_id=?", array($post['id']), 1);

            if ($result['b_status'] == 1) {
                $this->ActivityLog("فعال کردن " . $result[0]['b_name'] . " در بخش شعبه ها");
                $this->response_success("شعبه ".$result[0]['b_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعال کردن " . $result[0]['b_name'] . " در بخش شعبه ها");
                $this->response_success("شعبه ".$result[0]['b_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delBranch($post)
    {
        try {
            $result = $this->doSelect("SELECT b_name FROM tbl_branches WHERE branch_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_branches WHERE branch_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['b_name'] . " از لیست شعبه ها");
                $this->response_success("شعبه ".$result['0']['b_name']." با موفقیت حذف شد");
            } else {
                $this->response_error("شعبه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetBranch($id)
    {
        $result = $this->doSelect("SELECT branch_vids_id FROM tbl_branches WHERE branch_vids_id= ?",  array($id));
        return $result;
    }

    function getBranchesInfo($attrId = '')
    {
        if ($attrId != '') {
            $sql = "SELECT * FROM tbl_branches WHERE branch_vids_id=?";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT * FROM tbl_branches WHERE b_status=1";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function editBranch($post)
    {
        $result = $this->doSelect("SELECT * FROM tbl_branches WHERE branch_vids_id=?", array($post['id']));

        if (sizeof($result) <= 0) {
            $this->response_error("شعبه مورد نظر یافت نشد");
        } else {
            $sql = "UPDATE tbl_branches SET b_name=?, b_manager=?, b_phone=?, province_id=?, city_id=?, b_address=? WHERE branch_vids_id=?";
            $params = [$post['nameEdit'], $post['managerEdit'], $post['phoneEdit'], $post['provinceIdEdit'], $post['cityIdEdit'], $post['addressEdit'], $post['id']];
            $this->doQuery($sql, $params);

            $this->ActivityLog("ویرایش اطلاعات " . $post['nameEdit'] . " در بخش شعبه ها");
            $this->response_success("شعبه ".$post['nameEdit']." با موفقیت ویرایش شد");
        }
    }

    function getRatingsItemAjax($get)
    {
        $columns = array(
            array('db' => 'r_id', 'dt' => 0),
            array('db' => 'r_name', 'dt' => 1),
            array('db' => 'service_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($d != 0){
                        $_where = "WHERE s.s_id=?";
                        $_input = array($d);
                        $_order = "";
                        $_limit = "";
                        $_join = "";
                        $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

                        return $result['s_title'];
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'r_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['r_id'] . '" data-id="' . $row['r_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['r_id'] . '" data-id="' . $row['r_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'r_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش آیتم" data-target="#edit-Modal" id="btn-edit-' . $row['r_id'] . '" data-id="' . $row['r_id'] . '" data-name="' . $row['r_name'] . '" data-service="' . $row['service_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف آیتم" data-target="#del-Modal" id="btn-del-style-' . $row['r_id'] . '" data-id="' . $row['r_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array("cat_id"));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_ratings $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(r_id) FROM tbl_ratings $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(r_id) FROM tbl_ratings");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusRatingsItem($post)
    {
        try {
            $this->doQuery("UPDATE tbl_ratings SET r_status=(case when r_status=1 then 0 else 1 end) WHERE r_id=?", array($post['id']));
            $result = $this->doSelect("SELECT r_status, r_name FROM tbl_ratings WHERE r_id=?", array($post['id']), 1);

            if ($result['r_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت آیتم ".$result['r_name']);
                $this->response_success("آیتم ".$result['r_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت آیتم ".$result['r_name']);
                $this->response_success("آیتم ".$result['r_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addRatingsItem($post)
    {
        try {
            $sql = "SELECT * FROM tbl_ratings WHERE r_name=? and service_id=?";
            $param = array($post['title'], $post['serviceId']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("آیتم دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_ratings (r_name,service_id,create_date) VALUES (?,?,?)";
                $params = [$post['title'], $post['serviceId'], $this->jalali_date()];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در آیتم های امتیازبندی");
                $this->response_success("آیتم ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editRatingsItem($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("آیتم مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_ratings SET r_name=? WHERE r_id=?";
                $params = array($post['titleEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات آیتم " . $post['titleEdit']);
                $this->response_success("آیتم ".$post['titleEdit']." باموفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delRatingsItem($post)
    {
        try {
            $result = $this->doSelect("SELECT r_name FROM tbl_ratings WHERE r_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_ratings WHERE r_id=?", array($post['id']));

                $this->ActivityLog("حذف آیتم " . $result['0']['r_name']);
                $this->response_success("آیتم ".$result['0']['r_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("آیتم مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getStaffInfoEdit($attrId)
    {
        $result = $this->doSelect("SELECT * FROM tbl_services_staff WHERE staff_vids_id=?", array($attrId));

        return $result;
    }

    function editStaff($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_staff WHERE staff_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("فرد مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/staffs/";

                $expertise = $post['expertise'] != "" ? $post['expertise'] : "-";
                $description = $post['description'] != "" ? $post['description'] : "-";
                $no_sheba = $post['no_sheba'] != "" ? $post['no_sheba'] : "-";
                $no_card = $post['no_card'] != "" ? $post['no_card'] : "-";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    if ($result[0]['image'] != NULL) {
                        unlink($dirCover . $result[0]['image']);
                    }
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                    $sql3 = "UPDATE tbl_services_staff SET image=? WHERE staff_vids_id=?";
                    $this->doQuery($sql3, array($coverImg, $post['id']));
                }

                $sql = "UPDATE tbl_services_staff SET name=?,expertise=?,description=?,no_sheba=?,no_card=? WHERE staff_vids_id=?";
                $params = [$post['name'], $expertise, $description, $no_sheba, $no_card, $post['id']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات " . $post['name'] . " در بخش پرسنل سالن");
                $this->response_success("اطلاعات فرد مورد نظر باموفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delStaff($post)
    {
        try{
            $result = $this->doSelect("SELECT name FROM tbl_services_staff WHERE staff_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_services_staff WHERE staff_vids_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_staff WHERE staff_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['name'] . " از لیست پرسنل سالن");
                $this->response_success("فرد مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("فرد مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getStaffs()
    {
        $sql = "SELECT s.name,s.staff_vids_id,s.r_id,s.description,s.status,count(os_id) AS numOrder
                    FROM tbl_services_staff s
                    LEFT JOIN tbl_services_reservation_staff tos ON s.staff_vids_id=tos.staff_id
                    GROUP BY s.name,s.staff_vids_id,s.r_id,s.description,s.status
                    ORDER BY s.name ASC";
        return $this->doSelect($sql);
    }

    function getStaffsList($attrId, $type)
    {
        if($type=="service") {
            $sql = "SELECT * FROM tbl_services_reservation_staff WHERE order_service_vids_id=?";
        }
        $result = $this->doSelect($sql, array($attrId));
        return $result;
    }

    function addStaff($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_staff WHERE name=?", array($post['name']));

            if (sizeof($result) > 0) {
                $this->response_warning("فرد دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/staffs/";
                $description = $post['description'] != "" ? $post['description'] : "-";
                $expertise = $post['expertise'] != "" ? $post['expertise'] : "-";
                $vids = $this->getLastId("staff");

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql = "INSERT INTO tbl_services_staff (staff_vids_id,name,image,expertise,description) VALUES (?,?,?,?,?)";
                $params = array($vids, $post['name'], $coverImg, $expertise, $description);
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش پرسنل سالن");
                $this->updateLastId("staff");

                $this->response_success("فرد جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getStaffAjax($get)
    {
        $columns = array(
            array('db' => 'staff_vids_id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => 'expertise', 'dt' => 2),
            array('db' => 'numOrder', 'dt' => 3),
            array('db' => 'staff_vids_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT SUM(os_profit) AS profit FROM tbl_services_reservation_staff WHERE staff_id=?";
                    $result = $this->doSelect($sql, array($row['staff_vids_id']), 1);
                    return number_format($result['profit']) ;
                }),
            array('db' => 'staff_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT SUM(os_profit) AS `sum` FROM tbl_services_reservation_staff WHERE staff_id=? AND os_settlement_sold=0";
                    $result = $this->doSelect($sql, array($row['staff_vids_id']), 1);
                    return $result['sum'] == null ? 0 : number_format($result['sum']) ;
                }),
            array('db' => 'status', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['staff_vids_id'] . '" data-id="' . $row['staff_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['staff_vids_id'] . '" data-id="' . $row['staff_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'staff_vids_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<a style="margin: 1px;" title="لیست کارهای انجام شده" class="btn btn-success btn-xs" href="'.ADMIN_PATH.'/staffs/services/' . $row['staff_vids_id'] . '"><i class="fa fa-eye"></i></a>';
                    $btn .= '<a style="margin: 1px;" title="ویرایش پرسنل" class="btn btn-warning btn-xs" href="'.ADMIN_PATH.'/staffs/edit/' . $row['staff_vids_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف فرد" data-target="#del-Modal" id="btn-del-style-' . $row['staff_vids_id'] . '" data-id="' . $row['staff_vids_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT s.*,count(os_id) AS numOrder
                    FROM tbl_services_staff s
                    LEFT JOIN tbl_services_reservation_staff tos
                    ON s.staff_vids_id=tos.staff_id $where GROUP BY s.name,s.r_id $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(staff_vids_id) FROM tbl_services_staff s $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(staff_vids_id) FROM tbl_services_staff");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusStaff($post)
    {
        try {
            $this->doQuery("UPDATE tbl_services_staff SET status=(case when status=1 then 0 else 1 end) WHERE staff_vids_id=?", array($post['id']));

            $result = $this->doSelect("SELECT status, name FROM tbl_services_staff WHERE staff_vids_id=?", array($post['id']), 1);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ".$result['name']);
                $this->response_success("فرد مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ".$result['name']);
                $this->response_success("فرد مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getStaffService($get)
    {
        if (isset($get)) {
            $sql = "SELECT st.*,ss.name FROM tbl_services_tariff st LEFT JOIN tbl_services_staff ss ON st.operator_id=ss.staff_vids_id WHERE service_id=? AND branch_id=? AND st.st_is_vip=? AND st.st_status=1";
            $result = $this->doSelect($sql, array($get['service_id'], $get['branch_id'], $get['is_vip']));

            if (sizeof($result) > 0) {
                echo json_encode($result);
            } else {
                echo "notfound";
            }
        }
    }

    function editStaffsList($post)
    {
        try {
            $this->doQuery("DELETE FROM tbl_services_reservation_staff WHERE order_service_vids_id=?", array($post['id']));

            $staffs = json_decode($post['staffs'], true);
            if (sizeof($staffs) > 0) {
                foreach ($staffs as $item) {
                    $profit = $item['profit'] != "" ? $item['profit'] : 0;
                    $received_date = $item['received_date'] != "" ? $item['received_date'] : "-";
                    $prepare_date = $item['prepare_date'] != "" ? $item['prepare_date'] : "-";
                    $settlement_repair = $item['settlement_sold'] == "true" ? 1 : 0;
                    $bank_fees = $item['bank_fees'] != "" ? $item['bank_fees'] : 0;

                    $sql3 = "INSERT INTO tbl_services_reservation_staff (order_service_vids_id, staff_id, os_profit, os_received_date, os_prepare_date, os_settlement_sold, os_bank_fees) VALUES (?,?,?,?,?,?,?)";
                    $params = [$post['id'], $item['staffId'], $profit, $received_date, $prepare_date, $settlement_repair, $bank_fees];
                    $this->doQuery($sql3, $params);
                }
            }

            $this->ActivityLog("ویرایش اطلاعات پرسنل نوبت " . $post['id']);
            $this->response_success("ویرایش پرسنل باموفقیت انجام شد.");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editProductsList($post)
    {
        try {
            $all_product_id = json_decode($post['all_product_id'], true);
            if (sizeof($all_product_id) > 0) {
                foreach ($all_product_id as $product) {
                    $productInfo = $this->doSelect("SELECT * FROM tbl_services_reservation_product WHERE srp_id=? ", array($product), 1);
                    $productInfoInventory = $this->doSelect("SELECT * FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1", array($productInfo['product_id']), 1);

                    $this->doQuery("UPDATE tbl_storeroom_product_inventory SET spi_count=spi_count+" . $productInfo['srp_count'] . " WHERE spi_id=?", array($productInfoInventory['spi_id']));

                    $checkInventory = $this->doSelect("SELECT * FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1", array($productInfo['product_id']), 1);
                    if ($checkInventory['spi_count'] > 0) {
                        $this->doQuery("UPDATE tbl_storeroom_product_inventory SET spi_status=1, spi_existing_completion_date=NULL WHERE spi_id=?", array($checkInventory['spi_id']));
                    }
                }

                $check_product_id = array();
                $products = json_decode($post['products'], true);
                foreach ($products as $item) {
                    $check_product_id[] = $item['srpId'];
                }
                $result = array_diff($all_product_id, $check_product_id);

                foreach ($result as $check) {
                    $this->doQuery("DELETE FROM tbl_services_reservation_product WHERE srp_id=?", array($check));
                }
            }

            $new_all_product_id = array();
            $products = json_decode($post['products'], true);
            if (sizeof($products) > 0) {
                foreach ($products as $item) {
                    $price = $item['price'] != "" ? $item['price'] : 0;
                    $date = $item['date'] != "" ? $item['date'] : "-";
                    $desc = $item['desc'] != "" ? $item['desc'] : "-";
                    $count = $item['count'] != "" ? $item['count'] : 0;

                    if ($item['srpId'] == 0) {
                        $sql = "INSERT INTO tbl_services_reservation_product (reservation_id, storeroom_id, product_id, srp_price, srp_date, srp_desc, srp_count) VALUES (?,?,?,?,?,?,?)";
                        $params = array($post['id'], $item['storeroom'], $item['productId'], $price, $date, $desc, $count);
                        $this->doQuery($sql, $params);
                        $new_all_product_id[] = Model::$conn->lastInsertId();
                    } else {
                        $sql = "UPDATE tbl_services_reservation_product SET srp_price=?, srp_date=?, srp_desc=?, srp_count=? WHERE srp_id=?";
                        $params = array($price, $date, $desc, $count, $item['srpId']);
                        $this->doQuery($sql, $params);

                        $productInfo = $this->doSelect("SELECT * FROM tbl_services_reservation_product WHERE srp_id=? ", array($product), 1);
                        $new_all_product_id[] = $item['srpId'];
                    }

                    $productInfoInventory = $this->doSelect("SELECT * FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1", array($item['productId']), 1);
                    $this->doQuery("UPDATE tbl_storeroom_product_inventory SET spi_count=spi_count-" . $count . " WHERE spi_id=?", array($productInfoInventory['spi_id']));

                    $checkInventory = $this->doSelect("SELECT * FROM tbl_storeroom_product_inventory WHERE product_id=? ORDER BY spi_id DESC LIMIT 1", array($item['productId']), 1);
                    if ($checkInventory['spi_count'] <= 0) {
                        $this->doQuery("UPDATE tbl_storeroom_product_inventory SET spi_count=0,spi_status=0,spi_existing_completion_date=? WHERE spi_id=?", array(self::jalali_date(), $checkInventory['spi_id']));
                    }
                }
            }

            $this->ActivityLog("ویرایش اطلاعات کالاهای مصرف شده برای سفارش " . $post['id']);
            $this->response_success("ویرایش کالاهای مصرفی باموفقیت انجام شد", "ok", "", json_encode($new_all_product_id));
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getOrderStaffAjax($get)
    {
        $columns = array(
            array('db' => 'os_id', 'dt' => 0),
            array('db' => 'order_service_vids_id', 'dt' => 1),
            array('db' => 'os_prepare_date', 'dt' => 2),
            array(
                'db' => 'os_profit', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($d);
                }
            ),
            array(
                'db' => 'os_settlement_sold', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($row['os_settlement_sold']==1) {
                        return '<span class="btn btn-success btn-xs">پرداخت شده</span>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-settlement-repair-' . $row['os_id'] . '" data-id="' . $row['os_id'] . '" class="btn btn-danger btn-xs">پرداخت نشده</i></button>';
                    }
                }
            ),
            array(
                'db' => 'order_service_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return '<a style="margin-left:5px;margin-right:5px" title="مشاهده و ویرایش سفارش" class="btn btn-success btn-xs" href="'.ADMIN_PATH.'/reservations/details/' . $d . '"><i class="fa fa-eye"></i></a>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE staff_id=".$_GET['id'];
        }else{
            $where.=" AND staff_id=".$_GET['id'];
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_services_reservation_staff $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(os_id) FROM tbl_services_reservation_staff $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(os_id) FROM tbl_services_reservation_staff WHERE staff_id=".$_GET['id']);
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getHolidaysAjax($get)
    {
        $columns = array(
            array('db' => 'h_id', 'dt' => 0),
            array('db' => 'h_title', 'dt' => 1),
            array('db' => 'h_date', 'dt' => 2),
            array('db' => 'h_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['h_id'] . '" data-id="' . $row['h_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['h_id'] . '" data-id="' . $row['h_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'h_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش روز" data-target="#edit-Modal" id="btn-edit-' . $row['h_id'] . '" data-id="' . $row['h_id'] . '" data-name="' . $row['h_title'] . '" data-date="' . $row['h_date'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف روز" data-target="#del-Modal" id="btn-del-style-' . $row['h_id'] . '" data-id="' . $row['h_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_holidays $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(h_id) FROM tbl_holidays $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(h_id) FROM tbl_holidays");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusHolidays($post)
    {
        try {
            $this->doQuery("UPDATE tbl_holidays SET h_status=(case when h_status=1 then 0 else 1 end) WHERE h_id=?", array($post['id']));
            $result = $this->doSelect("SELECT h_status, h_title FROM tbl_holidays WHERE h_id=?", array($post['id']), 1);

            if ($result['h_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت روز ".$result['h_title']);
                $this->response_success("روز ".$result['h_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت روز ".$result['h_title']);
                $this->response_success("روز ".$result['h_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addHolidays($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_holidays WHERE h_title=? and h_date=?", array($post['title'], $post['date']));
            if (sizeof($result) > 0) {
                $this->response_warning("روز دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql = "INSERT INTO tbl_holidays (h_title,h_date,h_status) VALUES (?,?,?)";
                $params = array($post['title'], $post['date'], 1);
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست روزهای تعطیل");
                $this->response_success("روز ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editHolidays($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_holidays WHERE h_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("روز مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_holidays SET h_title=?,h_date=? WHERE h_id=?";
                $params = array($post['titleEdit'], $post['dateEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات روز " . $post['titleEdit']);
                $this->response_success("اطلاعات روز ". $post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delHolidays($post)
    {
        try {
            $result = $this->doSelect("SELECT h_title FROM tbl_holidays WHERE h_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_holidays WHERE h_id=?", array($post['id']));

                $this->ActivityLog("حذف روز " . $result['0']['h_title']." از لیست روزهای تعطیل");
                $this->response_success("روز ".$result['0']['h_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("روز مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function imageServicePortfolio($post)
    {
        try {
            $dirCover = "public/images/services/portfolio/";

            $coverImg = NULL;
            if (isset($_FILES["file"]["tmp_name"])) {
                $coverImg = time() . "_" . $_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"], $dirCover . $coverImg);
            }

            $order = $this->doSelect("SELECT MAX(i_order) as order_num FROM tbl_images WHERE post_id=? AND i_type=? LIMIT 1", array($_GET['id'], "service-portfolio"), 1);
            $sql = "INSERT INTO tbl_images (post_id,i_type,i_image,i_alt,i_order,i_status) VALUES (?,?,?,?,?,?)";
            $params = array($_GET['id'], 'service-portfolio', $coverImg, NULL, ($order['order_num']+1), 1);
            $this->doQuery($sql, $params);
            $imageId = Model::$conn->lastInsertId();

            $dataSelect = array(
                "id" => $imageId,
                "path" => $dirCover . $coverImg,
                "name" => $coverImg
            );

            echo json_encode($dataSelect);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getImagesServicePortfolio($id)
    {
        $result = $this->doSelect("SELECT * FROM tbl_images WHERE post_id=? AND i_type=? ORDER BY i_order ASC", array($id, "service-portfolio"));
        return $result;
    }

    function imageServicePortfolioOrder($post)
    {
        try {
            foreach ($post['order'] as $order) {
                $this->doQuery("UPDATE tbl_images SET i_order=? WHERE i_id=?", array($order['position'], $order['id']));
            }

            $this->response_success("تصویر جدید با موفقیت ثبت شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editImageAltServicePortfolio($post)
    {
        $result = $this->doSelect("SELECT * FROM tbl_images WHERE i_id=?", array($post['pk']));

        if (sizeof($result) == 0) {
            $this->response_error("تصویر مورد نظر یافت نشد");
        } else {
            $this->doQuery("UPDATE tbl_images SET i_alt=? WHERE i_id=?", array($post['value'], $post['pk']));
            $this->response_success("توضیحات باموفقیت ذخیره شد");
        }
    }

    function delImageServicePortfolio($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_images WHERE i_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_images WHERE i_id=?", array($post['id']));
                unlink("public/images/services/portfolio/" . $result[0]['i_image']);

                $this->response_success("تصویر مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("تصویر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getServicesAjax($get)
    {
        $columns = array(
            array('db' => 's_id', 'dt' => 0),
            array('db' => 's_title', 'dt' => 1),
            array('db' => 's_cover', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $file = '<img onerror="this.src=\'public/images/default_cover.jpg\'" width="80px" height="50px" src="public/images/services/' . $d . '">';
                    return $file;
                }
            ),
            array('db' => 's_view', 'dt' => 3),
            array('db' => 's_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 's_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn = '<a style="margin: 1px;" title="مشاهده خدمت" class="btn btn-success btn-xs" target="_blank" href="' . URL . 'services/' . $row['s_slug'] . '"><i class="fa fa-eye"></i></a>';
                    $btn .= '<a style="margin: 1px;" title="ویرایش خدمت" class="btn btn-warning btn-xs" href="'.ADMIN_PATH.'/services/edit/' . $row['s_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" title="ارسال اطلاعات خدمت در کانال تلگرام" data-toggle="modal" data-target="#telegram-Modal" id="btn-send-telegram-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-info btn-xs"><i class="fa fa-paper-plane"></i></button>';
                    $btn .= '<a style="margin: 1px;" title="تعرفه های خدمت" class="btn btn-social-icon btn-flickr btn-xs" href="'.ADMIN_PATH.'/services/tariff/' . $row['s_id'] . '"><i class="fa fa-money"></i></a>';
                    $btn .= '<a style="margin: 1px;" title="زمانبندی خدمت" class="btn btn-social-icon btn-vk btn-xs" href="'.ADMIN_PATH.'/services/timing/' . $row['s_id'] . '"><i class="fa fa-clock-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" title="حذف خدمت" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_services $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(s_id) FROM tbl_services $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(s_id) FROM tbl_services");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getServicesTag($id)
    {
        $result = $this->doSelect("SELECT tag_id FROM tbl_services_tag WHERE service_id=?", array($id));
        return $result;
    }

    function getIssetServices($id)
    {
        $_where = "WHERE s.s_id=?";
        $_input = array($id);
        $_order = "";
        $_limit = "";
        $_join = "";
        return $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function addServices($post, $admin)
    {
        try {
            $_where = "WHERE s.s_title=? OR s.s_slug=?";
            $_input = array($post['fa_title'], str_replace(" ", "-", $post['url']));
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

            if (sizeof($result) > 0) {
                $this->response_warning("خدمت دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/services/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql = "INSERT INTO tbl_services (s_title,s_title_en,s_calendar_background_color,seo_title,seo_desc,s_slug,s_description,s_recovery_times,s_recovery_times_desc,s_avg_time_to_do,s_durability,s_cover,s_mainKeyword,s_date_created,s_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $params = array($post['fa_title'], $post['en_title'], $post['calendar_background_color'], $post['seo_title'], $post['seo_desc'], str_replace(" ", "-", $post['url']), htmlspecialchars($post['description']), $post['recovery_times'], $post['recovery_times_desc'], $post['avg_time_to_do'], $post['durability'], $coverImg, $post['mainKeyword'], $this->jalali_date(), $post['status']);
                $this->doQuery($sql, $params);
                $serviceId = Model::$conn->lastInsertId();

                if ($serviceId != "") {
                    if ($post['related_post'] != NULL and $post['related_post'] != "null" and $post['related_post'] != " " and $post['related_post'] != "") {
                        $related_post = explode(",", rtrim($post['related_post'], ","));
                        foreach ($related_post as $item) {
                            $sqlTag = "SELECT * FROM tbl_services_related_blog WHERE service_id=? AND blog_id=?";
                            $result = $this->doSelect($sqlTag, array($serviceId, $item));

                            if (sizeof($result) == 0) {
                                $sql = "INSERT INTO tbl_services_related_blog (service_id,blog_id) VALUES (?,?)";
                                $this->doQuery($sql, array($serviceId, $item));
                            }
                        }
                    }

                    $this->doQuery("INSERT INTO tbl_services_timing (service_id) VALUES (?)", array($serviceId));

                    if ($post['tags'] != NULL and $post['tags'] != "null" and $post['tags'] != " " and $post['tags'] != "") {
                        $tagsNew = explode(",", $post['tags']);
                        $tagID = '';
                        foreach ($tagsNew as $tag) {
                            $result = $this->doSelect("SELECT * FROM tbl_tags WHERE tag=?", array($tag));
                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_tags (tag,user_id,date,count) VALUES (?,?,?,?)";
                                $this->doQuery($sqlTags, array($tag, $admin, $this->jalali_date(), 1));
                                $tagID .= Model::$conn->lastInsertId() . ",";
                            } else {
                                $this->doQuery("UPDATE tbl_tags SET count=count+1 WHERE t_id=?", array($result[0]['t_id']));
                                $tagID .= $result[0]['t_id'] . ",";
                            }
                        }
                        $tags = $tagID;
                    }

                    if ($tags == "null") {
                        $tags = NULL;
                    }

                    if ($tags != NULL) {
                        $tagsInsert = explode(",", rtrim($tags, ","));
                        foreach ($tagsInsert as $tag) {
                            $sqlTag = "SELECT * FROM tbl_services_tag WHERE service_id=? AND tag_id=?";
                            $result = $this->doSelect($sqlTag, array($serviceId, $tag));

                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_services_tag (service_id,tag_id) VALUES (?,?)";
                                $this->doQuery($sqlTags, array($serviceId, $tag));
                            }
                        }
                    }
                }

                $this->ActivityLog("افزودن " . $post['fa_title'] . " در بخش خدمات");
                $this->response_success("خدمت ".$post['fa_title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editServices($post, $admin)
    {
        try {
            $_where = "WHERE s.s_id=?";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

            if (sizeof($result) <= 0) {
                $this->response_error("خدمت مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/services/";

                if (isset($_FILES["cover"]["tmp_name"])) {
                    unlink($dirCover . $result[0]['s_cover']);
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                    $this->doQuery("UPDATE tbl_services SET s_cover=? WHERE s_id=?", array($coverImg, $post['id']));
                }

                //remove old tags
                $tags = $this->doSelect("SELECT * FROM tbl_services_tag WHERE service_id=?", array($post['id']));
                foreach ($tags as $tag) {
                    $this->doQuery("UPDATE tbl_tags SET count=count-1 WHERE t_id=?", array($tag['tag_id']));
                }
                $this->doQuery("DELETE FROM tbl_services_tag WHERE service_id=?", array($post['id']));

                //add new tags
                $tags = $post['tags'];
                if ($post['id'] != "") {
                    //remove old related
                    $this->doQuery("DELETE FROM tbl_services_related_blog WHERE service_id=?", array($post['id']));
                    if ($post['related_post'] != NULL and $post['related_post'] != "null" and $post['related_post'] != " " and $post['related_post'] != "") {
                        $related_post = explode(",", rtrim($post['related_post'], ","));
                        foreach ($related_post as $item) {
                            $sqlTag = "SELECT * FROM tbl_services_related_blog WHERE service_id=? AND blog_id=?";
                            $result = $this->doSelect($sqlTag, array($post['id'], $item));

                            if (sizeof($result) == 0) {
                                $sql = "INSERT INTO tbl_services_related_blog (service_id,blog_id) VALUES (?,?)";
                                $this->doQuery($sql, array($post['id'], $item));
                            }
                        }
                    }

                    if ($post['tags'] != NULL and $post['tags'] != "null" and $post['tags'] != " " and $post['tags'] != "") {
                        $tagsNew = explode(",", $post['tags']);
                        $tagID = '';
                        foreach ($tagsNew as $tag) {
                            $result = $this->doSelect("SELECT * FROM tbl_tags WHERE tag=?", array($tag));
                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_tags (tag,user_id,date,count) VALUES (?,?,?,?)";
                                $this->doQuery($sqlTags, array($tag, $admin, $this->jalali_date(), 1));
                                $tagID .= Model::$conn->lastInsertId() . ",";
                            } else {
                                $this->doQuery("UPDATE tbl_tags SET count=count+1 WHERE t_id=?", array($result[0]['t_id']));
                                $tagID .= $result[0]['t_id'] . ",";
                            }
                        }
                        $tags = $tagID;
                    }

                    if ($tags == "null") {
                        $tags = NULL;
                    }

                    if ($tags != NULL) {
                        $tagsInsert = explode(",", rtrim($tags, ","));
                        foreach ($tagsInsert as $tag) {
                            $sqlTag = "SELECT * FROM tbl_services_tag WHERE service_id=? AND tag_id=?";
                            $result = $this->doSelect($sqlTag, array($post['id'], $tag));

                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_services_tag (service_id,tag_id) VALUES (?,?)";
                                $this->doQuery($sqlTags, array($post['id'], $tag));
                            }
                        }
                    }
                }

                $sql = "UPDATE tbl_services SET s_title=?, s_title_en=?, s_calendar_background_color=?, seo_title=?, seo_desc=?, s_slug=?, s_description=?, s_recovery_times=?, s_recovery_times_desc=?, s_avg_time_to_do=?, s_durability=?, s_mainKeyword=?, s_status=? WHERE s_id=?";
                $params = array($post['fa_title'], $post['en_title'], $post['calendar_background_color'], $post['seo_title'], $post['seo_desc'], str_replace(" ", "-", $post['url']), htmlspecialchars($post['description']), $post['recovery_times'], $post['recovery_times_desc'], $post['avg_time_to_do'], $post['durability'], $post['mainKeyword'], $post['status'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش " . $post['fa_title'] . " در بخش خدمات");
                $this->response_success("خدمت ".$post['fa_title']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusServices($post)
    {
        try {
            $this->doQuery("UPDATE tbl_services SET s_status=(case when s_status=1 then 0 else 1 end) WHERE s_id=?", array($post['id']));

            $_where = "WHERE s.s_id=?";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

            if ($result['s_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ".$result['s_title']." در بخش خدمات");
                $this->response_success("خدمت ".$result['s_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ".$result['s_title']." در بخش خدمات");
                $this->response_success("سوال ".$result['s_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delServices($post)
    {
        try {
            $_where = "WHERE s.s_id=?";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

            if (sizeof($result) > 0) {
                $tags = $this->doSelect("SELECT * FROM tbl_services_tag WHERE service_id=?", array($post['id']));

                foreach ($tags as $tag) {
                    $this->doQuery("UPDATE tbl_tags SET count=count-1 WHERE t_id=?", array($tag['tag_id']));
                }

                unlink("public/images/services/" . $result['0']['s_cover']);

                $this->doQuery("DELETE FROM tbl_services WHERE s_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_tariff WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_timing WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_timing_manage_day WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_tag WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_related_blog WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_ratings WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_service WHERE service_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_comments WHERE p_id=? AND cm_type=?", array($post['id'], "service"));
                $this->doQuery("DELETE FROM tbl_like WHERE item_id=? AND l_type=?", array($post['id'], "service"));
                $this->doQuery("DELETE FROM tbl_view WHERE item_id=? AND type=?", array($post['id'], "service"));

                $this->ActivityLog("حذف " . $result['0']['s_title'] . " از بخش خدمات");
                $this->response_success("خدمت ".$result['0']['s_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("خدمت مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function sendServices($post)
    {
        try {
            $_where = "WHERE s.s_id=? AND s.s_status=1";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

            if(sizeof($result)>0) {
                $link = URL . 'services/' . $result[0]['s_slug'];
                $caption = "🔹 " . $result[0]['s_title'] . "\n\n" . "🔸 " . htmlspecialchars($result[0]['seo_desc']) . "\n\n" . "👇👇" . "\n" . "🌐 " . $link;

                $json = $this->telegram_send_photo(URL . "public/images/services/" . $result[0]['s_cover'], $caption, $this->getPublicInfo('channel_blog'));
                $json = json_decode($json, TRUE);

                if($json['ok']){
                    $this->ActivityLog("ارسال اطلاعات خدمت " . $result[0]['s_title'] . " در کانال تلگرام");
                    $this->response_success("خدمت ".$result[0]['s_title']." باموفقیت در تلگرام ارسال شد");
                } else {
                    $this->response_error($json['description']);
                }
            } else {
                $this->response_error("خدمت مورد نظر یافت نشد یا غیرفعال می باشد و امکان ارسال وجود ندارد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getServicesTiming($attrId)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_timing WHERE service_id=?", array($attrId));
            return $result;
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getServicesTimingManageDay($attrId)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? ORDER BY sm_id DESC", array($attrId));

            $days = array();
            foreach ($result as $row) {
                $days[$row['sm_title_day']][] = $row;
            }
            return $days;
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function timingServicesSetting($post)
    {
        try {
            $timing_enable = 0;
            if($post['auto_timing_enable'] == "on"){
                $timing_enable = 1;
            }
            $sql3 = "UPDATE tbl_services_timing SET st_complete_time_reservation=?,st_date_reservation=?,st_date_reservation_for_admin=?,st_allowed_time_book_repair_appointment=?,st_auto_timing_enabled=? WHERE service_id=?";
            $params = [$post['complete_time_reservation'], $post['timing_date_reservation'], $post['timing_date_reservation_for_admin'], $post['allowed_time_book_repair_appointment'], $timing_enable, $post['service_id']];
            $this->doQuery($sql3, $params);

            $_where = "WHERE s.s_id=?";
            $_input = array($post['service_id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

            $this->ActivityLog("ویرایش تنظیمات خدمت ".$result['s_title']);
            $this->response_success("تنظیمات باموفقیت ذخیره شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function timingServicesManageDay($post)
    {
        try {
            $sql = "UPDATE tbl_services_timing SET st_turn_".$post['day']."=? WHERE service_id=?";
            $params = array($post[$post['day'].'_program'], $post['service_id']);
            $this->doQuery($sql, $params);

            if ($post['day'] == "custom_date") {
                $params = array($post['day'], $post['service_id'], $post['description']);
                $this->doQuery("DELETE FROM tbl_services_timing_manage_day WHERE sm_title_day=? and service_id=? and sm_description=?", $params);
            } else {
                $this->doQuery("DELETE FROM tbl_services_timing_manage_day WHERE sm_title_day=? and service_id=?", array($post['day'], $post['service_id']));
            }
            if (sizeof($post['timing'][$post['day']]) > 0) {
                foreach ($post['timing'][$post['day']] as $timing) {
                    if($timing['hour-start']!="" AND $timing['hour-finish']!="") {
                        if ($timing['capacity'] != "") {
                            $status = 0;
                            if ($timing['status'] == "on") {
                                $status = 1;
                            }
                            $vip = 0;
                            if ($timing['vip'] == "on") {
                                $vip = 1;
                            }
                            if ($post['day'] == "custom_date") {
                                $description = $post['description'];
                            } else {
                                $description = $timing['description'];
                            }
                            $items = array($post['service_id'], $post['day'], $timing['hour-start'], $timing['hour-finish'], $timing['capacity'], $description, $vip, $status);
                            $this->doQuery("INSERT INTO tbl_services_timing_manage_day (service_id, sm_title_day, sm_time_start, sm_time_end, sm_capacity, sm_description, sm_vip, sm_status) VALUES (?,?,?,?,?,?,?,?)", $items);
                        }
                    }
                }
            }

            $_where = "WHERE s.s_id=?";
            $_input = array($post['service_id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

            $this->ActivityLog("ویرایش زمانبندی خدمت ".$result['s_title']);
            $this->response_success("زمانبندی باموفقیت ذخیره شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getServicesTariffAjax($get)
    {
        $columns = array(
            array('db' => 'st_id', 'dt' => 0),
            array('db' => 'operator_id', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT name FROM tbl_services_staff WHERE staff_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);
                    return $result['name'];
                }),
            array('db' => 'branch_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT b_name FROM tbl_branches WHERE branch_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);
                    return $result['b_name'];
                }),
            array('db' => 'st_is_vip', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d == "1") {
                        return "ویژه";
                    } else {
                        return "عادی";
                    }
                }),
            array('db' => 'st_price', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return number_format($d)." تومان";
                }
            ),
            array('db' => 'st_deposit', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return number_format($d)." تومان";
                }
            ),
            array('db' => 'st_status', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['st_id'] . '" data-id="' . $row['st_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['st_id'] . '" data-id="' . $row['st_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'st_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش تعرفه" data-target="#edit-Modal" id="btn-edit-' . $row['st_id'] . '" data-id="' . $row['st_id'] . '" data-vip="' . $row['st_is_vip'] . '" data-staff="' . $row['operator_id'] . '" data-price="' . $row['st_price'] . '" data-deposit="' . $row['st_deposit'] . '"  data-branch="' . $row['branch_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف تعرفه" data-target="#del-Modal" id="btn-del-style-' . $row['st_id'] . '" data-id="' . $row['st_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE service_id=".$get['id'];
        }else{
            $where.=" AND service_id=".$get['id'];
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_services_tariff $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(st_id) FROM tbl_services_tariff $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(st_id) FROM tbl_services_tariff WHERE service_id=".$get['id']);
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusServicesTariff($post)
    {
        try {
            $this->doQuery("UPDATE tbl_services_tariff SET st_status=(case when st_status=1 then 0 else 1 end) WHERE st_id=?", array($post['id']));

            $_where = "WHERE s.s_id=?";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $service = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

            $result = $this->doSelect("SELECT st_status FROM tbl_services_tariff WHERE st_id=?", array($post['id']), 1);
            if ($result['st_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت تعرفه های خدمت ".$service['s_title']);
                $this->response_success("تعرفه ".$result['s_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت تعرفه های خدمت ".$service['s_title']);
                $this->response_success("تعرفه ".$result['s_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addServicesTariff($post)
    {
        try {
            $sql = "SELECT * FROM tbl_services_tariff WHERE branch_id=? and operator_id=? and st_is_vip=? and service_id=?";
            $result = $this->doSelect($sql, array($post['branches'], $post['staffs'], $post['is_vip'], $post['id']));

            if (sizeof($result) > 0) {
                $this->response_warning("تعرفه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_services_tariff (branch_id,operator_id,service_id,st_is_vip,st_price,st_deposit,st_status) VALUES (?,?,?,?,?,?,?)";
                $params = array($post['branches'], $post['staffs'], $post['id'], $post['is_vip'], $post['amount'], $post['deposit'], 1);
                $this->doQuery($sql2, $params);

                $_where = "WHERE s.s_id=?";
                $_input = array($post['id']);
                $_order = "";
                $_limit = "";
                $_join = "";
                $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);
                $this->ActivityLog("افزودن تعرفه در لیست تعرفه های خدمت ".$result['s_title']);
                $this->response_success("تعرفه ".$result['s_title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editServicesTariff($post)
    {
        try {
            $sql = "SELECT * FROM tbl_services_tariff WHERE branch_id=? and operator_id=? and service_id=? and st_is_vip=? and st_id!=?";
            $param = array($post['branchesEdit'], $post['staffsEdit'], $post['attrId'], $post['is_vipEdit'], $post['id']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("تعرفه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql3 = "UPDATE tbl_services_tariff SET branch_id=?, operator_id=?, st_is_vip=?, st_price=?, st_deposit=? WHERE st_id=?";
                $params = array($post['branchesEdit'], $post['staffsEdit'], $post['is_vipEdit'], $post['amountEdit'], $post['depositEdit'], $post['id']);
                $this->doQuery($sql3, $params);

                $_where = "WHERE s.s_id=?";
                $_input = array($post['attrId']);
                $_order = "";
                $_limit = "";
                $_join = "";
                $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);
                $this->ActivityLog("ویرایش اطلاعات تعرفه ی خدمت ".$result['s_title']);
                $this->response_success("اطلاعات تعرفه ".$result['s_title']." باموفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delServicesTariff($post)
    {
        try {
            $_where = "WHERE s.s_id=?";
            $_input = array($post['id']);
            $_order = "";
            $_limit = "";
            $_join = "";
            $result = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join);
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_services_tariff WHERE st_id=?", array($post['id']));

                $this->ActivityLog("حذف تعرفه از تعرفه های خدمت ".$result['0']['s_title']);
                $this->response_success("تعرفه مورد نظر باموفقیت از تعرفه های خدمت ".$result['0']['s_title']." حذف شد");
            } else {
                $this->response_error("تعرفه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetReservation($id)
    {
        $result = $this->doSelect("SELECT order_service_vids_id FROM tbl_services_reservation WHERE order_service_vids_id= ?", array($id));
        return $result;
    }

    function delReservation($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_reservation WHERE order_service_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_services_reservation WHERE order_service_vids_id =?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_log WHERE reservation_id =?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_payment_log WHERE order_vids_id =? AND part=1", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_product WHERE reservation_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_reservation_staff WHERE order_service_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف نوبت " . $post['id'] . " از بخش نوبت های ثبت شده");
                $this->response_success("نوبت م" . $post['id'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("نوبت مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getReservationsListAjax($get)
    {
        $columns = array(
            array('db' => 'sre_id', 'dt' => 0),
            array(
                'db' => 'order_service_vids_id', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array(
                'db' => 'c_display_name', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array(
                'db' => 'b_name', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array(
                'db' => 's_title', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array(
                'db' => 'sre_date', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $row['sre_day']." ".$row['sre_date']." ساعت ".$row['sre_time'];
                }
            ),
            array(
                'db' => 'sre_vip', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $row['sre_vip']=="1" ? "ویژه":"عادی";
                }
            ),
            array('db' => 'title', 'dt' => 7),
            array(
                'db' => 'order_service_vids_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $btn = '<a style="margin: 1px;" title="مشاهده و ویرایش سفارش" class="btn btn-success btn-xs" href="' . ADMIN_PATH . '/reservations/details/' . $d . '"><i class="fa fa-eye"></i></a>';
                    $btn .= '<a style="margin: 1px;" title="مشاهده اطلاعات کاربر" class="btn btn-primary btn-xs" href="'.ADMIN_PATH.'/users/view/' . $row['user_id'] . '"><i class="fa fa-user"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $d . '" data-id="' . $d . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array("title"));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE sre.sre_status!=0";
        }else{
            $where.=" AND sre.sre_status!=0";
        }

        if($get['date']!="" and strlen($get['date'])==10){
            $where.= " AND sre_date='".str_replace("-", "/", $get['date']."'");
        }


        $data = $this->sql_exec($bindings,
            "SELECT sre.*,u.c_display_name,u.customer_vids_id,b.b_name,s.s_title,r.title
                FROM tbl_services_reservation sre
                LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                LEFT JOIN tbl_status r ON sre.sre_status=r.id $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(order_service_vids_id) FROM tbl_services_reservation sre
                LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                LEFT JOIN tbl_status r ON sre.sre_status=r.id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(order_service_vids_id) FROM tbl_services_reservation sre
                LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                LEFT JOIN tbl_status r ON sre.sre_status=r.id WHERE sre.sre_status!=0"
        );
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function reservationInfo($id = '')
    {
        $sql = "SELECT sre.*,u.*,r.title as statusTitle,s.s_title,b.b_name,ss.name,p.pay_title,a.a_name
                    FROM tbl_services_reservation sre
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    LEFT JOIN tbl_admin a ON sre.reason_create=a.a_id
                    LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                    LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                    LEFT JOIN tbl_payment_methods p ON sre.payment_method_id=p.pay_id
                    LEFT JOIN tbl_services_staff ss ON sre.staff_id=ss.staff_vids_id
                    LEFT JOIN tbl_status r ON sre.sre_status=r.id
                    WHERE sre.order_service_vids_id=?";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function editReservationDetails($post)
    {
        try {
            if ($post['descAccounting'] == "") {
                $descAccounting = NULL;
            } else {
                $descAccounting = $post['descAccounting'];
            }

            if ($post['done_date'] == "") {
                $done_date = "-";
            } else {
                $done_date = $post['done_date'];
            }

            if ($post['statusOrder'] == 4) {
                $sql3 = "UPDATE tbl_services_reservation SET sre_done_date=?, sre_accounting_description=?, sre_status=?, sre_pay=?  WHERE order_service_vids_id=?";
                $params = [$done_date, $descAccounting, $post['statusOrder'], 1, $post['id']];
            } else {
                $sql3 = "UPDATE tbl_services_reservation SET sre_done_date=?, sre_accounting_description=?, sre_status=? WHERE order_service_vids_id=?";
                $params = [$done_date, $descAccounting, $post['statusOrder'], $post['id']];
            }
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش اطلاعات نوبت " . $post['id'] . " در بخش نوبت های رزرو شده");
            $this->response_success("اطلاعات نوبت ".$post['id']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function sendReservationsSMS($post, $admin)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_status WHERE id=?", array($post['status']), 1);
            if ($result['code'] != "") {
                $sqlMobile = "SELECT sre.sre_day,sre.sre_date,sre.sre_time,sre.sre_vip,sre.sre_price_payment,
                                                     sre.order_service_vids_id,u.c_mobile_num,u.c_display_name,s.s_title,
                                                     u.c_name,u.c_family
                                       FROM tbl_services_reservation sre
                                       LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                                       LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                                       WHERE sre.order_service_vids_id=?";
                $resultMobile = $this->doSelect($sqlMobile, array($post['id']), 1);
                $vip = '';
                if ($resultMobile['sre_vip'] == 1) {
                    $vip = " ویژه";
                }
                $serviceText = $resultMobile['s_title'] . $vip;
                $dateText = $resultMobile['sre_day'] . " " . $resultMobile['sre_date'] . " ساعت " . $resultMobile['sre_time'];
                $priceText = number_format($resultMobile['sre_price_payment']);
                $business_name = $this->getPublicInfo('site_short_name');
                $text_sms = str_replace(
                    ["[SERVICE]", "[DATE]", "[PRICE]", "[RCODE]", "[BNAME]", "[CFNAME]", "[CLNAME]"],
                    [$serviceText, $dateText, $priceText, $resultMobile['order_service_vids_id'], $business_name, $resultMobile['c_name'], $resultMobile['c_family']],
                    $result['text']
                );

                $input_data = array();
                if ($this->getPublicInfo('sms_site') == "faraz") {
                    if (strpos($result['text'], '[SERVICE]') !== false) {
                        $input_data['SERVICE'] = $serviceText;
                    }
                    if (strpos($result['text'], '[DATE]') !== false) {
                        $input_data['DATE'] = $dateText;
                    }
                    if (strpos($result['text'], '[PRICE]') !== false) {
                        $input_data['PRICE'] = $priceText;
                    }
                    if (strpos($result['text'], '[RCODE]') !== false) {
                        $input_data['RCODE'] = $resultMobile['order_service_vids_id'];
                    }
                    if (strpos($result['text'], '[BNAME]') !== false) {
                        $input_data['BNAME'] = $business_name;
                    }
                    if (strpos($result['text'], '[CFNAME]') !== false) {
                        $input_data['CFNAME'] = $resultMobile['c_name'];
                    }
                    if (strpos($result['text'], '[CLNAME]') !== false) {
                        $input_data['CLNAME'] = $resultMobile['c_family'];
                    }
                } else {
                    $i = 0;
                    if ($this->getPublicInfo('sms_secret_key') != "") {
                        $key_name = "Parameter";
                        $value_name = "ParameterValue";
                    } else {
                        $key_name = "name";
                        $value_name = "value";
                    }

                    if (strpos($result['text'], '[SERVICE]') !== false) {
                        $input_data[$i][$key_name] = "SERVICE";
                        $input_data[$i][$value_name] = $serviceText;
                        $i++;
                    }
                    if (strpos($result['text'], '[DATE]') !== false) {
                        $input_data[$i][$key_name] = "DATE";
                        $input_data[$i][$value_name] = $dateText;
                        $i++;
                    }
                    if (strpos($result['text'], '[PRICE]') !== false) {
                        $input_data[$i][$key_name] = "PRICE";
                        $input_data[$i][$value_name] = $priceText;
                        $i++;
                    }
                    if (strpos($result['text'], '[RCODE]') !== false) {
                        $input_data[$i][$key_name] = "RCODE";
                        $input_data[$i][$value_name] = $resultMobile['order_service_vids_id'];
                        $i++;
                    }
                    if (strpos($result['text'], '[BNAME]') !== false) {
                        $input_data[$i][$key_name] = "BNAME";
                        $input_data[$i][$value_name] = $business_name;
                        $i++;
                    }
                    if (strpos($result['text'], '[CFNAME]') !== false) {
                        $input_data[$i][$key_name] = "CFNAME";
                        $input_data[$i][$value_name] = $resultMobile['c_name'];
                        $i++;
                    }
                    if (strpos($result['text'], '[CLNAME]') !== false) {
                        $input_data[$i][$key_name] = "CLNAME";
                        $input_data[$i][$value_name] = $resultMobile['c_family'];
                    }
                }

                $SendMessage = $this->sendSMS($this->convert_numbers($result['code']), $resultMobile['c_mobile_num'], $input_data);

                $sql2 = "INSERT INTO tbl_services_reservation_log (admin_id,reservation_id,activity_type,activity) VALUES (?,?,?,?)";
                $params = array($admin, $post['id'], "send_sms_reservation", $text_sms);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("ارسال پیامک " . $result['0']['title'] . " برای درخواست " . $post['id'] . " در بخش نوبت های رزرو شده");
                $this->response_success($SendMessage);
            } else {
                $this->response_error("شناسه قالب پیامک را وارد نکرده اید!");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getUserReservations($userId) {
        $_input = array($userId);
        $_order = "ORDER BY order_service_vids_id DESC";
        $_limit = "";

        $_where = " sre.sre_status in (4,5) AND sre.user_id=?";
        $result['success'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        $_where = " sre.sre_status=6 AND sre.user_id=?";
        $result['cancel'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        $_where = " sre.sre_status!=0 AND sre.user_id=?";
        $result['all'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        return $result;
    }

    function getFirstFreeBooking()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $result = array();
        $days= array('saturday','sunday', 'monday','tuesday','wednesday','thursday','friday');

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($data['guid']), 1);

        $today = self::jalali_date();
        $max_reservation_date = self::jalali_after($today, $turn_status['st_date_reservation_for_admin']);
        $periods = $this->create_date_range_array(
            Model::jalali_to_miladi($today, "/", "_"),
            Model::jalali_to_miladi($max_reservation_date, "/", "_")
        );

        $first_date = "";
        foreach ($periods as $period) {
            $date_fa = explode("/", $period['fa']);

            $time = jmktime(0, 0, 0, $date_fa[1], $date_fa[2], $date_fa[0]);
            $dateInfo = jgetdate($time);

            $rows_select = 'st_turn_' . $days[$dateInfo['wday']];
            if ($turn_status[$rows_select] != "not_turn") {
                if ($turn_status[$rows_select] == "custom") {
                    $title_day = $days[$dateInfo['wday']];
                } else {
                    $title_day = $turn_status[$rows_select];
                }

                $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_title_day=? ORDER BY sm_time_start ASC";
                $turns = $this->doSelect($sql, array($data['guid'], $title_day));

                if (sizeof($turns) > 0) {
                    foreach ($turns as $turn) {
                        if ($turn_status[$rows_select] == "custom_date") {
                            $check_date_for_timing = $turn['sm_description'];
                        } else {
                            $check_date_for_timing = $period['fa'];
                        }
                        $check_time = str_replace("/", "", $check_date_for_timing) . str_replace(":", "", $turn['sm_time_start']);

                        if ($check_time >= self::jalali_date("YmdHi")) {
                            if (str_replace("/", "", $max_reservation_date) > str_replace("/", "", $check_date_for_timing)) {
                                //در حالت تاریخ دلخواه چک می شود که تاریخ انتخابی با تاریخ روز یکی باشد
                                if ($turn_status[$rows_select] == "custom_date" and $check_date_for_timing != $period['fa']) {
                                    continue;
                                }

                                // خالی بودن زمان چک می شود
                                $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                                $reservationCount = $this->doSelect($sql, array($data['guid'], $check_date_for_timing, $turn['sm_time_start']));
                                if ($turn['sm_capacity'] >= ($reservationCount[0]['count'] + 1)) {
                                    $first_date = str_replace("/", "-", $period['fa']);
                                    break 2;
                                }
                            }
                        }
                    }
                }
            }
        }

        $result['d'] = $first_date;

        echo json_encode($result, true);
    }

    function initDaysBooking()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $result = array();
        $dayInfo = array();
        $days= array('saturday','sunday', 'monday','tuesday','wednesday','thursday','friday');
        $day_count = 31;
        if($data['m']>6 && $data['m']<12 ){
            $day_count = 30;
        } else if($data['m']==12) {
            if($this->sLeapYear($data['y'])) {
                $day_count = 30;
            } else {
                $day_count = 29;
            }
        }

        //حذف زمان های منقضی شده
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($data['guid']), 1);

        $isFirstVisit = false;
        $counter = 1;

        for($i=1;$i<=$day_count;$i++) {
            $today = self::jalali_date();
            $max_reservation_date = self::jalali_after($today, $turn_status['st_date_reservation_for_admin']);
            $date = $data['y'] . "/" . str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT);

            $time = jmktime(0, 0, 0, $data['m'], $i, $data['y']);
            $dateInfo = jgetdate($time, "", '', 'en');

            $dayInfo['dayCaption'] = str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT) . " " . $dateInfo['weekday'];
            $dayInfo['shortDate'] = Model::jalali_to_miladi($date, "/", "_");
            $dayInfo['today'] = $date == $today;
            $dayInfo['date'] = $date;
            $dayInfo['isNotInMonth'] = $data['m'] == self::jalali_date("m");

            $sql = "SELECT * FROM tbl_holidays WHERE h_date=? AND h_status=1";
            $res = $this->doSelect($sql, array(str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT)));
            $isHoliday = false;
            if ($dateInfo['weekday'] == "جمعه" or sizeof($res) > 0) {
                $isHoliday = true;
            }
            $dayInfo['isHoliday'] = $isHoliday;

            $rows_select = 'st_turn_' . $days[$dateInfo['wday']];

            $hasSetTimes = false;
            if ($turn_status[$rows_select] == "not_turn" || ($turn_status[$rows_select] == "holiday" && $turn_status['st_turn_holiday'] == "not_turn")) {
                $hasSetTimes = false;
            } else if (str_replace("/", "", $date) >= self::jalali_date("Ymd")) {
                if($turn_status[$rows_select]=="custom"){
                    $title_day = $days[$dateInfo['wday']];
                } else  {
                    $title_day = $turn_status[$rows_select];
                }

                $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_title_day=? ORDER BY sm_time_start ASC";
                $turns = $this->doSelect($sql, array($data['guid'], $title_day));
                $turnsInfo_item = array();
                $turnsInfo = array();

                if (sizeof($turns) > 0) {
                    $hasSetTimes = true;
                    foreach ($turns as $turn) {
                        if ($turn_status[$rows_select] == "custom_date") {
                            $check_date_for_timing = $turn['sm_description'];
                        } else {
                            $check_date_for_timing = $date;
                        }
                        $check_time = str_replace("/", "", $check_date_for_timing) . str_replace(":", "", $turn['sm_time_start']);

                        if ($check_time >= self::jalali_date("YmdHi")) {
                            if (str_replace("/","",$max_reservation_date) > str_replace("/","",$check_date_for_timing)) {
                                //در حالت تاریخ دلخواه چک می شود که تاریخ انتخابی با تاریخ روز یکی باشد
                                if($turn_status[$rows_select] == "custom_date" and $check_date_for_timing != $date) {
                                    continue;
                                }

                                // خالی بودن زمان چک می شود
                                $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                                $reservationCount = $this->doSelect($sql, array($data['guid'], $check_date_for_timing, $turn['sm_time_start']));
                                if ($turn['sm_capacity'] >= ($reservationCount[0]['count'] + 1)) {
                                    if ($counter == 1) {
                                        if (!$isFirstVisit) {
                                            $isFirstVisit = true;
                                            $counter++;
                                        }
                                    }
                                    $turnsInfo_item['caption'] = $turn['sm_time_start'];
                                    $turnsInfo_item['isVip'] = $turn['sm_vip'] == 1;
                                    $turnsInfo_item['onclick'] = "setDayBooking('".str_replace("/", "_", $check_date_for_timing) . "', '"  . str_replace(":", "_", $turn['sm_time_start']) . "', '" . ($turn['sm_vip'] == 1 ? "1":"0") . "')";
                                    $turnsInfo[] = $turnsInfo_item;
                                }
                            }
                        }
                    }
                }
            }

            $dayInfo['isFirstVisit'] = $isFirstVisit;
            if ($isFirstVisit) {
                $isFirstVisit = false;
            }

            $dayInfo['hasSetTimes'] = $hasSetTimes;
            $dayInfo['setTimeItems'] = $turnsInfo;

            $result[] = $dayInfo;
        }

        echo json_encode($result, true);
    }

    function newBooking($post, $adminId)
    {
        try {
            $userId = $this->getUserId($post['CustomerNumber'], $post['CustomerPhone'], $post['CustomerName'], $post['CustomerFamily']);

            //چک وجود خدمت
            $checkServices = $this->getIssetServices($post['service']);
            if (sizeof($checkServices) > 0) {
                //چک وجود زمان و تاریخ انتخابی
                $checkServiceTiming = $this->checkServiceTiming($post['service'], str_replace("/", "_", $post['dateSelected']), str_replace(":", "_", $post['timeSelected']), $userId);
                if ($checkServiceTiming['status']) {
                    //چک فعال بودن پرسنل انتخابی
                    $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND branch_id=? AND operator_id=? AND st_is_vip=? AND st_status=1";
                    $checkServicesTariff = $this->doSelect($sql, array($post['service'], $post['branch'], $post['staff'], $post['is_vip']));
                    if (sizeof($checkServicesTariff) > 0) {
                        $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND st_id=?";
                        $tariffInfo = $this->doSelect($sql, array($post['service'], $checkServicesTariff[0]['st_id']), 1);
                        $is_need_to_prepayment = 0;
                        if ($tariffInfo['st_deposit'] > 0) {
                            $is_need_to_prepayment = 1;
                        }

                        $userInfo = $this->getinfoUser($userId);
                        $beforepay = '-';
                        $order_service_vids = $this->getLastId("order_service");
                        $order_tracking = $userInfo['customer_vids_id'] . $order_service_vids;

                        $sql = "INSERT INTO tbl_services_reservation (order_service_vids_id,user_id,branch_id,staff_id,service_id,sre_price_prepayment,sre_price_total,beforepay,sre_date,sre_time,sre_day,sre_vip,sre_is_need_to_prepayment,sre_timestamp_expire,sre_date_create,sre_time_create, reason_create, sre_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $value = array($order_tracking, $userId, $post['branch'], $post['staff'], $post['service'], $tariffInfo['st_deposit'], $tariffInfo['st_price'], $beforepay, $post['dateSelected'], $post['timeSelected'], $checkServiceTiming['day'], $checkServiceTiming['is_vip'], $is_need_to_prepayment, time(), self::jalali_date(), self::jalali_date("H:i:s"), $adminId, $post['status']);
                        $this->doQuery($sql, $value);

                        $this->updateLastId("order_service");

                        if ($post['status'] == 4) {
                            $sql = "UPDATE tbl_services_reservation SET sre_pay=? WHERE order_service_vids_id=?";
                            $this->doQuery($sql, array(1, $order_tracking));
                        }

                        $deposit = str_replace(",","",$post['deposit']);
                        if ($deposit!="" AND  $post['afterpay']!="") {
                            $vids_pay = $this->getLastId("payment");
                            $sql2 = "INSERT INTO tbl_payment_log (payment_vids_id,order_vids_id,price,afterpay,time_payment,date_payment,date_created,`type`,pay_to,status,part) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                            $params = [$vids_pay, $order_tracking, $deposit, $post['afterpay'], time(), $this->jalali_date("Y/m/d"), $this->jalali_date("Y/m/d"), $post['order_type'], $post['order_typePay'], 1, 1];
                            $this->doQuery($sql2, $params);
                            $this->updateLastId("payment");
                        }

                        $link = ADMIN_PATH ."/reservations/details/".$order_tracking;
                        $this->response_success("نوبت باموفقیت ثبت گردید. شماره پیگیری : " . $order_tracking, "ok", $link, $order_tracking);
                    } else {
                        $this->response_error( "پرسنل انتخابی یافت نشد پرسنل دیگری انتخاب نمایید.");
                    }
                } else {
                    $this->response_error( "تاریخ و زمان انتخابی صحیح نمی باشد لذا زمان دیگری انتخاب نمایید.");
                }
            } else {
                $this->response_error( "خدمت مورد نظر یافت نشد.");
            }

            $this->ActivityLog("ثبت نوبت به شماره " . $order_tracking);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editBooking($post, $adminId)
    {
        try {
            $userId = $this->getUserId($post['CustomerNumber'], $post['CustomerPhone'], $post['CustomerName'], $post['CustomerFamily']);

            if($post['service']!=$post['service_old'] OR $post['dateSelected']!=$post['dateSelected_old'] OR $post['timeSelected']!=$post['timeSelected_old']) {
                //چک وجود خدمت
                $checkServices = $this->getIssetServices($post['service']);
                if (sizeof($checkServices) > 0) {
                    //چک وجود زمان و تاریخ انتخابی
                    $checkServiceTiming = $this->checkServiceTiming($post['service'], str_replace("/", "_", $post['dateSelected']), str_replace(":", "_", $post['timeSelected']), $userId);
                    if ($checkServiceTiming['status']) {
                        //چک فعال بودن پرسنل انتخابی
                        $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND branch_id=? AND operator_id=? AND st_is_vip=? AND st_status=1";
                        $checkServicesTariff = $this->doSelect($sql, array($post['service'], $post['branch'], $post['staff'], $post['is_vip']));
                        if (sizeof($checkServicesTariff) > 0) {
                            $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND st_id=?";
                            $tariffInfo = $this->doSelect($sql, array($post['service'], $checkServicesTariff[0]['st_id']), 1);
                            $is_need_to_prepayment = 0;
                            if ($tariffInfo['st_deposit'] > 0) {
                                $is_need_to_prepayment = 1;
                            }

                            $sql = "UPDATE tbl_services_reservation SET user_id=?, branch_id=?, staff_id=?, service_id=?, sre_price_prepayment=?, sre_price_total=?, sre_date=?, sre_time=?, sre_day=?, sre_vip=?, sre_is_need_to_prepayment=? WHERE order_service_vids_id=?";
                            $value = array($userId, $post['branch'], $post['staff'], $post['service'], $tariffInfo['st_deposit'], $tariffInfo['st_price'], $post['dateSelected'], $post['timeSelected'], $checkServiceTiming['day'], $checkServiceTiming['is_vip'], $is_need_to_prepayment, $post['id']);
                            $this->doQuery($sql, $value);

                            $this->response_success("نوبت با موفقیت ویرایش گردید");
                        } else {
                            $this->response_error("پرسنل انتخابی یافت نشد پرسنل دیگری انتخاب نمایید");
                        }
                    } else {
                        $this->response_error("تاریخ و زمان انتخابی صحیح نمی باشد لذا زمان دیگری انتخاب نمایید", "notExist");
                    }
                } else {
                    $this->response_error("خدمت مورد نظر یافت نشد", "notfound");
                }
            } else {
                $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND branch_id=? AND operator_id=? AND st_is_vip=? AND st_status=1";
                $checkServicesTariff = $this->doSelect($sql, array($post['service'], $post['branch'], $post['staff'], $post['is_vip']));
                if (sizeof($checkServicesTariff) > 0) {
                    $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND st_id=?";
                    $tariffInfo = $this->doSelect($sql, array($post['service'], $checkServicesTariff[0]['st_id']), 1);
                    $is_need_to_prepayment = 0;
                    if ($tariffInfo['st_deposit'] > 0) {
                        $is_need_to_prepayment = 1;
                    }

                    $sql = "UPDATE tbl_services_reservation SET user_id=?, branch_id=?, staff_id=?, sre_price_prepayment=?, sre_price_total=?, sre_is_need_to_prepayment=? WHERE order_service_vids_id=?";
                    $value = array($userId, $post['branch'], $post['staff'], $tariffInfo['st_deposit'], $tariffInfo['st_price'], $is_need_to_prepayment, $post['id']);
                    $this->doQuery($sql, $value);

                    $this->response_success("نوبت با موفقیت ویرایش گردید");
                } else {
                    $this->response_error("پرسنل انتخابی یافت نشد پرسنل دیگری انتخاب نمایید");
                }

                $this->response_success("نوبت با موفقیت ویرایش گردید");
            }

            $this->ActivityLog("ویرایش اطلاعات نوبت " . $post['id']);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getProductsList($attrId = '')
    {
        $sql = "SELECT srp.*,sp.sr_name,s.s_name FROM tbl_services_reservation_product srp
                LEFT JOIN tbl_storeroom_product sp
                ON srp.product_id=sp.product_vids_id
                LEFT JOIN tbl_storeroom s
                ON srp.storeroom_id=s.storeroom_vids_id
                WHERE srp.reservation_id=?";
        $result = $this->doSelect($sql, array($attrId));

        return $result;
    }

    function getReservations($from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $sql = "SELECT sre_date_create FROM tbl_services_reservation WHERE sre_status not in (0,6) AND sre_date_create >= '".str_replace("-","/",$this->check_param($from))."' AND sre_date_create <= '".str_replace("-","/",$this->check_param($to))."' ORDER BY sre_date_create ASC";
            $result = $this->doSelect($sql);
        } else {
            $sql = "SELECT sre_date_create FROM tbl_services_reservation WHERE sre_status not in (0,6) AND sre_date_create LIKE '%" . $this->jalali_date("Y/m") . "/%' ORDER BY sre_date_create ASC";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function getProducts()
    {
        $sql = "SELECT sp.*,COALESCE(spi.spi_count, 0) count,COALESCE(spi.spi_total_inventory, 0) total_inventory, CONCAT(sr_name, ' - ', COALESCE(spi.spi_count, 0), ' عدد') as name FROM tbl_storeroom_product sp
                    LEFT JOIN tbl_storeroom_product_inventory spi ON sp.product_vids_id=spi.product_id AND spi.spi_status=1
                    LEFT JOIN tbl_storeroom s ON sp.storeroom_id=s.storeroom_vids_id";
        $result = $this->doSelect($sql);

        return $result;
    }

}
