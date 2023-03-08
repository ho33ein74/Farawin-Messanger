<?php
trait faqModelTrait
{
    function getQuestionsAjax($get)
    {
        try {
            $columns = array(
                array('db' => 'id', 'dt' => 0),
                array('db' => 'type', 'dt' => 1,
                    'formatter' => function ($d, $row) {
                        $name = "عمومی";
                        if ($d == "service") {
                            $name = "خدمات";
                        }
                        return $name;
                    }
                ),
                array('db' => 'question', 'dt' => 2),
                array('db' => 'view', 'dt' => 3),
                array('db' => 'status', 'dt' => 4,
                    'formatter' => function ($d, $row) {
                        if ($d == 1) {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-success btn-xs">فعال</button>';
                        } else {
                            return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                        }
                    }
                ),
                array(
                    'db' => 'id', 'dt' => 5,
                    'formatter' => function ($d, $row) {
                        $btn = '<a style="margin: 1px;" target="_blank" class="btn btn-success btn-xs" title="مشاهده سوال" href="faq/details/' . $row['id'] . '"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a style="margin: 1px;" class="btn btn-warning btn-xs" title="ویرایش سوال" href="' . ADMIN_PATH . '/faq/edit/' . $row['id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف سوال" data-target="#del-Modal" id="btn-del-style-' . $row['id'] . '" data-id="' . $row['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    }
                )
            );

            $bindings = array();
            $where = $this->filter($get, $columns, $bindings, array(""));
            $order = $this->order($get, $columns);
            $limit = $this->limit($get, $columns);

            $data = $this->sql_exec($bindings,
                "SELECT * FROM tbl_faq $where $order $limit"
            );

            // Data set length after filtering
            $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(id) FROM tbl_faq $where");
            $recordsFiltered = $resFilterLength[0][0];

            // Total data set length
            $resTotalLength = $this->sql_exec("SELECT COUNT(id) FROM tbl_faq");
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

    function addFaq($post)
    {
        try {
            $sql = "SELECT * FROM tbl_faq WHERE question=? and answer=? and type=?";
            $param = array($post['question'], $post['answer'], $post['type']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("این سوال قبلا ثبت شده است", "exist");
            } else {
                $itemId = NULL;
                if ($post['type'] == "service") {
                    $itemId = $post['serviceId'];
                }

                $sql = "INSERT INTO tbl_faq (question,answer,type) VALUES (?,?,?)";
                $params = array($post['question'], $post['answer'], $post['type']);
                $this->doQuery($sql, $params);
                $id = Model::$conn->lastInsertId();

                if ($itemId != NULL and $itemId != "null" and $itemId != " " and $itemId != "") {
                    $this->saveRelatedFaq($itemId, $id, $post['type']);
                }

                $this->ActivityLog("افزودن سوال جدید در بخش سوالات متداول");
                $this->response_success("سوال جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusFaq($post)
    {
        try {
            $this->doQuery("UPDATE tbl_faq SET status=(case when status=1 then 0 else 1 end) WHERE id=?", array($post['id']));

            $result = $this->doSelect("SELECT status, question FROM tbl_faq WHERE id=?", array($post['id']), 1);

            $this->ActivityLog("ویرایش وضعیت سوال ".$result['question']);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت سوال ".$result['question']);
                $this->response_success("سوال مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت سوال ".$result['question']);
                $this->response_success("سوال مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getQuestinInfoEdit($attrId)
    {
        try {
            return $this->doSelect("SELECT * FROM tbl_faq WHERE id=?", array($attrId));
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getQuestionRelated($attrId, $type)
    {
        try {
            $result =  $this->doSelect("SELECT * FROM tbl_faq_related WHERE faq_id=? AND type=?", array($attrId, $type));
            return array_column($result, "item_id");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editQuestion($post)
    {
        try {
            $itemId = NULL;
            if ($post['type'] == "service") {
                $itemId = $post['serviceId'];
            }

            $sql = "UPDATE tbl_faq SET question=?, answer=?, type=? WHERE id=?";
            $params = [$post['question'], $post['answer'], $post['type'], $post['id']];
            $this->doQuery($sql, $params);

            $this->doQuery("DELETE FROM tbl_faq_related WHERE faq_id=? AND type=?", array($post['id'], $post['type']));
            if ($itemId != NULL and $itemId != "null" and $itemId != " " and $itemId != "") {
                $this->saveRelatedFaq($itemId, $post['id'], $post['type']);
            }

            $this->ActivityLog("ویرایش سوال " . $post['question'] . " در بخش سوالات متداول");
            $this->response_success("سوال مورد نظر با موفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delQuestion($post)
    {
        try {
            $result = $this->doSelect("SELECT question FROM tbl_faq WHERE id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->ActivityLog("حذف سوال " . $result['0']['tag'] . " از بخش سوالات متداول");
                $this->doQuery("DELETE FROM tbl_faq WHERE id=?", array($post['id']));

                $this->response_success("سوال مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("سوال مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function saveRelatedFaq($items, $faq_id, $type): void
    {
        $items = explode(",", rtrim($items, ","));
        foreach ($items as $item) {
            $sqlTag = "SELECT * FROM tbl_faq_related WHERE item_id=? AND faq_id=? AND type=?";
            $result = $this->doSelect($sqlTag, array($item, $faq_id, $type));
            if (sizeof($result) == 0) {
                $sql = "INSERT INTO tbl_faq_related (
                                  type,
                                  faq_id,
                                  item_id,
                                  fr_status
                            ) VALUES (?,?,?,?)";
                $params = array(
                    $type,
                    $faq_id,
                    $item,
                    1
                );
                $this->doQuery($sql, $params);
            }
        }
    }
}
