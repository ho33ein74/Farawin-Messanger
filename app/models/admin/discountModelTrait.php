<?php
trait discountModelTrait
{
    function getGiftCartAjax($get)
    {
        $columns = array(
            array('db' => 'g_id', 'dt' => 0),
            array('db' => 'g_title', 'dt' => 1),
            array('db' => 'g_code', 'dt' => 2),
            array('db' => 'g_amount', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($d);
                }
            ),
            array('db' => 'g_expire_date', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if($d != NULL){
                        return $d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'user_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if($d != NULL){
                        $result = $this->doSelect("SELECT c_name FROM tbl_customer WHERE customer_vids_id=?", array($d), 1);
                        return $result['c_name'];
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'g_used_date', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if($d != NULL){
                        return $d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'g_status', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<div class="btn btn-success btn-xs">فعال</div>';
                    } else if($d==2){
                        return '<div class="btn btn-info btn-xs">استفاده شده</div>';
                    } else {
                        return '<div class="btn btn-danger btn-xs">غیرفعال</div>';
                    }
                }
            ),
            array('db' => 'g_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش کارت هدیه" data-target="#edit-Modal" id="btn-edit-' . $row['g_id'] . '" data-id="' . $row['g_id'] . '" data-name="' . $row['g_title'] . '" data-status="' . $row['g_status'] . '" data-amount="' . $row['g_amount'] . '" data-code="' . $row['g_code'] . '" data-expireDate="' . $row['g_expire_date'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کارت هدیه" data-target="#del-Modal" id="btn-del-style-' . $row['g_id'] . '" data-id="' . $row['g_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_giftcart $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(g_id) FROM tbl_giftcart $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(g_id) FROM tbl_giftcart");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addGiftCart($post)
    {
        try {
            $sql = "SELECT * FROM tbl_giftcart WHERE g_title=? and g_code=?";
            $param = array($post['title'], $post['code']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("کارت هدیه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_giftcart (g_title,g_code,g_create_date,g_expire_date,g_amount) VALUES (?,?,?,?,?)";
                $params = [$post['title'], $post['code'], $this->jalali_date(), $post['dateExpire'], $post['amount']];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست کارت های هدیه");
                $this->response_success("کارت هدیه ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editGiftCart($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_giftcart WHERE g_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("کارت هدیه مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_giftcart SET g_title=?, g_code=?, g_expire_date=?, g_amount=?, g_status=? WHERE g_id=?";
                $params = array($post['titleEdit'], $post['codeEdit'], $post['expireDateEdit'], $post['amountEdit'], $post['statusEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات کارت هدیه " . $post['titleEdit']);
                $this->response_success("اطلاعات کارت هدیه ".$post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delGiftCart($post)
    {
        try {
            $result = $this->doSelect("SELECT g_title FROM tbl_giftcart WHERE g_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_giftcart WHERE g_id=?", array($post['id']));

                $this->ActivityLog("حذف کارت هدیه " . $result['0']['g_title']);
                $this->response_success("کارت هدیه ".$result['0']['g_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("کارت هدیه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getDiscountsAjax($get)
    {
        $columns = array(
            array('db' => 'dc_id', 'dt' => 0),
            array('db' => 'dc_title', 'dt' => 1),
            array('db' => 'dc_code', 'dt' => 2),
            array('db' => 'dc_percent', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d." درصد";
                }
            ),
            array('db' => 'dc_price', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return number_format($d)." تومان";
                }
            ),
            array('db' => 'dc_number_of_use', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if($d != NULL){
                        $result = $this->doSelect("SELECT COUNT(du_id) as count FROM tbl_discounts_user_used WHERE dc_id=?", array($row['dc_id']), 1);
                        return $result['count']." / ".$d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'dc_expire_date', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if($d != NULL){
                        return $d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'dc_status', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<div class="btn btn-success btn-xs">فعال</div>';
                    } else if($d==2){
                        return '<div class="btn btn-info btn-xs">استفاده شده</i></div>';
                    } else {
                        return '<div class="btn btn-danger btn-xs">غیرفعال</div>';
                    }
                }
            ),
            array('db' => 'dc_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $services = $this->doSelect("SELECT service_id FROM tbl_discounts_service WHERE dc_id=?", array($row['dc_id']));
                    $servicesId='';
                    foreach ($services as $service){
                        $servicesId .= $service['service_id'].",";
                    }

                    $staffs = $this->doSelect("SELECT staff_id FROM tbl_discounts_staff WHERE dc_id=?", array($row['dc_id']));
                    $staffsId='';
                    foreach ($staffs as $staff){
                        $staffsId .= $staff['staff_id'].",";
                    }
                    $btn='';
                    $btn .= '<a style="margin: 1px;" title="مشاهده لیست کاربران" class="btn btn-primary btn-xs" href="'.ADMIN_PATH.'/discounts/users/' . $row['dc_id'] . '"><i class="fa fa-user"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش کد تخفیف" data-target="#edit-Modal" id="btn-edit-' . $row['dc_id'] . '" data-id="' . $row['dc_id'] . '" data-type="' . $row['dc_type'] . '" data-tilte="' . $row['dc_title'] . '" data-status="' . $row['dc_status'] . '" data-code="' . $row['dc_code'] . '" data-first_order="' . $row['dc_first_order'] . '"  data-discounted_products="' . $row['dc_discounted_products'] . '"  data-allowed_for_each_user="' . $row['dc_allowed_for_each_user'] . '"  data-number_of_use="' . $row['dc_number_of_use'] . '" data-expire_date="' . $row['dc_expire_date'] . '" data-price="' . $row['dc_price'] . '" data-description="' . $row['dc_description'] . '" data-percent="' . $row['dc_percent'] . '" data-services="['.rtrim($servicesId, ",").']" data-courses="['.rtrim($coursesId, ",").']" data-staffs="['.rtrim($staffsId, ",").']" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کد تخفیف" data-target="#del-Modal" id="btn-del-style-' . $row['dc_id'] . '" data-id="' . $row['dc_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_discounts $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(dc_id) FROM tbl_discounts $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(dc_id) FROM tbl_discounts");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getIssetDiscounts($id)
    {
        $result = $this->doSelect("SELECT dc_id FROM tbl_discounts WHERE dc_id= ?", array($id));
        return $result;
    }

    function getDiscounts($attrId)
    {
        $result = $this->doSelect("SELECT * FROM tbl_discounts WHERE dc_id=?", array($attrId));
        return $result;
    }

    function addDiscounts($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_discounts WHERE dc_code=?", array($post['code']));

            if (sizeof($result) > 0) {
                $this->response_warning("کدتخفیف دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $first_order = 0;
                if($post['first_order'] == "true"){
                    $first_order = 1;
                }
                $discounted_products = 0;
                if($post['discounted_products'] == "true"){
                    $discounted_products = 1;
                }
                $sql2 = "INSERT INTO tbl_discounts (dc_title, dc_type,dc_code, dc_number_of_use, dc_create_date, dc_expire_date, dc_percent, dc_min_price_apply, dc_price, dc_first_order, dc_discounted_products, dc_allowed_for_each_user, dc_description, dc_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $params = array($post['title'], $post['type_code'], $post['code'], $post['number_of_use'], $this->jalali_date(), $post['dateExpire'], $post['percent'], 0, $post['price'], $first_order, $discounted_products, $post['allowed_for_each_user'], $post['description'],  1);
                $this->doQuery($sql2, $params);

                $discountId = Model::$conn->lastInsertId();
                if($discountId!="" and $post['type_code'] == "service") {
                    $for_all_service = 1;
                    if($post['services'] != 'null') {
                        $services = explode(",", $post['services']);
                        if (sizeof($services) > 0) {
                            $for_all_service = 0;
                            foreach ($services as $service) {
                                if ($service != "") {
                                    $this->doQuery("INSERT INTO tbl_discounts_service (dc_id,service_id,dcc_status) VALUES (?,?,?)", array($discountId, $service, 1));
                                }
                            }
                        }
                    }
                    $sql = "UPDATE tbl_discounts SET dc_for_all_course=?, dc_for_all_service=? WHERE dc_id=?";
                    $this->doQuery($sql, array(0, $for_all_service, $discountId));

                    $for_all_staff = 1;
                    if($post['staffs'] != 'null') {
                        $staffs = explode(",", $post['staffs']);
                        if (sizeof($staffs) > 0) {
                            $for_all_staff = 0;
                            foreach ($staffs as $staff) {
                                if ($staff != "") {
                                    $this->doQuery("INSERT INTO tbl_discounts_staff (dc_id,staff_id,ds_status) VALUES (?,?,?)", array($discountId, $staff, 1));
                                }
                            }
                        }
                    }
                    $sql = "UPDATE tbl_discounts SET dc_for_all_staff=? WHERE dc_id=?";
                    $this->doQuery($sql, array($for_all_staff, $discountId));
                }

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست کدهای تخفیف");
                $this->response_success("کد تخفیف ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editDiscounts($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_discounts WHERE dc_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("کدتخفیف مورد نظر یافت نشد");
            } else {
                $first_order = 0;
                if ($post['first_orderEdit'] == "true") {
                    $first_order = 1;
                }
                $discounted_products = 0;
                if ($post['discounted_productsEdit'] == "true") {
                    $discounted_products = 1;
                }

                $sql = "UPDATE tbl_discounts SET dc_first_order=?, dc_discounted_products=?, dc_allowed_for_each_user=?, dc_title=?, dc_code=?, dc_number_of_use=?, dc_expire_date=?, dc_percent=?, dc_min_price_apply=?, dc_price=?, dc_description=?, dc_status=? WHERE dc_id=?";
                $params = array($first_order, $discounted_products, $post['allowed_for_each_userEdit'], $post['titleEdit'], $post['codeEdit'], $post['number_of_useEdit'], $post['expireDateEdit'], $post['percentEdit'], 0, $post['priceEdit'], $post['descriptionEdit'], $post['statusEdit'], $post['id']);
                $this->doQuery($sql, $params);

                if ($post['id'] != "" and $post['type_codeEdit'] == "service") {
                    $this->doQuery("DELETE FROM tbl_discounts_service WHERE dc_id=?", array($post['id']));
                    $for_all_service = 1;
                    if($post['servicesEdit'] != 'null') {
                        $services = explode(",", $post['servicesEdit']);
                        if (sizeof($services) > 0) {
                            $for_all_service = 0;
                            foreach ($services as $service) {
                                if ($service != "") {
                                    $this->doQuery("INSERT INTO tbl_discounts_service (dc_id,service_id,dcc_status) VALUES (?,?,?)", array($post['id'], $service, 1));
                                }
                            }
                        }
                    }
                    $sql = "UPDATE tbl_discounts SET dc_for_all_course=?, dc_for_all_service=? WHERE dc_id=?";
                    $this->doQuery($sql, array(0, $for_all_service, $post['id']));

                    $this->doQuery("DELETE FROM tbl_discounts_staff WHERE dc_id=?", array($post['id']));
                    $for_all_staff = 1;
                    if($post['staffsEdit'] != 'null') {
                        $staffs = explode(",", $post['staffsEdit']);
                        if (sizeof($staffs) > 0) {
                            $for_all_staff = 0;
                            foreach ($staffs as $staff) {
                                if ($staff != "") {
                                    $this->doQuery("INSERT INTO tbl_discounts_staff (dc_id,staff_id,ds_status) VALUES (?,?,?)", array($post['id'], $staff, 1));
                                }
                            }
                        }
                    }
                    $sql = "UPDATE tbl_discounts SET dc_for_all_staff=? WHERE dc_id=?";
                    $this->doQuery($sql, array($for_all_staff, $post['id']));
                }

                $this->ActivityLog("ویرایش اطلاعات کد تخفیف " . $post['titleEdit']);
                $this->response_success("اطلاعات کد تخفیف " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delDiscounts($post)
    {
        try {
            $result = $this->doSelect("SELECT dc_title FROM tbl_discounts WHERE dc_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_discounts WHERE dc_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_service WHERE dc_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_course WHERE dc_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_staff WHERE dc_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_user_used WHERE dc_id=?", array($post['id']));

                $this->ActivityLog("حذف کد تخفیف " . $result['0']['dc_title']);
                $this->response_success("کد تخفیف ".$result['0']['dc_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("کد تخفیف مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getDiscountsUsersAjax($get)
    {
        $columns = array(
            array('db' => 'du_id', 'dt' => 0),
            array('db' => 'c_display_name', 'dt' => 1),
            array('db' => 'du_used_date', 'dt' => 2),
            array('db' => 'du_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<div class="btn btn-success btn-xs">موفق</i></div>';
                    } else {
                        return '<div class="btn btn-danger btn-xs">ناموفق</i></div>';
                    }
                }
            ),
            array('db' => 'du_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<a style="margin: 1px;" title="مشاهده کاربر" class="btn btn-primary btn-xs" href="'.ADMIN_PATH.'/users/view/' . $row['user_id'] . '"><i class="fa fa-user"></i></a>';
                    $btn .= '<a style="margin: 1px;" title="مشاهده سفارش" class="btn btn-success btn-xs" href="'.ADMIN_PATH.'/reservations/details/' . $row['order_id'] . '"><i class="fa fa-shopping-cart "></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کد تخفیف" data-target="#del-Modal" id="btn-del-style-' . $row['du_id'] . '" data-id="' . $row['du_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE u.dc_id=".$get['id'];
        }else{
            $where.=" AND u.dc_id=".$get['id'];
        }

        $data = $this->sql_exec($bindings, "SELECT u.*,c.c_display_name FROM tbl_discounts_user_used u LEFT JOIN tbl_customer c ON u.user_id=c.customer_vids_id $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(u.dc_id) FROM tbl_discounts_user_used u LEFT JOIN tbl_customer c ON u.user_id=c.customer_vids_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(u.dc_id) FROM tbl_discounts_user_used u LEFT JOIN tbl_customer c ON u.user_id=c.customer_vids_id WHERE u.dc_id=".$get['id']);
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function delDiscountsUser($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_discounts_user_used WHERE dc_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $result = $this->doSelect("SELECT u.*,c.c_name,d.dc_title FROM `tbl_discounts_user_used` u LEFT JOIN tbl_customer c ON u.user_id=c.customer_vids_id LEFT JOIN tbl_discounts d ON u.dc_id=d.dc_id WHERE u.dc_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_user_used WHERE du_id=?", array($post['id']));

                $this->ActivityLog("حذف کاربر " . $result['0']['c_name'] . " از لیست کاربران کد تخفیف" . $result['0']['dc_title']);
                $this->response_success("کاربر ".$result['0']['c_name']." باموفقیت از لیست کاربران کد تخفیف ".$result['0']['dc_title']." حذف شد");
            } else {
                $this->response_error("کاربر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}
