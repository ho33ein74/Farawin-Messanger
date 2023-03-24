<?php

trait  blogTrait
{
    function blog($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "new") {
            $admin_permission = $this->model->admin_permission_check("blog_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getTag = $this->model->getTag();
                $category = $this->model->getCategory('blog');
                $getRelatedBlog = $this->model->getRelatedBlog();
                $sources = $this->model->getSources();
                $data = array(
                    'sources' => $sources,
                    'category' => $category,
                    'tag' => $getTag,
                    'RelatedBlog' => $getRelatedBlog
                );
                $this->view('admin/blog/blog-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("blog_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetBlog($attrId);
                if (sizeof($id_isset) > 0) {
                    $blogInfoEdit = $this->model->getBlogInfoEdit($attrId);
                    $getTag = $this->model->getTag();
                    $category = $this->model->getCategory('blog');
                    $getPostTag = $this->model->getPostTag($attrId);
                    $getRelatedBlog = $this->model->getRelatedBlog($attrId);
                    $getRelatedBlogSelected = $this->model->getRelatedBlogSelected($attrId, "blog");
                    $sources = $this->model->getSources();
                    $data = array('blogInfo' => $blogInfoEdit, 'attrId' => $attrId,
                        'relatedBlogSelected' => $getRelatedBlogSelected,
                        'category' => $category, 'tag' => $getTag, 'postTag' => $getPostTag,
                        'relatedBlog' => $getRelatedBlog, 'sources' => $sources);
                    $this->view('admin/blog/blog-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("blog_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $category = $this->model->getCategory('blog');
                $data = array('category' => $category);
                $this->view('admin/blog/blog', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getBlogAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getBlogAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addBlog()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addBlog($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editBlog()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editBlog($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delBlog()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delBlog($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function sendBlog()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_info_telegram_send", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->sendBlog($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusBlog()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusBlog($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function sources($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("blog_source_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/blog/sources');
        } else {
            $this->noaccess();
        }
    }

    function getSourceAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_source_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getSourceAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addSource()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_source_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addSource($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editSource()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_source_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editSource($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusSource()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_source_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusSource($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delSource()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_source_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delSource($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
