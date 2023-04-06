<?php

trait supportModelTrait
{
    function getCommentsAjax($get)
    {
        $columns = array(
            array('db' => 'cm_id', 'dt' => 0),
            array('db' => 'c_display_name', 'dt' => 1),
            array('db' => 'titleItem', 'dt' => 2),
            array('db' => 'cm_text', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $this->summary($d, 100);
                }
            ),
            array('db' => 'cm_date', 'dt' => 4),
            array(
                'db' => 'cm_type', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if ($row['cm_type'] == "blog") {
                        $type = 'وبلاگ';
                    } else if($row['cm_type']=='service') {
                        $type = 'خدمات';
                    }
                    return $type;
                }
            ),
            array(
                'db' => 'cm_status', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        $btn = '<button style="margin: 1px;" class="btn btn-success btn-xs">تایید شده</button>';
                    } else {
                        $btn = '<button style="margin: 1px;" id="btn-status-' . $row['cm_id'] . '-new" class="btn btn-danger btn-xs">جدید</button>';
                    }

                    if($row['selected']==1){
                        $btn .= '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-index-' . $row['cm_id'] . '" data-id="' . $row['cm_id'] . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>';
                    } else {
                        $btn .= '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-index-' . $row['cm_id'] . '" data-id="' . $row['cm_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-eye-slash"></i></button>';
                    }

                    return $btn;
                }
            ),
            array(
                'db' => 'cm_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $btn='';
                    if ($row['cm_status'] == 0) {
                        $btn = '<button style="margin: 1px;" id="btn-cm-submit-' . $row['cm_id'] . '" data-id="' . $row['cm_id'] . '" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>';
                    }

                    if($row['cm_type']=='blog') {
                        $btn .= '<a target="_blank" style="margin: 1px;" title="مشاهده مطلب" class="btn btn-success btn-xs" href="blog/article/' . $row['slug'] . '"><i class="fa fa-eye"></i></a>';
                    } else if($row['cm_type']=='service') {
                        $btn .= '<a target="_blank" style="margin: 1px;" title="مشاهده خدمت" class="btn btn-success btn-xs" href="services/' . $row['s_slug'] . '"><i class="fa fa-eye"></i></a>';
                    }

                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="جزئیات نظر و پاسخ به نظر" data-target="#reply-Modal" id="btn-cm-reply-' . $row['cm_id'] . '" data-id="' . $row['cm_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-commenting-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف نظر" data-target="#del-Modal" id="btn-cm-delete-' . $row['cm_id'] . '" data-id="' . $row['cm_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE c.cm_reply_admin_id is NULL";
        }else{
            $where.=" AND c.cm_reply_admin_id is NULL";
        }

        $data = $this->sql_exec($bindings, "SELECT c.*,u.c_display_name,u.customer_vids_id,n.n_id,n.slug,a.a_name,s.s_slug,
            (CASE WHEN s.s_title is not NULL THEN s.s_title ELSE n.title END) AS titleItem
            FROM tbl_comments c
            LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id 
            LEFT JOIN tbl_admin a ON c.cm_reply_admin_id=a.a_id 
            LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
            LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service' $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(cm_id) FROM tbl_comments c
                LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id 
                LEFT JOIN tbl_admin a ON c.cm_reply_admin_id=a.a_id 
                LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service' $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(cm_id) FROM tbl_comments c
                LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id 
                LEFT JOIN tbl_admin a ON c.cm_reply_admin_id=a.a_id 
                LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service' WHERE c.cm_reply_admin_id is NULL"
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

    function submitComments($post)
    {
        try {
            $sql = "SELECT c.cm_type,u.c_display_name,n.title,s.s_title
                    FROM tbl_comments c
                    LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id
                    LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                    LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service'
                    WHERE c.cm_id=?";
            $result = $this->doSelect($sql, array($post['id']));
            if(sizeof($result)>0) {
                if ($result['0']['cm_type'] == "blog") {
                    $type = "مطلب";
                    $location = "وبلاگ";
                    $title = $result['0']['title'];
                } else if ($result['0']['cm_type'] == "service") {
                    $type = "خدمت";
                    $location = "خدمات";
                    $title = $result['0']['s_title'];
                }

                $this->doQuery("UPDATE tbl_comments SET cm_status=1 WHERE cm_id=?", array($post['id']));

                $this->ActivityLog("تایید نظر " . $result['0']['c_display_name'] . " در " . $type . " " . $title . " در بخش " . $location);
                $this->response_success("نظر " . $result['0']['c_display_name'] . " در " . $type . " " . $title." باموفقیت تایید شد");
            } else {
                $this->response_error("آیتم مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCommentsDetailsAjax($post='')
    {
        try {
            $data = $this->doSelect("SELECT * FROM tbl_comments WHERE cm_id=?", array($post['id']), 1);

            $result = '<div id="commentText" style="margin-top: 20px;text-align: justify">' . $data['cm_text'] . '</div>';
            $result .= '<script>';
            $result .= 'var converter = new showdown.Converter();';
            $result .= 'var text = document.getElementById("commentText").innerHTML;';
            $result .= 'var html = converter.makeHtml(text);';
            $result .= 'document.getElementById("commentText").innerHTML = html;';
            $result .= '</script>';
            $result .= '<style>div#commentText > p > img{width: 100%;}</style>';

            $reply = $this->doSelect("SELECT * FROM tbl_comments WHERE cm_answer_id=?", array($post['id']), 1);
            $result .= '<hr/>';
            $result .= '<div id="form-regular-delete" class="login-fold row" style="display: inline;block">';
            $result .= '<div class="col-md-12">';
            $result .= '<div class="form-group" style="text-align:right">';
            $result .= '<label style="width: 100%" align="right" for="msgReply">پاسخ:</label>';
            $result .= '<textarea' . ($reply['cm_text'] != NULL ? " readonly" : "") . ' style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="msgReply" name="msgReply">' . $reply['cm_text'] . '</textarea>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';

            $this->response_success("", "ok", "", $result);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function commentReply($post, $admin)
    {
        try {
            $sql = "SELECT c.cm_type,u.c_display_name,n.title,s.s_title,c.p_id, a.a_name
                    FROM tbl_comments c
                    LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id
                    LEFT JOIN tbl_admin a ON c.cm_reply_admin_id=a.a_id
                    LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                    LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service'
                    WHERE c.cm_id=?";
            $result = $this->doSelect($sql, array($post['id']));

            $sql = "SELECT * FROM tbl_comments WHERE cm_answer_id= ? AND p_id = ? AND cm_reply_admin_id = ? AND cm_text = ? AND `cm_type` = ?";
            $params = array($post['id'], $result['0']['p_id'], $admin, $post['msgReply'], $result['0']['cm_type']);
            $res = $this->doSelect($sql, $params);

            if (sizeof($res) > 0) {
                $this->response_warning("قبلا به این نظر پاسخ داده شده است", "exist");
            } else {
                $sql = "INSERT INTO tbl_comments (p_id,cm_reply_admin_id,cm_answer_id,cm_text,cm_date,cm_time,cm_type,reply,cm_status) VALUES (?,?,?,?,?,?,?,?,?)";
                $value = array($result['0']['p_id'], $admin, $post['id'], $post['msgReply'], $this->jaliliDate(), $this->jaliliDate("H:i"), $result['0']['cm_type'], 1, 1);
                $this->doQuery($sql, $value);

                if ($result['0']['cm_type'] == "blog") {
                    $type = "مطلب";
                    $location = "وبلاگ";
                    $title = $result['0']['title'];
                } else if ($result['0']['cm_type'] == "service") {
                    $type = "خدمت";
                    $location = "خدمات";
                    $title = $result['0']['s_title'];
                }

                $this->doQuery("UPDATE tbl_comments SET cm_status=1 WHERE cm_id=?", array($post['id']));

                $this->ActivityLog("تایید و پاسخ به نظر " . $result['0']['c_display_name'] . " در " . $type . " " . $title . " در بخش " . $location);
                $this->response_success("پاسخ مورد نظر باموفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusComment($post)
    {
        try {
            $this->doQuery("UPDATE tbl_comments SET selected=(case when selected=1 then 0 else 1 end) WHERE cm_id=?", array($post['id']));

            $sql = "SELECT c.cm_type,u.c_display_name,n.title,s.s_title,c.p_id, a.a_name,c.selected
                    FROM tbl_comments c
                    LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id
                    LEFT JOIN tbl_admin a ON c.cm_reply_admin_id=a.a_id
                    LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                    LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service'
                    WHERE c.cm_id=?";
            $result = $this->doSelect($sql, array($post['id']), 1);

            if ($result['cm_type'] == "blog") {
                $type = "مطلب";
                $location = "وبلاگ";
                $title = $result['title'];
            } else if ($result['cm_type'] == "service") {
                $type = "خدمت";
                $location = "خدمات";
                $title = $result['s_title'];
            }

            if ($result['selected'] == 1) {
                $this->ActivityLog("نمایش نظر " . $result['c_display_name'] . " در " . $type . " " . $title . " در بخش " . $location ." در صفحه اصلی سایت");
                $this->response_success("نظر مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("عدم نمایش نظر " . $result['c_display_name'] . " در " . $type . " " . $title . " در بخش " . $location ." در صفحه اصلی سایت");
                $this->response_success("نظر مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delComments($post)
    {
        try {
            $sql = "SELECT c.cm_type,u.c_display_name,n.title,s.s_title
                    FROM tbl_comments c
                    LEFT JOIN tbl_customer u ON c.cm_user_id=u.customer_vids_id
                    LEFT JOIN tbl_blog n ON c.p_id=n.n_id and cm_type='blog'
                    LEFT JOIN tbl_services s ON c.p_id=s.s_id and cm_type='service'
                    WHERE c.cm_id=?";
            $result = $this->doSelect($sql, array($post['id']));
            if (sizeof($result) > 0) {
                if ($result['0']['cm_type'] == "blog") {
                    $type = "مطلب";
                    $location = "وبلاگ";
                    $title = $result['0']['title'];
                } else if ($result['0']['cm_type'] == "service") {
                    $type = "خدمت";
                    $location = "خدمات";
                    $title = $result['0']['s_title'];
                }

                $this->doQuery("DELETE FROM tbl_comments WHERE cm_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_comments WHERE cm_answer_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_comment_like WHERE comment_id=?", array($post['id']));

                $this->ActivityLog("حذف نظر " . $result['0']['c_display_name'] . " در " . $type . " " . $title . " از بخش " . $location);
                $this->response_success( "نظر " . $result['0']['c_display_name'] . " در " . $type . " " . $title." باموفقیت حذف شد");
            } else {
                $this->response_error("نظر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSupportAjax($get)
    {
        $columns = array(
            array('db' => 'co_id', 'dt' => 0),
            array(
                'db' => 'co_title', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT cs_id as id,cs_title as title FROM tbl_contact_subject where cs_id=?";
                    $result = $this->doSelect($sql, array($d), 1);
                    return $result['title'];
                }
            ),
            array('db' => 'co_user_name', 'dt' => 2),
            array('db' => 'co_user_email', 'dt' => 3),
            array(
                'db' => 'co_user_phone', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d==NULL ? "-":$d;
                }
            ),
            array('db' => 'co_text', 'dt' => 5),
            array(
                'db' => 'co_date', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $this->MiladiTojalili(date("Y/m/d", $d));
                }
            ),
            array(
                'db' => 'co_status', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button id="btn-status-' . $row['co_id'] . '" class="btn btn-success btn-xs">تایید شده</button>';
                    } else {
                        return '<button id="btn-status-' . $row['co_id'] . '" class="btn btn-danger btn-xs">جدید</button>';
                    }
                }
            ),
            array(
                'db' => 'co_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $btn='';
                    if ($row['co_status'] == 0) {
                        $btn = '<button style="margin: 1px;" id="btn-cm-submit-' . $row['co_id'] . '" data-id="' . $row['co_id'] . '" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>';
                    }

                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف نظر" data-target="#del-Modal" id="btn-cm-delete-' . $row['co_id'] . '" data-id="' . $row['co_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_contact $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(co_id) FROM tbl_contact $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(co_id) FROM tbl_contact");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function submitSupport($post)
    {
        try {
            $sql = "SELECT co_user_name FROM tbl_contact WHERE co_id=?";
            $result = $this->doSelect($sql, array($post['id']));

            if (sizeof($result) > 0) {
                $sql = "UPDATE tbl_contact SET co_status=1 WHERE co_id=?";
                $this->doQuery($sql, array($post['id']));

                $this->ActivityLog("پیام " . $result['0']['co_user_name'] . " را در بخش پشتیبانی خواند.");
                $this->response_success("پیام ".$result['0']['co_user_name']." باموفقیت تایید شد");
            } else {
                $this->response_error("پیام مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delSupport($post)
    {
        try {
            $sql = "SELECT co_user_name FROM tbl_contact WHERE co_id=?";
            $result = $this->doSelect($sql, array($post['id']));

            if (sizeof($result) > 0) {
                $sql3 = "DELETE FROM tbl_contact WHERE co_id=?";
                $this->doQuery($sql3, array($post['id']));

                $this->ActivityLog("پیام " . $result['0']['co_user_name'] . " را در بخش پشتیبانی حذف کرد.");
                $this->response_success("پیام ".$result['0']['co_user_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("پیام مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getContactSubjectAjax($get)
    {
        $columns = array(
            array('db' => 'cs_id', 'dt' => 0),
            array('db' => 'cs_title', 'dt' => 1),
            array('db' => 'cs_status', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($row['cs_removable'] == 1) {
                        if ($d == 1) {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['cs_id'] . '" data-id="' . $row['cs_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                        } else {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['cs_id'] . '" data-id="' . $row['cs_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                        }
                    } else {
                        return '<button class="btn btn-success btn-xs">فعال</button>';
                    }
                }
            ),
            array('db' => 'cs_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $btn='';
                    if($row['cs_removable'] == 1) {
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش موضوع" data-target="#edit-Modal" id="btn-edit-' . $row['cs_id'] . '" data-id="' . $row['cs_id'] . '" data-name="' . $row['cs_title'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف موضوع" data-target="#del-Modal" id="btn-del-style-' . $row['cs_id'] . '" data-id="' . $row['cs_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    } else {
                        $btn='-';
                    }
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_contact_subject $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(cs_id) FROM tbl_contact_subject $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(cs_id) FROM tbl_contact_subject");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusContactSubject($post)
    {
        try {
            $this->doQuery("UPDATE tbl_contact_subject SET cs_status=(case when cs_status=1 then 0 else 1 end) WHERE cs_id=?", array($post['id']));
            $result = $this->doSelect("SELECT cs_status, cs_title FROM tbl_contact_subject WHERE cs_id=?", array($post['id']), 1);

            if ($result['cs_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت موضوع پیام ".$result['cs_title']);
                $this->response_success("موضوع ".$result['cs_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت موضوع پیام ".$result['cs_title']);
                $this->response_success("موضوع ".$result['cs_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addContactSubject($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_contact_subject WHERE cs_title=?", array($post['title']));

            if (sizeof($result) > 0) {
                $this->response_warning("موضوع دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql = "INSERT INTO tbl_contact_subject (cs_title,cs_create_date,cs_removable) VALUES (?,?,?)";
                $params = [$post['title'], $this->jaliliDate(), 1];
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در موضوعات پیام های پشتیبانی");
                $this->response_success("موضوع ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editContactSubject($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_contact_subject WHERE cs_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("موضوع مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_contact_subject SET cs_title=? WHERE cs_id=?";
                $params = array($post['titleEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات موضوع " . $post['titleEdit']);
                $this->response_success("موضوع ".$post['titleEdit']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delContactSubject($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_contact_subject WHERE cs_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $result = $this->doSelect("SELECT cs_title FROM tbl_contact_subject WHERE cs_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_contact_subject WHERE cs_id=?", array($post['id']));

                $this->ActivityLog("حذف موضوع " . $result['0']['cs_title']);
                $this->response_success("موضوع ".$result['0']['cs_title']." باموفقیت حذف شد");
            } else {
                $this->response_error("موضوع مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}
