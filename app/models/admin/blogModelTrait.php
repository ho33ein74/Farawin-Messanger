<?php
trait  blogModelTrait
{
    function getBlogInfoEdit($attrId)
    {
        $sql = "SELECT a.*,b.name,d.title AS sourceName FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_sources d
                ON a.source=d.so_id
                WHERE a.n_id=?";
        $result = $this->doSelect($sql, array($attrId));

        return $result;
    }

    function getBlogAjax($get)
    {
        $columns = array(
            array('db' => 'n_id', 'dt' => 0),
            array(
                'db' => 'title', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $this->summary($d, 75);
                }
            ),
            array('db' => 'name', 'dt' => 2),
            array(
                'db' => 'cover', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $file = '<img onerror="this.src=\'public/images/Album+Cover+icon2-01.png\'" width="80px" height="50px" src="public/images/blog/' . $d . '">';

                    return $file;
                }
            ),
            array('db' => 'view', 'dt' => 4),
            array('db' => 'a_name', 'dt' => 5),
            array('db' => 'date_created', 'dt' => 6),
            array(
                'db' => 'b_status', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-blog-' . $row['n_id'] . '" data-id="' . $row['n_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-blog-' . $row['n_id'] . '" data-id="' . $row['n_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array(
                'db' => 'o_id', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    $btn='';
                    if ($row['b_status'] == 1) {
                        $btn = '<a style="margin: 1px;" class="btn btn-success btn-xs" target="_blank" href="' . URL . 'blog/article/' . $row['slug'] .'"><i class="fa fa-eye"></i></a>';
                    } else {
                        $btn = '<a  style="margin: 1px;"class="btn btn-success btn-xs" target="_blank" href="' . URL . 'blog/demo/' . $row['n_id'] . '/' . str_replace(" ", "-", $row['title']) . '"><i class="fa fa-eye"></i></a>';
                    }

                    $btn .= '<a style="margin: 1px;" title="ویرایش مطلب" class="btn btn-warning btn-xs" href="'.ADMIN_PATH.'/blog/edit/' . $row['n_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#telegram-Modal" id="btn-send-telegram-' . $row['n_id'] . '" data-id="' . $row['n_id'] . '" class="btn btn-info btn-xs"><i class="fa fa-paper-plane"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $row['n_id'] . '" data-id="' . $row['n_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT a.*,b.name,d.a_name FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(n_id) FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(n_id) FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id"
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

    function GetBlog($id)
    {
        $sql = "SELECT a.*,b.name,c.i_image,c.i_id FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                LEFT JOIN tbl_images c
                ON a.image_id=c.i_id
                WHERE a.n_id=? AND type=1
                ORDER BY a.n_id DESC";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function getIssetBlog($id)
    {
        $result = $this->doSelect("SELECT n_id FROM tbl_blog WHERE n_id= ?", array($id));
        return $result;
    }

    function addBlog($post, $admin)
    {
        try {
            $sql = "SELECT * FROM tbl_blog WHERE title=? AND cat_id=? AND writer=?";
            $param = array($post['title'], $post['category'], $admin);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_error("این مطلب قبلا ثبت شده است");
            } else {
                $dirCover = "public/images/blog/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $this->doQuery("UPDATE tbl_sources SET count=count+1 WHERE so_id=?", array($post['source']));

                $linkSource = $post['linkSource'] != NULL ? $post['linkSource'] : NULL;

                $sql = "INSERT INTO tbl_blog (suggestion,cat_id,writer,title,slug,link,subtitle,cover,main_tag,description,source,seo_title,seo_desc,date_created,time,b_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $params = [$post['suggestion'], $post['category'], $admin, $post['title'], $post['url'], $linkSource, htmlspecialchars($post['subtitle']), $coverImg, $post['mainKeyword'], htmlspecialchars($post['desc']), $post['source'], $post['seo_title'], $post['seo_desc'], $this->jalali_date(), $this->jalali_date("H:i"), $post['status']];
                $this->doQuery($sql, $params);
                $postId = Model::$conn->lastInsertId();

                if ($postId != '') {
                    if ($post['related_post'] != NULL and $post['related_post'] != "null" and $post['related_post'] != " " and $post['related_post'] != "") {
                        $related_post = explode(",", rtrim($post['related_post'], ","));
                        foreach ($related_post as $product) {
                            $sqlTag = "SELECT * FROM tbl_blog_related WHERE blog_id=? AND br_related_id=?";
                            $result = $this->doSelect($sqlTag, array($postId, $product));

                            if (sizeof($result) == 0) {
                                $sql = "INSERT INTO tbl_blog_related (blog_id,br_related_id) VALUES (?,?)";
                                $this->doQuery($sql, array($postId, $product));
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
                            $sqlTag = "SELECT * FROM tbl_blog_tag WHERE pt_post_id=? AND pt_tag_id=?";
                            $result = $this->doSelect($sqlTag, array($postId, $tag));

                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_blog_tag (pt_post_id,pt_tag_id) VALUES (?,?)";
                                $this->doQuery($sqlTags, array($postId, $tag));
                            }
                        }
                    }
                }

                $this->ActivityLog("افزودن مطلب " . $post['title'] . " در بخش وبلاگ");
                $this->response_success("مطلب ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editBlog($post, $admin)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("مطلب مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/blog/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    unlink($dirCover . $result[0]['cover']);
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                    $this->doQuery("UPDATE tbl_blog SET cover=? WHERE n_id=?", array($coverImg, $post['id']));
                }

                $linkSource = $post['linkSource'] != NULL ? $post['linkSource'] : NULL;

                $sql = "UPDATE tbl_blog SET slug=?, seo_desc=?, seo_title=?, suggestion=?, cat_id=?, title=?, link=?, subtitle=?, main_tag=?, description=?, source=?, b_status=? WHERE n_id=?";
                $params = array($post['url'], $post['seo_desc'], $post['seo_title'], $post['suggestion'], $post['category'], $post['title'], $linkSource, htmlspecialchars($post['subtitle']), $post['mainKeyword'], htmlspecialchars($post['desc']), $post['source'], $post['status'], $post['id']);
                $this->doQuery($sql, $params);

                if ($post['id'] != "") {
                    //remove old related
                    $this->doQuery("DELETE FROM tbl_blog_related WHERE blog_id=?", array($post['id']));
                    if ($post['related_post'] != NULL and $post['related_post'] != "null" and $post['related_post'] != " " and $post['related_post'] != "") {
                        $related_post = explode(",", rtrim($post['related_post'], ","));
                        foreach ($related_post as $item) {
                            $sqlTag = "SELECT * FROM tbl_blog_related WHERE blog_id=? AND br_related_id=?";
                            $result = $this->doSelect($sqlTag, array($post['id'], $item));

                            if (sizeof($result) == 0) {
                                $sql = "INSERT INTO tbl_blog_related (blog_id,br_related_id) VALUES (?,?)";
                                $this->doQuery($sql, array($post['id'], $item));
                            }
                        }
                    }

                    //remove old tags
                    $tags = $this->doSelect("SELECT * FROM tbl_blog_tag WHERE pt_post_id=?", array($post['id']));
                    foreach ($tags as $tag) {
                        $this->doQuery("UPDATE tbl_tags SET count=count-1 WHERE t_id=?", array($tag['pt_tag_id']));
                    }
                    $this->doQuery("DELETE FROM tbl_blog_tag WHERE pt_post_id=?", array($post['id']));
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
                            $sqlTag = "SELECT * FROM tbl_blog_tag WHERE pt_post_id=? AND pt_tag_id=?";
                            $result = $this->doSelect($sqlTag, array($post['id'], $tag));

                            if (sizeof($result) == 0) {
                                $sqlTags = "INSERT INTO tbl_blog_tag (pt_post_id,pt_tag_id) VALUES (?,?)";
                                $this->doQuery($sqlTags, array($post['id'], $tag));
                            }
                        }
                    }
                }

                $this->ActivityLog("ویرایش مطلب " . $post['title'] . " در بخش تحریریه");
                $this->response_success("مطلب ".$post['title']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusBlog($post)
    {
        try {
            $this->doQuery("UPDATE tbl_blog SET b_status=(case when b_status=1 then 0 else 1 end) WHERE n_id=?", array($post['id']));
            $result = $this->doSelect("SELECT title,b_status FROM tbl_blog WHERE n_id=?", array($post['id']), 1);

            if ($result['b_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت مطلب ".$result['title']." در وبلاگ ");
                $this->response_success("مطلب مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت مطلب ".$result['title']." در وبلاگ ");
                $this->response_success("مطلب مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delBlog($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $tags = $this->doSelect("SELECT * FROM tbl_blog_tag WHERE pt_post_id=?", array($post['id']));

                foreach ($tags as $tag) {
                    $this->doQuery("UPDATE tbl_tags SET count=count-1 WHERE t_id=?", array($tag['pt_tag_id']));
                }

                unlink("public/images/blog/" . $result[0]['cover']);

                $this->doQuery("DELETE FROM tbl_blog WHERE n_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_blog_tag WHERE pt_post_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_comments WHERE p_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_services_related_blog WHERE blog_id=?", array($post['id']));

                $this->ActivityLog("حذف مطلب " . $result['0']['title'] . " از بخش تحریریه");
                $this->response_success("مطلب ".$result['0']['title']." باموفقیت حذف شد");
            } else {
                $this->response_error("مطلب مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function sendBlog($post)
    {
        try {
            $sql = "SELECT a.*,b.name FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                WHERE a.b_status=1 AND a.n_id=?";
            $result = $this->doSelect($sql, array($post['id']));

            if(sizeof($result)>0) {
                $blogLink = URL . 'blog/article/' . $result[0]['slug'];
                $caption = "🔹 " . $result[0]['title'] . "\n\n" . "🔸 " . htmlspecialchars($result[0]['subtitle']) . "\n\n" . "👇👇" . "\n" . "🌐 " . $blogLink;

                $json = $this->telegram_send_photo(URL . "public/images/blog/" . $result[0]['cover'], $caption, $this->getPublicInfo('channel_blog'));
                $json = json_decode($json, TRUE);

                if($json['ok']){
                    $this->ActivityLog("ارسال مطلب " . $result[0]['title'] . " در کانال تلگرام");
                    $this->response_success("مطلب ".$result[0]['title']." باموفقیت در تلگرام ارسال شد");
                } else {
                    $this->response_error($json['description']);
                }
            } else {
                $this->response_error("مطلب مورد نظر یافت نشد یا غیرفعال می باشد و امکان ارسال وجود ندارد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSourceAjax($get)
    {
        $columns = array(
            array('db' => 'so_id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'count', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['so_id'] . '" data-id="' . $row['so_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['so_id'] . '" data-id="' . $row['so_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<a style="margin: 1px;" class="btn btn-success btn-xs" title="مشاهده منبع" target="_blank" href="' . $row['link'] . '"><i class="fa fa-eye"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش منبع" data-target="#edit-Modal" id="btn-edit-' . $row['so_id'] . '" data-id="' . $row['so_id'] . '" data-name="' . $row['title'] . '" data-link="' . $row['link'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف منبع" data-target="#del-Modal" id="btn-del-style-' . $row['so_id'] . '" data-id="' . $row['so_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_sources $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(so_id) FROM tbl_sources $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(so_id) FROM tbl_sources");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getSources()
    {
        $sql = "SELECT so_id,title FROM tbl_sources WHERE status=1 ORDER BY title ASC ";
        $result = $this->doSelect($sql);

        return $result;
    }

    function addSource($post, $id)
    {
        try {
            $sql = "SELECT * FROM tbl_sources WHERE title=? OR link=?";
            $param = array($post['title'], $post['slug']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("منبع دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_sources (title,link,user_id,date) VALUES (?,?,?,?)";
                $params = [$post['title'], $post['slug'], $id, $this->jalali_date()];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در منابع");
                $this->response_success("منبع جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editSource($post, $admin)
    {
        try {
            $sql3 = "UPDATE tbl_sources SET title=?, link=?, date_edit=? , user_id_edit=? WHERE so_id=?";
            $params = [$post['titleEdit'], $post['slugEdit'], $this->jalali_date(), $admin, $post['id']];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش اطلاعات  " . $post['titleEdit'] . " در منابع");
            $this->response_success("اطلاعات منبع ".$post['titleEdit']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusSource($post)
    {
        try {
            $this->doQuery("UPDATE tbl_sources SET status=(case when status=1 then 0 else 1 end) WHERE so_id=?", array($post['id']));
            $result = $this->doSelect("SELECT status, title FROM tbl_sources WHERE so_id=?", array($post['id']), 1);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ".$result['name']." در منابع");
                $this->response_success("منبع مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ".$result['name']." در منابع");
                $this->response_success("منبع مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delSource($post)
    {
        try {
            $result = $this->doSelect("SELECT title FROM tbl_sources WHERE so_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $result = $this->doSelect("SELECT title FROM tbl_sources WHERE so_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_blog WHERE source=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_sources WHERE so_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['name']." از لیست منابع");
                $this->response_success("منبع مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("منبع مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSourcesInfo()
    {
        $sql = "SELECT a.*,b.a_name AS name FROM tbl_sources a
                    LEFT JOIN tbl_admin b
                    ON a.user_id=b.a_id
                    ORDER BY a.so_id DESC";

        $result = $this->doSelect($sql);

        return $result;
    }

    function getRelatedBlog($attrId='')
    {
        if($attrId != "") {
            $sql = "SELECT n_id,slug,title FROM tbl_blog WHERE b_status=1 AND n_id != ? ORDER BY title ASC ";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT n_id,slug,title FROM tbl_blog WHERE b_status=1 ORDER BY title ASC ";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function getRelatedBlogSelected($id, $type)
    {
        if($type == "blog") {
            $result = $this->doSelect("SELECT br_related_id FROM tbl_blog_related WHERE blog_id=?", array($id));
        } else {
            $result = $this->doSelect("SELECT blog_id as br_related_id FROM tbl_services_related_blog WHERE service_id=?", array($id));
        }
        $data = array();
        foreach ($result as $res){
            $data[]=$res['br_related_id'];
        }
        return $data;
    }

    function getSourcesInfoEdit($attrId)
    {
        $sql = "SELECT *FROM tbl_sources WHERE so_id=?";
        $param = array($attrId);

        $result = $this->doSelect($sql, $param);

        return $result;
    }

    function latestNews()
    {
        $sql = "SELECT a.*,b.name FROM tbl_blog a
                LEFT JOIN tbl_category b
                ON a.cat_id=b.id
                WHERE a.b_status=1 ORDER BY a.n_id DESC LIMIT 5";
        $result = $this->doSelect($sql);

        return $result;
    }

}
