<?php

trait viewsTrait
{
    function theme()
    {
        $admin_permission = $this->model->admin_permission_check("theme_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/views/theme');
        } else {
            $this->noaccess();
        }
    }

    function menu($func = '', $attrId = 0)
    {
        if ($func != '' && ($func == "header" || $func == "footer" || $func == "sidebar")) {
            $admin_permission = $this->model->admin_permission_check("menu_".$func."_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getMenuFullList = $this->model->getMenuFullList($func);
                $pageInfo = $this->model->getPageInfo();
                $category = $this->model->getCategory();

                $_where = "WHERE s.s_status=1";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $getRelatedBlog = $this->model->getRelatedBlog();
                $data = array('attrId' => $func, 'menuFullList' => $getMenuFullList, 'pageInfo' => $pageInfo, 'category' => $category, 'blog' => $getRelatedBlog, 'services' => $serviceInfo);
                $this->view('admin/views/menu', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $this->index();
        }
    }

    function saveMenuList()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("menu_".$_POST['type']."_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->saveMenuList($_POST['type'], $_POST['list']);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function widgetOrder()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->widgetOrder($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function widgetStatus()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->widgetStatus($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCustomWidget()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCustomWidget($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCustomWidget()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCustomWidget($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addWidget()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addWidget($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editWidget()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editWidget($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function widgetDel()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->widgetDel($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editDashboardWidget()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editDashboardWidget($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getPageWidgetAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getPageWidgetAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function banners($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "images") {
            $admin_permission = $this->model->admin_permission_check("banner_image_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetBanners($attrId);
                if (sizeof($id_isset) > 0) {
                    $getBanners = $this->model->getBanners($attrId);

                    $data = array('bannerInfo' => $getBanners, 'attrId' => $attrId);
                    $this->view('admin/views/banners-images', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("banner_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/views/banners');
            } else {
                $this->noaccess();
            }
        }
    }

    function getBannersAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getBannersAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusBanners()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusBanners($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addBanners()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addBanners($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editBanners()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editBanners($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delBanners()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delBanners($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getBannersImagesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_image_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getBannersImagesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusBannersImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_image_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusBannersImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addBannersImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_image_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addBannersImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editBannersImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_image_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editBannersImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delBannersImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("banner_image_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delBannersImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function slider($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "images") {
            $admin_permission = $this->model->admin_permission_check("slider_image_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetSlider($attrId);
                if (sizeof($id_isset) > 0) {
                    $getSlider = $this->model->getSlider($attrId);

                    $data = array('sliderInfo' => $getSlider, 'attrId' => $attrId);
                    $this->view('admin/views/slider-images', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("slider_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/views/slider');
            } else {
                $this->noaccess();
            }
        }
    }

    function getSliderAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getSliderAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusSlider()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusSlider($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addSlider()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addSlider($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editSlider()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editSlider($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delSlider()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delSlider($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getSliderImagesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_image_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getSliderImagesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusSliderImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_image_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusSliderImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addSliderImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_image_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addSliderImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editSliderImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_image_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editSliderImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delSliderImages()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("slider_image_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delSliderImages($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function icons($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("icon_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/views/icons');
        } else {
            $this->noaccess();
        }
    }

    function getIconsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("icon_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getIconsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusIcons()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("icon_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusIcons($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addIcons()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("icon_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addIcons($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editIcons()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("icon_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editIcons($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delIcons()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("icon_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delIcons($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function searches($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("search_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/views/searches');
        } else {
            $this->noaccess();
        }
    }

    function getSearchesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("search_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getSearchesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addSearches()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("search_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addSearches($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delSearches()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("search_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delSearches($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusSuggestSearches()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("search_status_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusSuggestSearches($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusManagementSearches()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("search_status_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusManagementSearches($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function pages($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "new") {
            $admin_permission = $this->model->admin_permission_check("page_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/views/page-add');
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "widget-add") {
            $admin_permission = $this->model->admin_permission_check("page_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getTemplates = $this->model->getTemplates('main');
                $getCategoryChildBlog = $this->model->getCategoryChild("blog");
                $getBanners = $this->model->getBanners();
                $getSlider = $this->model->getSlider();

                $data = array(
                    'attrId' => $attrId,
                    'categoryChildBlog' => $getCategoryChildBlog,
                    'slider' => $getSlider,
                    'templates' => $getTemplates,
                    'banners' => $getBanners
                );
                $this->view('admin/views/page-widget-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "widget-edit") {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetWidget($attrId);
                if (sizeof($id_isset) > 0) {
                    $widgetInfo = $this->model->getWidgetInfo($attrId);
                    $getTemplates = $this->model->getTemplates('main');
                    $getCategoryChildBlog = $this->model->getCategoryChild("blog");
                    $getBanners = $this->model->getBanners();
                    $getSlider = $this->model->getSlider();

                    $data = array(
                        'attrId' => $attrId,
                        'categoryChildBlog' => $getCategoryChildBlog,
                        'widgetInfo' => $widgetInfo,
                        'slider' => $getSlider,
                        'templates' => $getTemplates,
                        'banners' => $getBanners
                    );
                    $this->view('admin/views/page-widget-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetPage($attrId);
                if (sizeof($id_isset) > 0) {
                    $pageInfo = $this->model->getPageInfo($attrId);

                    if ($pageInfo['type'] == "main_page") {
                        $data = array('pageInfo' => $pageInfo, 'attrId' => $attrId);
                        $this->view('admin/views/page-widget', $data);
                    } else if ($pageInfo['type'] == "dashboard") {
                        $getTemplates = $this->model->_make_widgets($attrId);
                        $make_widgets = $this->model->_make_editable_rows($attrId);

                        $data = array(
                            'templates' => $getTemplates,
                            'widgets' => $make_widgets,
                            'pageInfo' => $pageInfo,
                            'attrId' => $attrId
                        );
                        $this->view('admin/views/dashboard-edit', $data);
                    } else {
                        $data = array('pageInfo' => $pageInfo, 'attrId' => $attrId);
                        $this->view('admin/views/page-edit', $data);
                    }
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("page_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/views/page');
            } else {
                $this->noaccess();
            }
        }
    }

    function resetMainDashboard()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->resetMainDashboard($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getPageAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getPageAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addPage()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addPage($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editPage()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editPage($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delPage()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delPage($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function checkSlug()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->checkSlug($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addLink()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addLink($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusLink()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusLink($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editLink()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editLink($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delLink()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delLink($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function filemanager()
    {
        $admin_permission = $this->model->admin_permission_check("file_manager_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/views/filemanager');
        } else {
            $this->noaccess();
        }
    }

    function redirect($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("redirect_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/views/redirect');
        } else {
            $this->noaccess();
        }
    }

    function getRedirectLinkAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getRedirectLinkAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addRedirect()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addRedirect($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editRedirect()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editRedirect($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delRedirect()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("redirect_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delRedirect($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
