<?php

trait settingTrait
{
//    methods contacting
    function methodsContacting($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("methods_contacting_view_edit", $this->checkLoginAdmin);
        if ($admin_permission) {
            $cashInfo = $this->model->getCashInfo();
            $data = array('cashInfo' => $cashInfo);
            $this->view('admin/setting/methods-contacting', $data);
        } else {
            $this->noaccess();
        }
    }

    function methodsContactingEdit()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("methods_contacting_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->methodsContactingEdit($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function saveMethodsContactingPriority()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("methods_contacting_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->saveMethodsContactingPriority($_POST['list']);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusMethodsContacting()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("methods_contacting_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusMethodsContacting($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editMethodsContacting()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("methods_contacting_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editMethodsContacting($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    settings method
    function businessInformation($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
        if ($admin_permission) {
            $cashInfo = $this->model->getCashInfo();
            $data = array('cashInfo' => $cashInfo);
            $this->view('admin/setting/business-information', $data);
        } else {
            $this->noaccess();
        }
    }

    function settingsEdit()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->settingsEdit($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function businessInformationEdit()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->businessInformationEdit($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editLogo()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editLogo($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editFavIcon()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editFavIcon($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editLogoSquare()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editLogoSquare($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editLogin_admin_background()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editLogin_admin_background($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getPaymentMethodsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getPaymentMethodsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editPaymentMethods()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editPaymentMethods($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusPaymentMethodsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusPaymentMethodsAjax($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function dataDelete()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("business_information_view_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->dataDelete($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    color method
    function color($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("color_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/setting/color');
        } else {
            $this->noaccess();
        }
    }

    function getColorAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("color_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getColorAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addColor()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("color_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addColor($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editColor()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("color_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editColor($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delColor()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("color_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delColor($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    provinces method
    function provinces($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("province_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/setting/provinces');
        } else {
            $this->noaccess();
        }
    }

    function getProvinceAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("province_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getProvinceAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusProvince()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("province_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusProvince($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addProvince()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("province_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addProvince($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editProvince()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("province_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editProvince($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delProvince()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("province_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delProvince($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

//    cities method
    function cities($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("city_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $provinces = $this->model->getProvinces();
            $data = array('provinces' => $provinces);
            $this->view('admin/setting/cities', $data);
        } else {
            $this->noaccess();
        }
    }

    function getCitiesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCitiesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusCities()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusCities($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCities()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCities($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editCities()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editCities($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCities()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCities($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getCityByProvince()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("city_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCityByProvince($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}

?>
