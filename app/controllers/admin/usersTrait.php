<?php

trait usersTrait
{
    function profile()
    {
        $infoAdmin = $this->model->getInfoAdmin($this->checkLoginAdmin);

        $pga = new PHPGangsta_GoogleAuthenticator();
        $qr_code = $pga->getQRCodeGoogleUrl($infoAdmin[0]['a_username'], $infoAdmin[0]['google_secret_code'], str_replace("https://", "", rtrim(URL, "/")));

        $data = array('qr_code' => $qr_code);
        $this->view('admin/users/profile', $data);
    }

    function getAdminsActivityAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_activity_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getAdminsActivityAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    admin method
    function admins($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "roles") {
            $admin_permission = $this->model->admin_permission_check("admin_roles_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $access_list = $this->model->getMenuFullListWithAccess();

                $data = array('access_list' => $access_list);
                $this->view('admin/users/admins-roles', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "rolesEdit") {
            $admin_permission = $this->model->admin_permission_check("admin_roles_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetRole($attrId);
                if (sizeof($id_isset) > 0) {
                    $access_list = $this->model->getMenuFullListWithAccess();
                    $rolesInfo = $this->model->getRolesInfoEdit($attrId);

                    $data = array(
                        'attrId' => $attrId,
                        'access_list' => $access_list,
                        'rolesInfo' => $rolesInfo
                    );
                    $this->view('admin/users/admins-roles-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && $func == "activity") {
            $admin_permission = $this->model->admin_permission_check("admin_activity_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/users/admins-activity');
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("admin_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $roles = $this->model->getRoles();
                $data = array('roles' => $roles);
                $this->view('admin/users/admins', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getAdminsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getAdminsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editAvatar()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->editAvatar($_POST, $this->checkLoginAdmin);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editAdmin()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editAdmin($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addAdmin()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addAdmin($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delAdmin()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delAdmin($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusAdmins()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusAdmins($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    roles method
    function getRolesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_roles_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getRolesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editRoles()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_roles_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editRoles($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addRoles()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_roles_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addRoles($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delRoles()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_roles_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delRoles($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusRoles()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("admin_roles_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusRoles($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    users method
    function users($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("users_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetCustomer($attrId);
                if (sizeof($id_isset) > 0) {
                    $getUserInfo = $this->model->getinfoUser($attrId);
                    $provinces = $this->model->getProvinces();
                    $city = $this->model->getCity($getUserInfo['province_id']);
                    $data = array('city' => $city, 'provinces' => $provinces, 'getUserInfo' => $getUserInfo, 'attrId' => $attrId);
                    $this->view('admin/users/users-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "view") {
            $admin_permission = $this->model->admin_permission_check("users_info_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetCustomer($attrId);
                if (sizeof($id_isset) > 0) {
                    $getUserInfo = $this->model->getinfoUser($attrId);
                    $getDocuments = $this->model->getDocuments($attrId);
                    $getUserReservations = $this->model->getUserReservations($attrId);
                    $data = array('getUserInfo' => $getUserInfo, 'attrId' => $attrId, 'documents' => $getDocuments,
                        'userReservations' => $getUserReservations);
                    $this->view('admin/users/users-view', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("users_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $provinces = $this->model->getProvinces();
                $data = array('provinces' => $provinces);
                $this->view('admin/users/users', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getUsersAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getUsersAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addDocuments()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addDocuments($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delDocuments()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delDocuments($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addUser()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addUser($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editUser()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editUser($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delUser()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("users_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delUser($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
