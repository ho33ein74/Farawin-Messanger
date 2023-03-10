<?php

trait usersModelTrait
{
    function admin_permission_check($pos, $adminId)
    {
        try {
            $adminInfo = $this->doSelect("SELECT admin_role_id FROM tbl_admin WHERE a_id=?", array($adminId), 1);
            if ($adminInfo['admin_role_id'] == 1) {
                return true;
            } else {
                $sql = "SELECT path FROM tbl_admin_role_access WHERE path=? AND role_id=?";
                $result = $this->doSelect($sql, array($pos, $adminInfo['admin_role_id']));

                if (sizeof($result) > 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (Exception $e) {
            return false;
        }
    }

    function getAdminsActivityAjax($get)
    {
        try {
            $columns = array(
                array('db' => 'idusr_activity', 'dt' => 0),
                array('db' => 'a_name', 'dt' => 1),
                array('db' => 'activity', 'dt' => 2),
                array('db' => 'ip', 'dt' => 3,
                    'formatter' => function ($d, $row) {
                        return $d != "" ? $d : "-";
                    }
                ),
                array('db' => 'platform', 'dt' => 4,
                    'formatter' => function ($d, $row) {
                        return $d != "" ? $d : "-";
                    }
                ),
                array('db' => 'browser', 'dt' => 5,
                    'formatter' => function ($d, $row) {
                        return $d != "" ? $d : "-";
                    }
                ),
                array(
                    'db' => 'log_time', 'dt' => 6,
                    'formatter' => function ($d, $row) {
                        $date = explode(" ", $d);
                        $newData = $date['1'] . " - " . $this->MiladiTojalili($date['0'], "-");

                        return $newData;
                    }
                )
            );

            $bindings = array();
            $where = $this->filter($get, $columns, $bindings, array("admin_id"));
            $order = $this->order($get, $columns);
            $limit = $this->limit($get, $columns);


            $data = $this->sql_exec($bindings,
                "SELECT `" . implode("`, `", $this->pluck($columns, 'db')) . "` FROM tbl_admin_activity a
                    LEFT JOIN tbl_admin u
                    ON a.admin_id=u.a_id $where $order $limit"
            );

            // Data set length after filtering
            $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(idusr_activity) FROM tbl_admin_activity a
                    LEFT JOIN tbl_admin u
                    ON a.admin_id=u.a_id $where"
            );
            $recordsFiltered = $resFilterLength[0][0];

            // Total data set length
            $resTotalLength = $this->sql_exec("SELECT COUNT(idusr_activity) FROM tbl_admin_activity a
                    LEFT JOIN tbl_admin u
                    ON a.admin_id=u.a_id"
            );
            $recordsTotal = $resTotalLength[0][0];

            $dataSelect = array(
                "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $this->data_output($columns, $data)
            );

            echo json_encode($dataSelect);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function ActivityLog($activity, $id='')
    {
        try {
            $this->cookieInit();
            if ($id != '') {
                $adminId = $id;
            } else {
                $adminId = $this->Decrypt($this->cookieGet('adminId'), KEY);
            }
            $ip = $this->getClientIP();
            $detect = $this->detectBrowser();

            $sql2 = "INSERT INTO tbl_admin_activity (admin_id, ip, platform, browser, activity) VALUES (?,?,?,?,?)";
            $params = array($adminId, $ip, $detect['platform'], $detect['name'], $activity);
            $this->doQuery($sql2, $params);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function latestActivity($id)
    {
        try {
            $sql = "SELECT * FROM tbl_admin_activity WHERE admin_id = ? ORDER BY idusr_activity DESC LIMIT 8";
            return $this->doSelect($sql, array($id));
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

//    admin method
    function getAdminsAjax($get)
    {
        try {
            $columns = array(
                array('db' => 'a_id', 'dt' => 0),
                array('db' => 'a_name', 'dt' => 1),
                array('db' => 'a_username', 'dt' => 2),
                array('db' => 'admin_role_id', 'dt' => 3,
                    'formatter' => function ($d, $row) {
                        if ($d != 0) {
                            $result = $this->doSelect("SELECT ar_title FROM tbl_admin_role WHERE ar_id=?", array($d), 1);
                            return $result['ar_title'];
                        } else {
                            return "-";
                        }
                    }
                ),
                array('db' => 'a_status', 'dt' => 4,
                    'formatter' => function ($d, $row) {
                        if ($d == 1) {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['a_id'] . '" data-id="' . $row['a_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                        } else {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['a_id'] . '" data-id="' . $row['a_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                        }
                    }
                ),
                array('db' => 'id', 'dt' => 5,
                    'formatter' => function ($d, $row) {
                        $btn = '';
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش کاربر" data-target="#edit-Modal" id="btn-edit-' . $row['a_id'] . '" data-id="' . $row['a_id'] . '" data-description="' . $row['a_desc'] . '" data-name="' . $row['a_name'] . '" data-username="' . $row['a_username'] . '" data-role="' . $row['admin_role_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کاربر" data-target="#del-Modal" id="btn-del-style-' . $row['a_id'] . '" data-id="' . $row['a_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    }
                )
            );

            $bindings = array();
            $where = $this->filter($get, $columns, $bindings, array(""));
            $order = $this->order($get, $columns);
            $limit = $this->limit($get, $columns);

            $data = $this->sql_exec($bindings, "SELECT * FROM tbl_admin $where $order $limit");

            // Data set length after filtering
            $resFilterLength = $this->sql_exec($bindings, "SELECT count(a_id) FROM tbl_admin $where");
            $recordsFiltered = $resFilterLength[0][0];

            // Total data set length
            $resTotalLength = $this->sql_exec("SELECT count(a_id) FROM tbl_admin");
            $recordsTotal = $resTotalLength[0][0];

            $dataSelect = array(
                "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $this->data_output($columns, $data)
            );

            echo json_encode($dataSelect);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getInfoAdmin($id)
    {
        try {
            $sql = "SELECT a.*,ar.ar_title FROM tbl_admin a
                        LEFT JOIN tbl_admin_role ar ON a.admin_role_id=ar.ar_id
                        WHERE a.a_id=? AND a.a_status=1";
            $result =  $this->doSelect($sql, array($id));

            if(sizeof($result)>0) {
                $result['access'] = $this->get_role_allow_access($result[0]['admin_role_id']);
            }
            return $result;
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetAdmin($id)
    {
        try {
            return $this->doSelect("SELECT a_id FROM tbl_admin WHERE a_id= ?", array($id));
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editAdmin($post)
    {
        try {
            $sql3 = "UPDATE tbl_admin SET a_name=?,a_username=?,admin_role_id=?,a_desc=? WHERE a_id=?";
            $params = [$post['name'], $post['username'], $post['role'], $post['description'], $post['id']];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش اطلاعات " . $post['name'] . " در بخش کارکنان");
            $this->response_success("اطلاعات " . $post['name'] . " با موفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editAvatar($post, $adminId)
    {
        try {
            if (isset($_FILES["image"]["name"])) {
                $dir = "public/images/profile/";
                $nameImg = $dir . time() . "_" . rand(1, 9999) . "_" . $_FILES['image']['name'];

                $res = $this->doSelect("SELECT a_image FROM tbl_admin WHERE a_id=?", array($adminId), 1);
                if (strpos($res['a_image'], 'gravatar.com') === false) {
                    unlink($res['a_image']);
                }

                move_uploaded_file($_FILES["image"]["tmp_name"], $nameImg);
                $this->doQuery("UPDATE tbl_admin SET a_image=? WHERE a_id=?", array($nameImg, $adminId));

                $this->ActivityLog("ویرایش تصویر آواتار");
            }

            $this->response_success("تصویر آواتار باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addAdmin($post)
    {
        try {
            $sql = "SELECT * FROM tbl_admin WHERE a_username=?";
            $param = array($post['username']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("این کاربر قبلا ثبت شده است", "exist");
            } else {
                $pga = new PHPGangsta_GoogleAuthenticator();
                $secret = $pga->createSecret();
                $password = password_hash($post['pass'], PASSWORD_DEFAULT);
                $url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($post['username']))) . "?d=identicon&s=50&r=x";

                $sql2 = "INSERT INTO tbl_admin (a_name, a_username, a_password, admin_role_id, a_image, a_desc, google_secret_code, registery_date, a_status) VALUES (?,?,?,?,?,?,?,?,?)";
                $params = [$post['name'], $post['username'], $password, $post['role'], $url, $post['description'], $secret, $this->jaliliDate(), 1];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش کارکنان");
                $this->response_success("کاربر ".$post['name']." باموفقیت فعال شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delAdmin($post)
    {
        try {
            $result = $this->doSelect("SELECT a_name FROM tbl_admin WHERE a_id=?", array($post['id']));
            if(sizeof($result)>0) {
                $this->ActivityLog("حذف " . $result['0']['a_name'] . " از لیست ادمین ها");

                $this->doQuery("DELETE FROM tbl_admin WHERE a_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_admin_role_access WHERE role_id=?", array($post['id']));
                $this->response_success("کاربر مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("کاربر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusAdmins($post)
    {
        try {
            $this->doQuery("UPDATE tbl_admin SET a_status=(case when a_status=1 then 0 else 1 end) WHERE a_id=?", array($post['id']));
            $result = $this->doSelect("SELECT a_status, a_name FROM tbl_admin WHERE a_id=?", array($post['id']), 1);

            if ($result['a_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت کاربر ".$result['a_name']);
                $this->response_success("کاربر ".$result['a_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت کاربر ".$result['a_name']);
                $this->response_success("کاربر ".$result['a_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

//    roles method
    function getRolesAjax($get)
    {
        try {
            $columns = array(
                array('db' => 'ar_id', 'dt' => 0),
                array('db' => 'ar_title', 'dt' => 1),
                array('db' => 'ar_status', 'dt' => 2,
                    'formatter' => function ($d, $row) {
                        if ($d == 1) {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ar_id'] . '" data-id="' . $row['ar_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                        } else {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ar_id'] . '" data-id="' . $row['ar_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                        }
                    }
                ),
                array('db' => 'ar_id', 'dt' => 3,
                    'formatter' => function ($d, $row) {
                        $btn = '';
                        if ($row['ar_removable'] == 1) {
                            $btn .= '<a style="margin: 1px;" class="btn btn-warning btn-xs" title="ویرایش نقش" href="' . ADMIN_PATH . '/admins/rolesEdit/' . $row['ar_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                            $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف نقش" data-target="#del-Modal" id="btn-del-style-' . $row['ar_id'] . '" data-id="' . $row['ar_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                        } else {
                            $btn .= '-';
                        }
                        return $btn;
                    }
                )
            );

            $bindings = array();
            $where = $this->filter($get, $columns, $bindings, array(""));
            $order = $this->order($get, $columns);
            $limit = $this->limit($get, $columns);

            $data = $this->sql_exec($bindings, "SELECT * FROM tbl_admin_role $where $order $limit");

            // Data set length after filtering
            $resFilterLength = $this->sql_exec($bindings, "SELECT count(ar_id) FROM tbl_admin_role $where");
            $recordsFiltered = $resFilterLength[0][0];

            // Total data set length
            $resTotalLength = $this->sql_exec("SELECT count(ar_id) FROM tbl_admin_role");
            $recordsTotal = $resTotalLength[0][0];

            $dataSelect = array(
                "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $this->data_output($columns, $data)
            );

            echo json_encode($dataSelect);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getRoles()
    {
        try {
            return $this->doSelect("SELECT * FROM tbl_admin_role WHERE ar_status = 1 ORDER BY ar_title DESC");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetRole($id)
    {
        try {
            return $this->doSelect("SELECT ar_id FROM tbl_admin_role WHERE ar_id= ?", array($id));
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getRolesInfoEdit($id)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_admin_role WHERE ar_id=?", array($id));
            $result['access'] = $this->get_role_allow_access($id);

            return $result;
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editRoles($post)
    {
        try {
            $sql = "UPDATE tbl_admin_role SET ar_title=?,ar_status=? WHERE ar_id=?";
            $params = array($post['title'], $post['status'], $post['id']);
            $this->doQuery($sql, $params);

            $this->doQuery("DELETE FROM tbl_admin_role_access WHERE role_id=?", array($post['id']));
            $access_list = explode(",", $post['access']);
            if (sizeof($access_list) > 0) {
                foreach ($access_list as $access) {
                    if ($access != "") {
                        $sql = "INSERT INTO tbl_admin_role_access (role_id,path) VALUES (?,?)";
                        $params = array($post['id'], $access);
                        $this->doQuery($sql, $params);
                    }
                }
            }

            $this->ActivityLog("ویرایش اطلاعات " . $post['title'] . " در بخش ادمین ها");
            $this->response_success("اطلاعات و دسترسی های نقش ". $post['title']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addRoles($post)
    {
        try {
            $sql = "SELECT * FROM tbl_admin_role WHERE ar_title=?";
            $param = array($post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("این نقش قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_admin_role(ar_title, ar_removable, ar_create_date, ar_status) VALUES (?,?,?,?)";
                $params = array($post['title'], 1, $this->jaliliDate(), 1);
                $this->doQuery($sql2, $params);

                $role = Model::$conn->lastInsertId();
                $access_list = explode(",", $post['access']);
                if (sizeof($access_list) > 0) {
                    foreach ($access_list as $access) {
                        if ($access != "") {
                            $sql = "INSERT INTO tbl_admin_role_access (role_id,path) VALUES (?,?)";
                            $params = array($role, $access);
                            $this->doQuery($sql, $params);
                        }
                    }
                }

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش نقش ها");
                $this->response_success("نقش مورد نظر باموفقیت فعال شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delRoles($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_admin_role WHERE ar_id=?", array($post['id']), 1);

            if(sizeof($result)>0) {
                $this->doQuery("UPDATE tbl_admin SET admin_role_id=0, a_status=0 WHERE admin_role_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_admin_role WHERE ar_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_admin_role_access WHERE role_id=?", array($post['id']));

                $this->ActivityLog("حذف نقش " . $result['ar_title']);
                $this->response_success("نقش ".$result['ar_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("نقش مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusRoles($post)
    {
        try {
            $this->doQuery("UPDATE tbl_admin_role SET ar_status=(case when ar_status=1 then 0 else 1 end) WHERE ar_id=?", array($post['id']));
            $result = $this->doSelect("SELECT ar_status, ar_title FROM tbl_admin_role WHERE ar_id=?", array($post['id']), 1);

            if ($result['ar_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت نقش ".$result['ar_title']);
                $this->response_success("نقش ".$result['ar_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت نقش ".$result['ar_title']);
                $this->response_success("نقش ".$result['ar_title']."باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

//    users method
    function getUsersAjax($get)
    {
        $columns = array(
            array('db' => 'customer_vids_id', 'dt' => 0),
            array('db' => 'c_name', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $d=="" ? "-":$row['c_name']." ".$row['c_family'];
                }
            ),
            array('db' => 'c_display_name', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $row['c_display_name'];
                }
            ),
            array('db' => 'c_mobile_num', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d == NULL ? '-' : $d;
                }
            ),
            array('db' => 'c_registery_date', 'dt' => 4),
            array('db' => 'customer_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '<a style="margin: 1px;" title="مشاهده اطلاعات کاربر" class="btn btn-success btn-xs" href="'.ADMIN_PATH.'/users/view/' . $d . '"><i class="fa fa-eye"></i></a>';
                    $btn .= '<a style="margin: 1px;" class="btn btn-warning btn-xs" href="'.ADMIN_PATH.'/users/edit/' . $d . '"><i class="fa fa-pencil-square-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $d . '" data-id="' . $d . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings);
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_customer $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(customer_vids_id) FROM tbl_customer $where"
        );
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(customer_vids_id) FROM tbl_customer");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addUser($post)
    {
        try {
            $sql = "SELECT * FROM tbl_customer WHERE c_mobile_num=?";
            $param = array($post['mobile']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("شخص دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/user/";
                $vids = $this->getLastId("customer");
                $coverImg = NULL;

                $birth_date = explode("/", $post['birthday']);

                $birthday = array(
                    "year" => $birth_date[0] ?? "",
                    "month" => $birth_date[1] ?? "",
                    "day" => $birth_date[2] ?? ""
                );

                $sql = "INSERT INTO tbl_customer (customer_vids_id,c_cart_no,c_birthday,c_email,c_mobile_num,c_phone_num,c_name,c_family,c_display_name,c_registery_date,province_id,city_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $value = array($vids, ($post['no_card'] ?? "-"), json_encode($birthday), $post['email'], $post['mobile'], $post['phone'], $post['name'], $post['family'], $post['name'] . " " . $post['family'], $this->jaliliDate(), $post['provinceId'], $post['cityId']);
                $this->doQuery($sql, $value);

                $coverImg = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($post['mobile']))) . "?d=identicon&s=50&r=x";
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = $dirCover . time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $coverImg);
                }
                $this->doQuery("UPDATE tbl_customer SET c_image=? WHERE customer_vids_id=?", array($coverImg, $vids));

                $this->ActivityLog("افزودن " . $post['name'] . " " . $post['family'] . " در لیست مشتریان");
                $this->updateLastId("customer");
                $this->response_success("اطلاعات شخص ".$post['name'] . " " . $post['family']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editUser($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_customer WHERE customer_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("شخص مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/user/";
                $birth_date = explode("/", $post['birthday']);

                $birthday = array(
                    "year" => $birth_date[0] ?? "",
                    "month" => $birth_date[1] ?? "",
                    "day" => $birth_date[2] ?? ""
                );

                $sql = "UPDATE tbl_customer SET c_cart_no=?, c_birthday=?, c_email=?, c_name=?, c_family=?, c_display_name=?, c_mobile_num=?, c_phone_num=?, c_arithmetic=?, province_id=?,city_id=? WHERE customer_vids_id=?";
                $params = [($post['no_card'] ?? "-"), json_encode($birthday), $post['email'], $post['name'], $post['family'], $post['display_name'], $post['mobile'], $post['phone'], $post['arithmetic'], $post['provinceId'], $post['cityId'], $post['id']];
                $this->doQuery($sql, $params);

                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = $dirCover . time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $coverImg);
                    $this->doQuery("UPDATE tbl_customer SET c_image=? WHERE customer_vids_id=?", array($coverImg, $post['id']));
                }

                $this->ActivityLog("ویرایش اطلاعات " . $post['name'] . " " . $post['family']);
                $this->response_success("اطلاعات ".$post['name'] . " " . $post['family']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delUser($post)
    {
        try {
            $result = $this->doSelect("SELECT c_name FROM tbl_customer WHERE customer_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_customer WHERE customer_vids_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_discounts_user_used WHERE user_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['c_name'] . " از لیست مشتریان");
                $this->response_success("اطلاعات شخص ".$result['0']['c_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("مطلب مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetCustomer($id)
    {
        return $this->doSelect("SELECT customer_vids_id FROM tbl_customer WHERE customer_vids_id= ?", array($id));
    }

    function addDocuments($post, $admin)
    {
        try {
            $sql = "SELECT * FROM tbl_customer WHERE customer_vids_id=?";
            $param = array($post['id']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) == 0) {
                $this->response_warning("شخص مورد نظر یافت نشد", "noexist");
            } else {
                $dirCover = "public/images/documents/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = $result[0]['c_id'] . "_" . time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql2 = "INSERT INTO tbl_customer_document (admin_id,user_id,cd_title,cd_document,cd_create_date,cd_status) VALUES (?,?,?,?,?,?)";
                $params = array($admin, $post['id'], $post['title'], $coverImg, $this->jaliliDate(), 1);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست مدارک ".($result[0]['c_name']!="" ? $result[0]['c_name']." ".$result[0]['c_family']:$result[0]['c_display_name']));
                $this->response_success("مدرک ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getDocuments($id)
    {
        $sql = "SELECT * FROM tbl_customer_document WHERE user_id=? AND cd_status=1 ORDER BY cd_id DESC";
        return $this->doSelect($sql, array($id));
    }

    function delDocuments($post)
    {
        try {
            $dirCover = "public/images/documents/";
            $result = $this->doSelect("SELECT cd.*,c.c_name,c.c_family,c.c_display_name FROM tbl_customer_document cd LEFT JOIN tbl_customer c ON cd.user_id=c.customer_vids_id WHERE cd_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                if ($result['0']['cd_document'] != NULL) {
                    unlink($dirCover . $result['0']['cd_document']);
                }

                $this->doQuery("DELETE FROM tbl_customer_document WHERE cd_id=?", array($post['id']));

                $this->ActivityLog("حذف مدرک " . $result['0']['cd_title'] . " از لیست مدارک " . ($result['0']['c_name'] != "" ? $result['0']['c_name'] . " " . $result['0']['c_family'] : $result['0']['c_display_name']));
                $this->response_success("مدرک ".$result['0']['cd_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("مطلب مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getUserId($mobile, $phone, $name, $family){
        $result_user = $this->doSelect("SELECT * FROM tbl_customer WHERE c_mobile_num=?", array($mobile));

        if (sizeof($result_user) > 0) {
            $sql = "UPDATE tbl_customer SET c_display_name=?,c_name=?,c_family=?,c_phone_num=? WHERE c_mobile_num=?";
            $params = array($name . " " . $family, $name, $family, $phone, $mobile);
            $this->doQuery($sql, $params);

            $userId = $result_user['0']['customer_vids_id'];
        } else {
            $url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($mobile))) . "?d=identicon&s=50&r=x";
            $vids = $this->getLastId("customer");

            $sql = "INSERT INTO tbl_customer (
                          customer_vids_id,
                          c_mobile_num,
                          c_phone_num,
                          c_display_name,
                          c_name,
                          c_family,
                          c_image,
                          c_registery_date,
                          province_id,
                          city_id
                          ) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $value = array($vids, $mobile, $phone, $name . " " . $family, $name, $family, $url, $this->jaliliDate(), 0, 0);
            $this->doQuery($sql, $value);

            $this->updateLastId("customer");
            $userId = $vids;
        }

        return $userId;
    }

    function userGetlatest($count = 0)
    {
        if ($count != 0) {
            $sql = "SELECT * FROM tbl_customer ORDER BY customer_vids_id DESC LIMIT ".$count;
            $result = $this->doSelect($sql);
        } else {
            $sql = "SELECT * FROM tbl_customer ORDER BY customer_vids_id DESC";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

}
