<?php

class model_user extends Model
{
    function __construct()
    {
        parent::__construct();
    }


    function publicData($userId='')
    {
        $sql = "SELECT count(*) AS num FROM tbl_services_reservation WHERE sre_status!=0 AND user_id=?";
        $result['reservations'] = $this->doSelect($sql, array($userId));

        $sql = "SELECT count(*) AS num FROM tbl_comments WHERE cm_user_id=?";
        $result['comments'] = $this->doSelect($sql, array($userId));

        return $result;
    }

    function getsuggestNews()
    {
        $sql = "SELECT a.*,b.name,c.i_image,c.i_id FROM tbl_news a
                LEFT JOIN tbl_category b 
                ON a.cat_id=b.id
                LEFT JOIN tbl_images c 
                ON a.image_id=c.i_id
                WHERE a.status=1
                ORDER BY rand() DESC LIMIT 4";
        $result = $this->doSelect($sql);

        return $result;
    }

    function logout()
    {
        unset($_COOKIE['userId']);
        setcookie('userId', null, -1, '/');
    }

    function deleteFav($post, $userId)
    {
        $sql = "DELETE FROM tbl_favorite WHERE product_id=? AND type=? AND user_id=?";
        $value = array($post['product_id'], $post['type'], $userId);
        $this->doQuery($sql, $value);
        echo "delete";
    }

    function upload($userId, $post)
    {
        try {
            if (isset($_FILES["image"]["name"])) {
                $dir = "public/images/user/upload/";
                $nameImg = time() . "_" . $userId."000111000".rand(1, 9999) . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $nameImg);

                $result = array(
                    "status" => "success",
                    "url" => URL.$dir.$nameImg,
                );
            } else {
                $result = array(
                    "message" => "The given data was invalid.",
                    "errors" => array(
                        "image" => array(
                            "تصویر باید یکی از فرمت های jpg, jpeg, png باشد.",
                            "validation.mimetypes"
                        )
                    )
                );
            }
            echo json_encode($result);
        } catch (Exception $e) {
            $result = array(
                "message" => $e->getMessage(),
                "errors" => array(
                    "image" => array(
                        $e->getMessage(),
                    )
                )
            );
            echo json_encode($result);
        }
    }

    function deleteImg($userId)
    {
        $sql = "SELECT image FROM tbl_user WHERE id=?";
        $result = $this->doSelect($sql, array($userId));
        if (@$result[0]['image'] != "0") {
            unlink(str_replace(URL, "", @$result[0]['image']));
        }

        $sql = "UPDATE tbl_user SET image=? WHERE id=?";
        $params = [0, $userId];
        $this->doQuery($sql, $params);
        Model::cookie_set('imageUserProfile', FALSE, time() + (24 * 60 * 60 * 30));

        echo "delete";
    }

    function editUserInfo($post, $userId)
    {
        try {
            $birthday = array(
                "year" => $post['birth_year'],
                "month" => $post['birth_month'],
                "day" => $post['birth_day']
            );

            $sql = "UPDATE tbl_customer SET c_name=?,c_family=?,c_display_name=?,c_phone_num=?,c_email=?,province_id=?,city_id=?,c_birthday=?,c_cart_no=?,c_about=?,c_status=? WHERE customer_vids_id=?";
            $params = array($post['fname'], $post['lname'], $post['fname'] . " " . $post['lname'], $post['phone'], $post['email'], $post['provinceId'], $post['cityId'], json_encode($birthday), $post['no_card'], $post['about'], 1, $userId);
            $this->doQuery($sql, $params);

            $this->response_success("اطلاعات حساب شما باموفقیت ویرایش شد.");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function changePass($post, $userId)
    {
        if ($post['new_password'] == $post['retry_new_password']) {
            $pass = password_hash($post['new_password'], PASSWORD_DEFAULT);
            $sql = "UPDATE tbl_user SET password=? WHERE id=?";
            $params = [$pass, $userId];
            $this->doQuery($sql, $params);
            echo "ok";
        } else {
            echo "error";
        }
    }

    function submitPointRepair($userId, $post)
    {
        $a_sql = "SELECT * FROM tbl_point_repair WHERE user_id=? AND o_id=?";
        $a_param = array($userId, $post['id']);
        $res = $this->doSelect($a_sql, $a_param);

        if (sizeof($res) <= 0) {
            if ($post['note'] != "") {
                $note = $post['note'];
            } else {
                $note = NULL;
            }

            $sql = "INSERT INTO tbl_point_repair ( pr_q1, pr_q2, pr_q3, pr_q4, pr_q5, pr_q6, pr_q7, pr_q8, pr_comment, user_id, o_id,
                        pr_date_created, pr_status)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $value = array($post['q1'], $post['q2'], $post['q3'], $post['q4'], $post['q5'], $post['q6'],
                $post['q7'], $post['q8'], $note, $userId, $post['id'], self::jalali_date(), 1);
            $this->doQuery($sql, $value);
            echo "ok";
        } else {
            echo "error";
        }
    }

    function userLike($userId, $post)
    {
        try {
            if ($post['part'] == "comment") {
                $sql = "SELECT cl_id FROM tbl_comment_like WHERE comment_id=? AND user_id=? AND cl_type=?";
                $res = $this->doSelect($sql, array($post['id'], $userId, $post['type']));

                if (sizeof($res) == 0) {
                    $sql = "INSERT INTO tbl_comment_like (user_id,comment_id,cl_type) VALUES (?,?,?)";
                    $value = array($userId, $post['id'], $post['type']);
                    $this->doQuery($sql, $value);

                    $this->response_success("باموفقیت ثبت شد", "add");
                } else {
                    $sql = "DELETE FROM tbl_comment_like WHERE comment_id=? AND user_id=? AND cl_type=?";
                    $value = array($post['id'], $userId, $post['type']);
                    $this->doQuery($sql, $value);

                    $this->response_success("باموفقیت حذف شد", "remove");
                }
            } else {
                $sql = "SELECT l_id FROM tbl_like WHERE item_id=? AND user_id=? AND l_type=?";
                $res = $this->doSelect($sql, array($post['id'], $userId, $post['type']));

                if (sizeof($res) == 0) {
                    $sql = "INSERT INTO tbl_like (user_id,item_id,l_type) VALUES (?,?,?)";
                    $value = array($userId, $post['id'], $post['type']);
                    $this->doQuery($sql, $value);

                    $this->response_success("باموفقیت ثبت شد", "add");
                } else {
                    $sql = "DELETE FROM tbl_like WHERE item_id=? AND user_id=? AND l_type=?";
                    $value = array($post['id'], $userId, $post['type']);
                    $this->doQuery($sql, $value);

                    $this->response_success("باموفقیت حذف شد", "remove");
                }
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addOrDeleteBookmark($userId, $post)
    {
        try {
            $sql = "SELECT b_id FROM tbl_bookmarks WHERE item_id=? AND user_id=? AND b_type=?";
            $res = $this->doSelect($sql, array($post['id'], $userId, $post['type']));

            if (sizeof($res) == 0) {
                $sql = "INSERT INTO tbl_bookmarks (user_id,item_id,b_type) VALUES (?,?,?)";
                $value = array($userId, $post['id'], $post['type']);
                $this->doQuery($sql, $value);

                $this->response_success("باموفقیت ثبت شد", "add");
            } else {
                $sql = "DELETE FROM tbl_bookmarks WHERE item_id=? AND user_id=? AND b_type=?";
                $value = array($post['id'], $userId, $post['type']);
                $this->doQuery($sql, $value);

                $this->response_success("باموفقیت حذف شد", "remove");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addRating($userId, $post)
    {
        $sql = "SELECT r_id FROM tbl_rating WHERE item_id=? AND user_id=? AND r_type=?";
        $res = $this->doSelect($sql, array($post['id'], $userId, $post['type']));

        if (sizeof($res) == 0) {
            $sql = "INSERT INTO tbl_rating (user_id,item_id,r_type,r_rate) VALUES (?,?,?,?)";
            $value = array($userId, $post['id'], $post['type'], $post['rate']);
            $this->doQuery($sql, $value);

            $score = $this->doSelect("SELECT COUNT(r_id) count, SUM(r_rate) sum, FORMAT(AVG(r_rate), 2) avg FROM tbl_rating WHERE item_id=? AND r_type=?", array($post['id'], $post['type']), 1);

            $data = array(
                "count" => $score['count'],
                "avg" => $score['sum']/$score['count'],
                "sum" => $score['sum'],
                "score" => ($score['avg']*20),
            );

            $this->response_success("منبع جدید با موفقیت ثبت شد", "add", "", $data);

        } else {
            $this->response_warning("امتیاز شما برای این مطلب قبلا ثبت شده است.", "exist");
        }
    }

    function getPaymentLog($userId)
    {
        $sql = "SELECT p.*,s.s_title,s.s_slug,sre.sre_day,sre.sre_date,sre.sre_time
                    FROM tbl_payment_log p
                    LEFT JOIN tbl_services_reservation sre ON p.order_vids_id=sre.order_service_vids_id AND p.part=1
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    WHERE sre.user_id=?
                    ORDER BY p.payment_vids_id DESC";
        return $this->doSelect($sql, array($userId));
    }

    function getLastBookingUser($userId)
    {
        $_where = "sre.sre_status!=0 AND sre.user_id=?";
        $_input = array($userId);
        $_order = "ORDER BY order_service_vids_id DESC";
        $_limit = "LIMIT 10";
        return $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);
    }

    function getIssetBooking($userId, $id)
    {
        $sql = "SELECT * FROM tbl_services_reservation WHERE user_id=? AND order_service_vids_id=?";
        return $this->doSelect($sql, array($userId, $id));
    }

    function getBookingUser($userId)
    {
        $_input = array($userId);
        $_order = "ORDER BY order_service_vids_id DESC";
        $_limit = "";

        $_where = "sre.sre_status=0 AND sre.user_id=?";
        $result['awaiting'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        $_where = "sre.sre_status=6 AND sre.user_id=?";
        $result['canceled'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        $_where = "sre.sre_status=5 AND sre.user_id=?";
        $result['done'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        $_where = "sre.sre_status NOT IN (0,5,6) AND sre.user_id=?";
        $result['doing'] = $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input);

        return $result;
    }

    function getBookingUserDetails($userId, $id)
    {
        $_where = "sre.sre_status!=0 AND sre.user_id=? AND sre.order_service_vids_id=?";
        $_input = array($userId, $id);
        $_order = "ORDER BY order_service_vids_id DESC";
        $_limit = "";
        return $this->getBookingData(False, $userId, $_where, $_order, $_limit, $_input, True);
    }

    function getBookingPaymentUser($id = '')
    {
        $sql = "SELECT * FROM tbl_payment_log WHERE order_vids_id=? AND part=1 ORDER BY payment_vids_id DESC";
        return $this->doSelect($sql, array($id));
    }

    function getOrder($userId, $id)
    {
        if ($id != '' && is_numeric($id)) {
            $sql = "SELECT o.*,u.name FROM tbl_order_shop o
                        LEFT JOIN tbl_user u
                        ON o.user_id=u.id
                        WHERE o.user_id=? AND o.id=? AND o.status!=0";
            $data = array($userId, $id);
            $result = $this->doSelect($sql, $data);
        } else {
            $sql = "SELECT * FROM tbl_order_shop WHERE user_id=? AND status!=0 ORDER BY id DESC";
            $data = array($userId);
            $result = $this->doSelect($sql, $data);
        }

        return $result;
    }

    function getIssetOrder($userId, $id)
    {
        $sql = "SELECT id FROM tbl_order_shop WHERE user_id=? AND id= ? AND status!=0";
        $param = array($userId, $id);
        $result = $this->doSelect($sql, $param);

        return $result;
    }

    function getOrderStatus()
    {
        $sql = "SELECT * FROM tbl_order_status";
        $result = $this->doSelect($sql);

        return $result;
    }

    function getComment($userId)
    {
        $sql = "SELECT cm_id,cm_answer_id,cm_reply_admin_id,cm_date,cm_time,cm_status,b.slug,b.title,b.cover,c.c_display_name,c.c_image,
                cm_text,l.cl_id as liked, s.s_title,s.s_cover,s.s_slug,
				(SELECT COUNT(cl_id) as count FROM tbl_comment_like WHERE comment_id=a.cm_id AND cl_type=?) as likeCount
                FROM tbl_comments a
                LEFT JOIN tbl_customer c ON a.cm_user_id=c.customer_vids_id
                LEFT JOIN tbl_blog b ON a.p_id=b.n_id AND a.cm_type='blog'
                LEFT JOIN tbl_services s ON a.p_id=s.s_id AND a.cm_type='service'
                LEFT JOIN tbl_comment_like l ON (a.cm_id=l.comment_id AND l.cl_type=? AND user_id=?)
                WHERE a.reply=0 AND a.cm_type=? AND a.cm_user_id=? ORDER BY cm_id DESC";
        $result['blog'] = $this->doSelect($sql, array("blog", "blog", $userId, "blog", $userId));
        $result['service'] = $this->doSelect($sql, array("service", "service", $userId, "service", $userId));

        return $result;
    }

    function getFavoriteMag($userId)
    {
        $sql = "SELECT n.title,n.n_id
                FROM tbl_favorite a
                LEFT JOIN tbl_news n
                ON a.product_id=n.n_id
                WHERE a.type='news' AND user_id=? ORDER BY id DESC";
        $data = array($userId);
        $result = $this->doSelect($sql, $data);

        return $result;
    }

    function getFavoriteShop($userId)
    {
        $sql = "SELECT p.p_name,p.p_id
                FROM tbl_favorite a
                LEFT JOIN tbl_product p
                ON a.product_id=p.p_id
                WHERE a.type='shop' AND user_id=? ORDER BY id DESC";
        $data = array($userId);
        $result = $this->doSelect($sql, $data);

        return $result;
    }

    function deleteFavorite($userId, $post)
    {
        if (isset($post["parameters"])) {
            $params = explode("-", $post["parameters"]);
            $sql = "DELETE FROM tbl_favorite WHERE product_id= ? AND type=? AND user_id=?";
            $params = [$params[1], $params[0], $userId];
            $this->doQuery($sql, $params);
            echo "delete";
        } else {
            echo "error";
        }
    }

    function sendComment($post, $userId)
    {
        try {
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body,true);

            if($data['updates'][0]['payload']['value']!="") {
                $sql = "SELECT * FROM `tbl_comments` WHERE `cm_user_id` = ? AND `p_id` = ? AND `cm_text` = ? AND `cm_type` = ?";
                $params = array($userId, $data['fingerprint']['itemID'], $data['updates'][0]['payload']['value'], $data['fingerprint']['type']);
                $res = $this->doSelect($sql, $params);

                if (sizeof($res) > 0) {
                    $jayParsedAry = [
                        "effects" => [
                            "html" => "",
                            "emits" => [
                                [
                                    "event" => "toast",
                                    "params" => [
                                        "نظر شما قبلا ثبت شده است و در انتظار تایید توسط مدیر می باشد",
                                        "error"
                                    ]
                                ]
                            ],
                            "dirty" => [
                                "message"
                            ]
                        ],
                        "serverMemo" => [
                            "children" => [
                                [
                                    "id" => "V452HjndVFEbhkPh55e1",
                                    "tag" => "div"
                                ]
                            ],
                            "htmlHash" => "c096dcda",
                            "data" => [
                                "message" => "",
                                "loading" => null
                            ],
                            "checksum" => "f782d1298d95483b7fd1a603304b2dacc6e680c61664f168ecd1198d1141d672"
                        ]
                    ];
                } else {
                    $reply = 0;
                    $parentId = 0;
                    if($data['serverMemo']['data']['parentId']>0){
                        $reply = 1;
                        $parentId = $data['serverMemo']['data']['parentId'];
                    }
                    $sql = "INSERT INTO tbl_comments (p_id,cm_user_id,cm_answer_id,cm_text,cm_date,cm_time,cm_type,reply) VALUES (?,?,?,?,?,?,?,?)";
                    $value = array($data['fingerprint']['itemID'], $userId, $parentId, $data['updates'][0]['payload']['value'], self::jalali_date(), self::jalali_date("H:i"), $data['fingerprint']['type'], $reply);
                    $this->doQuery($sql, $value);

                    $jayParsedAry = [
                        "effects" => [
                            "html" => "",
                            "emits" => [
                                [
                                    "event" => "toast",
                                    "params" => [
                                        "دیدگاه شما با موفقیت ارسال شد و بعد از تایید در سایت نمایش داده میشود",
                                        "success"
                                    ]
                                ]
                            ],
                            "dispatches" => [
                                [
                                    "event" => "editor-6290e73640e6b-content-init",
                                    "data" => [
                                        "content" => ""
                                    ]
                                ],
                                [
                                    "event" => "hide-send-comment",
                                    "data" => null
                                ]
                            ],
                            "dirty" => [
                                "message"
                            ]
                        ],
                        "serverMemo" => [
                            "children" => [
                                [
                                    "id" => "V452HjndVFEbhkPh55e1",
                                    "tag" => "div"
                                ]
                            ],
                            "htmlHash" => "c096dcda",
                            "data" => [
                                "message" => "",
                                "loading" => null
                            ],
                            "checksum" => "f782d1298d95483b7fd1a603304b2dacc6e680c61664f168ecd1198d1141d672"
                        ]
                    ];
                }
            } else {
                $jayParsedAry = [
                    "effects" => [
                        "html" => "",
                        "emits" => [
                            [
                                "event" => "toast",
                                "params" => [
                                    "متن پیام الزامی است",
                                    "error"
                                ]
                            ]
                        ],
                        "dirty" => [
                            "message"
                        ]
                    ],
                    "serverMemo" => [
                        "children" => [
                            [
                                "id" => "V452HjndVFEbhkPh55e1",
                                "tag" => "div"
                            ]
                        ],
                        "htmlHash" => "c096dcda",
                        "data" => [
                            "message" => "",
                            "loading" => null
                        ],
                        "checksum" => "f782d1298d95483b7fd1a603304b2dacc6e680c61664f168ecd1198d1141d672"
                    ]
                ];
            }
            echo json_encode($jayParsedAry);
        }  catch (Exception $e) {
            $jayParsedAry = [
                "effects" => [
                    "html" => "",
                    "emits" => [
                        [
                            "event" => "toast",
                            "params" => [
                                $e->getMessage(),
                                "error"
                            ]
                        ]
                    ],
                    "dirty" => [
                        "message"
                    ]
                ],
                "serverMemo" => [
                    "children" => [
                        [
                            "id" => "V452HjndVFEbhkPh55e1",
                            "tag" => "div"
                        ]
                    ],
                    "htmlHash" => "c096dcda",
                    "data" => [
                        "message" => "",
                        "loading" => null
                    ],
                    "checksum" => "f782d1298d95483b7fd1a603304b2dacc6e680c61664f168ecd1198d1141d672"
                ]
            ];
            echo json_encode($jayParsedAry);
        }
    }

    function replyCommentSave($post, $userId)
    {
        $sql = "SELECT * FROM `tbl_comments` WHERE `cm_answer_id`= ? AND `p_id` = ? AND `cm_date` = ? AND `cm_type` = ?";
        $params = array($userId, $post['ProductID'], time(), "blog");
        $res = $this->doSelect($sql, $params);

        if (sizeof($res) > 0) {
            echo "isset";
        } else {
            $sql = "INSERT INTO tbl_comments (p_id,cm_user_id,cm_answer_id,cm_text,cm_date,cm_time,cm_type) VALUES (?,?,?,?,?,?,?)";
            $value = array($post['ProductID'], $userId, $post['CommentIdReply'], $post['adminreply'], self::jalali_date(), self::jalali_date("H:i"), "blog");
            $this->doQuery($sql, $value);
            echo "ok";
        }
    }
}

?>