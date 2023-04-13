<?php
trait accountingModelTrait
{
    function getCurrency()
    {
        $result = $this->doSelect("SELECT * FROM tbl_currency WHERE c_status=1");
        return $result;
    }

    function getPaymentLog($id = '', $type = NULL)
    {
        $sql = "SELECT p.*,b.b_name, c.c_name
                FROM tbl_payment_log p
                LEFT JOIN tbl_banks b ON p.pay_to=b.bank_vids_id
                LEFT JOIN tbl_cash c ON p.pay_to=c.cash_vids_id
                WHERE p.order_vids_id=? AND p.part=? ORDER BY payment_vids_id DESC";

        if ($type == "service") {
            $result = $this->doSelect($sql, array($id, 1));
        } else {
            $sql = "SELECT * FROM tbl_payment_log WHERE payment_vids_id=?";
            $result = $this->doSelect($sql, array($id));
        }

        return $result;
    }

    function getCostLog($id = '', $type='')
    {
        if ($type != NULL) {
            $sql = "SELECT * FROM tbl_cost WHERE cost_vids_id=? ORDER BY cost_vids_id ASC";
            $result = $this->doSelect($sql, array($id));
        } else {
            $sql = "SELECT * FROM tbl_cost WHERE cost_vids_id=?";
            $result = $this->doSelect($sql, array($id));
        }

        return $result;
    }

    function getCostType()
    {
        $sql = "SELECT cost_category_vids_id,title FROM tbl_cost_type ORDER BY title ASC";
        $data = $this->doSelect($sql);

        return $data;
    }

    function getIssetPayment($id)
    {
        $sql = "SELECT payment_vids_id FROM tbl_payment_log WHERE payment_vids_id=?";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function getIssetCost($id)
    {
        $sql = "SELECT cost_vids_id FROM tbl_cost WHERE cost_vids_id=?";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function getPaymentAjax($get)
    {
        $columns = array(
            array('db' => 'payment_vids_id', 'dt' => 0),
            array(
                'db'        => 'part', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    if($d == 1){
                        $res = "خدمات";
                    } else {
                        $res = "سایر";
                    }
                    return $res;
                }
            ),
            array('db' => 'order_vids_id', 'dt' => 2),
            array(
                'db'        => 'p.price', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($row['price'] * 10);
                }
            ),
            array(
                'db'        => 'p.afterpay', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $row['afterpay'];
                }
            ),
            array(
                'db'        => 'p.type', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $bank = "صندوق (نقدی)";
                    } elseif ($row['type'] == "bank") {
                        $bank = "حساب بانکی";
                    } else {
                        $bank = "-";
                    }

                    return $bank;
                }
            ),
            array(
                'db'        => 'p.pay_to', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $sql = "SELECT c_name as name FROM tbl_cash WHERE cash_vids_id=?";
                    } else {
                        $sql = "SELECT b_name as name FROM tbl_banks WHERE bank_vids_id=?";
                    }
                    $result = $this->doSelect($sql, array($row['pay_to']));

                    return $result['0']['name'];
                }
            ),
            array(
                'db'        => 'p.date_payment', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return $row['date_payment'];
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 8,
                'formatter' => function ($d, $row) {

                    if($row['part'] == 1){
                        $link = "reservations/list";
                    }

                    return '<a class="btn btn-success btn-xs" target="_blank"
                                                   href="'.ADMIN_PATH.'/'.$link.'/details/' . $d . '">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/payment/edit/' . $row['payment_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['payment_vids_id'] . '"
                                                        data-id="' . $row['payment_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_payment_log $where $order $limit"
        );
        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(payment_vids_id) FROM tbl_payment_log $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(payment_vids_id) FROM tbl_payment_log"
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

    function getAccountAjax($get)
    {
        $columns = array(
            array('db' => 'bank_vids_id', 'dt' => 0),
            array('db' => 'b_name', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    $img = '<img style="width: 50px; height: 50px" src="public/images/bank-logo/' . $row['b_logo'] . '.png">';
                    return $img.$d ;
                }),
            array('db' => 'b_branch', 'dt' => 2),
            array('db' => 'b_account_number', 'dt' => 3),
            array('db' => 'b_sheba_number', 'dt' => 4),
            array(
                'db' => 'b_cart_number', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return str_replace(" ", "-", $d);
                }
            ),
            array(
                'db' => 'b_status', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['bank_vids_id'] . '" data-id="' . $row['bank_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['bank_vids_id'] . '" data-id="' . $row['bank_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array(
                'db' => 'bank_vids_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $btn = '<a style="margin: 1px;" class="btn btn-success btn-xs" title="گردش حساب" href="'.ADMIN_PATH.'/accounts/transactions/' . $row['bank_vids_id'] . '"><i class="fa fa-money"></i></a>';
                    $btn .= '<a style="margin: 1px;" class="btn btn-warning btn-xs" title="ویرایش حساب بانکی" href="'.ADMIN_PATH.'/accounts/edit/' . $row['bank_vids_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    if($row['b_removable'] == 1) {
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف حساب بانکی" data-target="#del-Modal" id="btn-del-style-' . $row['bank_vids_id'] . '" data-id="' . $row['bank_vids_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    }
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT b.* FROM tbl_banks b  $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(bank_vids_id) FROM tbl_banks b $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(bank_vids_id) FROM tbl_banks");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getBankInfo($attrId = '')
    {
        if ($attrId != '') {
            $sql = "SELECT * FROM tbl_banks WHERE b_status=1 AND bank_vids_id=?";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT * FROM tbl_banks WHERE b_status=1";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function statusAccount($post)
    {
        try {
            $this->doQuery("UPDATE tbl_banks SET b_status=(case when b_status=1 then 0 else 1 end) WHERE bank_vids_id=?", array($post['id']));
            $result = $this->doSelect("SELECT b_status,b_name FROM tbl_banks WHERE bank_vids_id=?", array($post['id']), 1);

            if ($result['b_status'] == 1) {
                $this->ActivityLog("فعالسازی " . $result[0]['b_name'] . " در بخش بانک ها");
                $this->response_success("بانک ".$result['b_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی " . $result[0]['b_name'] . " در بخش بانک ها");
                $this->response_success("بانک ".$result['b_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetBank($id)
    {
        $result = $this->doSelect("SELECT bank_vids_id FROM tbl_banks WHERE bank_vids_id= ?", array($id));
        return $result;
    }

    function getAccountsTransactionsAjax($get)
    {
        $columns = array(
            array('db' => 'payment_vids_id', 'dt' => 0),
            array(
                'db' => 'part', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        $res = "خدمات";
                    } else {
                        $res = "سایر";
                    }
                    return $res;
                }
            ),
            array('db' => 'order_vids_id', 'dt' => 2),
            array(
                'db' => 'p.price', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($row['price'] * 10);
                }
            ),
            array(
                'db' => 'p.afterpay', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $row['afterpay'];
                }
            ),
            array(
                'db' => 'p.type', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $bank = "صندوق (نقدی)";
                    } elseif ($row['type'] == "bank") {
                        $bank = "حساب بانکی";
                    } else {
                        $bank = "-";
                    }

                    return $bank;
                }
            ),
            array(
                'db' => 'p.pay_to', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $sql = "SELECT c_name as name FROM tbl_cash WHERE cash_vids_id=?";
                    } else {
                        $sql = "SELECT b_name as name FROM tbl_banks WHERE bank_vids_id=?";
                    }
                    $result = $this->doSelect($sql, array($row['pay_to']));

                    return $result['0']['name'];
                }
            ),
            array(
                'db' => 'p.date_payment', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return $row['date_payment'];
                }
            ),
            array(
                'db' => 'order_vids_id', 'dt' => 8,
                'formatter' => function ($d, $row) {

                    if ($row['part'] == 1) {
                        $link = "orders";
                    } else if ($row['part'] == 2) {
                        $link = "sales";
                    }

                    return '<a class="btn btn-success btn-xs" target="_blank"
                                                   href="' . ADMIN_PATH . '/' . $link . '/v/' . $d . '">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-warning btn-xs"
                                                   href="' . ADMIN_PATH . '/payment/edit/' . $row['payment_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['payment_vids_id'] . '"
                                                        data-id="' . $row['payment_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE p.pay_to=".$get['id']." AND p.type='bank'";
        }else{
            $where.=" AND p.pay_to=".$get['id']." AND p.type='bank'";
        }

        $data = $this->sql_exec($bindings,
            "SELECT p.*
                FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_course_vids_id $where $order $limit"
        );
        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(payment_vids_id) FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_course_vids_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(payment_vids_id) FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_course_vids_id WHERE p.pay_to=".$get['id']." AND p.type='bank'"
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

    function getCashTransactionsAjax($get)
    {
        $columns = array(
            array('db' => 'payment_vids_id', 'dt' => 0),
            array(
                'db'        => 'part', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    if($d == 1){
                        $res = "خدمات";
                    } else {
                        $res = "سایر";
                    }
                    return $res;
                }
            ),
            array('db' => 'order_vids_id', 'dt' => 2),
            array(
                'db'        => 'p.price', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($row['price'] * 10);
                }
            ),
            array(
                'db'        => 'p.afterpay', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $row['afterpay'];
                }
            ),
            array(
                'db'        => 'p.type', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $bank = "صندوق (نقدی)";
                    } elseif ($row['type'] == "bank") {
                        $bank = "حساب بانکی";
                    } else {
                        $bank = "-";
                    }

                    return $bank;
                }
            ),
            array(
                'db'        => 'p.pay_to', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if ($row['type'] == "cash") {
                        $sql = "SELECT c_name as name FROM tbl_cash WHERE cash_vids_id=?";
                    } else {
                        $sql = "SELECT b_name as name FROM tbl_banks WHERE bank_vids_id=?";
                    }
                    $result = $this->doSelect($sql, array($row['pay_to']));

                    return $result['0']['name'];
                }
            ),
            array(
                'db'        => 'p.date_payment', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    return $row['date_payment'];
                }
            ),
            array(
                'db'        => 'device_type', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    if ($d == "mobile") {
                        $device = "موبایل";
                    } else if ($d == "laptop") {
                        $device = "لپ تاپ";
                    } else if ($d == "computer") {
                        $device = "کامپیوتر";
                    } else if ($d == "accessories") {
                        $device = "لوازم جانبی";
                    } else {
                        $device = "-";
                    }

                    return $device;
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 9,
                'formatter' => function ($d, $row) {

                    if($row['part'] == 1){
                        $link = "orders";
                    } else if($row['part'] == 2){
                        $link = "sales";
                    }

                    return '<a class="btn btn-success btn-xs" target="_blank"
                                                   href="'.ADMIN_PATH.'/'.$link.'/v/' . $d . '">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/payment/edit/' . $row['payment_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['payment_vids_id'] . '"
                                                        data-id="' . $row['payment_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if($where==""){
            $where.="WHERE p.pay_to=".$get['id']." AND p.type='cash'";
        }else{
            $where.=" AND p.pay_to=".$get['id']." AND p.type='cash'";
        }

        $data = $this->sql_exec($bindings,
            "SELECT p.*,o.device_type
                FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_vids_id $where $order $limit"
        );
        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(payment_vids_id) FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_vids_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(payment_vids_id) FROM tbl_payment_log p
                LEFT JOIN tbl_courses_order o
                ON p.order_vids_id=o.order_vids_id"
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

    function getCostAjax($get)
    {
        $columns = array(
            array('db' => 'cost_vids_id', 'dt' => 0),
            array(
                'db'        => 'part_type', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    if($d == 1){
                        $res = "خدمات";
                    } else {
                        $res = "سایر";
                    }
                    return $res;
                }
            ),
            array(
                'db'        => 'cost_type', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT title FROM tbl_cost_type WHERE cost_category_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);
                    return $result['title'];
                }
            ),
            array(
                'db'        => 'price', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return number_format($row['price'] * 10);
                }
            ),
            array(
                'db'        => 'description', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $row['description']=="" ? "-":$row['description'];
                }
            ),
            array(
                'db'        => 'date', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return $d;
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    return  '<a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/cost/edit/' . $row['cost_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['cost_vids_id'] . '"
                                                        data-id="' . $row['cost_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_cost $where $order $limit"
        );
        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(cost_vids_id) FROM tbl_cost $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(cost_vids_id) FROM tbl_cost");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getAccountingAjax($get)
    {
        $columns = array(
            array('db' => 'order_vids_id', 'dt' => 0),
            array(
                'db'        => 'order_vids_id', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return  $d;
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_profit) as sum FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return number_format($result['sum'] * 10);
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_peyk) as sum FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return number_format($result['sum'] * 10);
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_piece_cost) as sum FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return number_format($result['sum'] * 10);
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_bank_fees) as sum FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return number_format($result['sum'] * 10);
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_peyk) as peyk, sum(or_bank_fees) as bank_fees, sum(or_piece_cost) as piece_cost, sum(or_profit) as profit FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return "<p style='direction: ltr;margin: 0;text-align: center'>".number_format(($result['peyk']+$result['bank_fees']+$result['piece_cost']+$result['profit']) * 10)."</p>";
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT sum(or_peyk) as peyk, sum(or_bank_fees) as bank_fees, sum(or_piece_cost) as piece_cost, sum(or_profit) as profit FROM tbl_order_repairman WHERE order_vids_id=?";
                    $result = $this->doSelect($sql, array($d), 1);

                    return "<p style='direction: ltr;margin: 0;text-align: center'>".number_format(($row['price']-($result['peyk']+$result['bank_fees']+$result['piece_cost']+$result['profit'])) * 10)."</p>";
                }
            ),
            array(
                'db'        => 'price', 'dt' => 8,
                'formatter' => function ($d, $row) {
                    return number_format($row['price'] * 10);
                }
            ),
            array(
                'db'        => 'date', 'dt' => 9,
                'formatter' => function ($d, $row) {
                    return $row['date'];
                }
            ),
            array(
                'db'        => 'order_vids_id', 'dt' => 10,
                'formatter' => function ($d, $row) {
                    return  '<a class="btn btn-success btn-xs" target="_blank"
                                                   href="'.ADMIN_PATH.'/orders/v/' . $d . '">
                                                    <i class="fa fa-eye"></i>
                                                </a>' ;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_courses_order $where $order $limit"
        );
        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(order_vids_id) FROM tbl_courses_order $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(order_vids_id) FROM tbl_courses_order");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);

    }

    function addAccount($post)
    {
        try {
            $sql = "SELECT * FROM tbl_banks WHERE b_name=? AND b_account_number=?";
            $param = array($post['name'], $post['account_number']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("بانک دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                if ($post['default_bank'] == 1) {
                    $sql2 = "UPDATE tbl_banks SET b_default=0";
                    $this->doQuery($sql2);
                }

                $vids = $this->getLastId("bank");

                $sql3 = "INSERT INTO tbl_banks (bank_vids_id, b_name, b_logo, b_current_balance, b_account_opening_date, b_account_type, b_branch, b_account_number, b_sheba_number, b_cart_number, b_currency, b_default, b_description, b_date, b_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $params1 = [$vids, $post['name'], $post['logo_name'], $post['current_balance'], $post['account_opening_date'], $post['account_type'], $post['branch'], $post['account_number'], $post['no_sheba'], $post['no_card'], $post['curreny'], $post['default_bank'], $post['desc'], $this->jalali_date("Y/m/d"), 1];
                $this->doQuery($sql3, $params1);

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش بانک");
                $this->updateLastId("bank");

                $this->response_success("بانک جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editAccount($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_banks WHERE bank_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("بانک مورد نظر یافت نشد");
            } else {
                if ($post['default_bank'] == 1) {
                    $this->doQuery("UPDATE tbl_banks SET b_default=0");
                }

                $sql = "UPDATE tbl_banks SET b_name=?, b_logo=?, b_current_balance=?, b_account_opening_date=?, b_account_type=?, b_branch=?, b_account_number=?, b_sheba_number=?, b_cart_number=?, b_currency=?, b_default=?, b_description=? WHERE bank_vids_id=?";
                $params = [$post['name'], $post['logo_name'], $post['current_balance'], $post['account_opening_date'], $post['account_type'], $post['branch'], $post['account_number'], $post['no_sheba'], $post['no_card'], $post['curreny'], $post['default_bank'], $post['desc'], $post['id']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات " . $post['name'] . " در بخش بانک");
                $this->response_success("اطلاعات بانک ".$post['name']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delAccount($post)
    {
        try {
            $result = $this->doSelect("SELECT b_name FROM tbl_banks WHERE bank_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_banks WHERE bank_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['b_name'] . " از لیست بانک ها");
                $this->response_success("بانک ".$result['0']['b_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("بانک مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delPayment($post)
    {
        try {
            $result = $this->doSelect("SELECT image FROM tbl_payment_log WHERE payment_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $dirCover = "public/images/bank-receipt/";
                if ($result['0']['image'] != NULL) {
                    unlink($dirCover . $result['0']['image']);
                }

                $this->doQuery("DELETE FROM tbl_payment_log WHERE payment_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف تراکنش " . $post['id'] . " از بخش تراکنش ها");
                $this->response_success("تراکنش ".$post['id']." باموفقیت حذف شد");
            } else {
                $this->response_error("دریافتی مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delCost($post)
    {
        try {
            $result = $this->doSelect("SELECT c_id FROM tbl_cost WHERE cost_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_cost WHERE cost_vids_id=", array($post['id']));

                $this->ActivityLog("حذف هزینه " . $post['id'] . " از بخش هزینه ها");
                $this->response_success("هزینه ".$post['id']." باموفقیت حذف شد");
            } else {
                $this->response_error("هزینه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getPaymentType($get)
    {
        if (isset($get)) {
            if($get['id']=="cash") {
                $sql = "SELECT cash_vids_id as id, c_name as name FROM tbl_cash WHERE c_status=1";
            } else {
                $sql = "SELECT bank_vids_id as id, b_name as name FROM tbl_banks WHERE b_status=1";
            }
            $result = $this->doSelect($sql);

            if (sizeof($result) > 0) {
                echo json_encode($result);
            } else {
                echo "notfound";
            }
        }
    }

    function statusSettlementSold($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_services_reservation_staff WHERE os_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("آیتم مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_services_reservation_staff SET os_settlement_sold=? WHERE os_id=?";
                $params = array(1, $post['id']);
                $this->doQuery($sql, $params);

                $this->response_success("مبلغ مورد نظر باموفقیت پرداخت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getOrderPayment($from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $sql = "SELECT date_payment FROM tbl_payment_log WHERE date_payment >= '".str_replace("-","/",$this->check_param($from))."' AND date_payment <= '".str_replace("-","/",$this->check_param($to))."' ORDER BY date_payment ASC";
            $result = $this->doSelect($sql);
        } else {
            $sql = "SELECT date_payment FROM tbl_payment_log WHERE date_payment LIKE '%" . $this->jalali_date("Y/m") . "/%' ORDER BY date_payment ASC";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function delCostCategory($post)
    {
        try {
            $result = $this->doSelect("SELECT title FROM tbl_cost_type WHERE cost_category_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_cost_type WHERE cost_category_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف دسته بندی " . $result['0']['title'] . " از بخش دسته بندی هزینه ها");
                $this->response_success("دسته بندی ".$result['0']['title']." باموفقیت حذف شد");
            } else {
                $this->response_error("دسته بندی مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCostCategoryAjax($get)
    {
        $columns = array(
            array('db' => 'cost_category_vids_id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array(
                'db'        => 'cost_category_vids_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return '<a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/costCategory/edit/' . $row['cost_category_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['cost_category_vids_id'] . '"
                                                        data-id="' . $row['cost_category_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_cost_type $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(cost_category_vids_id) FROM tbl_cost_type $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(cost_category_vids_id) FROM tbl_cost_type");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addCostCategory($name)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_cost_type WHERE title=?", array($name));
            if (sizeof($result) > 0) {
                $this->response_warning("هزینه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $vids = $this->getLastId("cost_category");

                $sql = "INSERT INTO tbl_cost_type (cost_category_vids_id,title) VALUES (?,?)";
                $params = array($vids, $name);
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $name . " در بخش دسته بندی هزینه ها");
                $this->updateLastId("cost_category");

                $this->response_success("هزینه ".$name." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addPayment($post)
    {
        try {
            $sql = "SELECT payment_vids_id FROM tbl_payment_log WHERE order_vids_id=? AND part=? AND price=? AND afterpay=? AND pay_to=? AND date_payment=? AND `type`=?";
            $param = array($post['order_number'], $post['partType'], $post['order_price'], $post['order_afterpay'], $post['order_typePay'], $post['order_date'], $post['order_type']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("تراکنش دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/bank-receipt/";
                mkdir($dirCover);
                $coverImg = NULL;
                if (isset($_FILES["image"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["image"]["name"];
                    move_uploaded_file($_FILES["image"]["tmp_name"], $dirCover . "/" . $coverImg);
                }
                $vids = $this->getLastId("payment");

                $sql = "INSERT INTO tbl_payment_log (payment_vids_id,order_vids_id,part,price,afterpay,pay_to,time_payment,date_payment,date_created,`type`,image,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $params = [$vids, $post['order_number'], $post['partType'], $post['order_price'], $post['order_afterpay'], $post['order_typePay'], time(), $post['order_date'], $this->jalali_date(), $post['order_type'], $coverImg, 1];
                $this->doQuery($sql, $params);
                $this->updateLastId("payment");

                $caption = "🔹 شماره سفارش: " . $post['order_number'] . "\n\n" .
                    "🔹 مبلغ " . $post['order_price'] . " تومان \n\n" .
                    "🔹 تاریخ: " . $this->jalali_date();

                $res = $this->getPublicInfo('channel_payment');
                if ($res != "") {
                    $this->telegram_send_message($caption, $res);
                }

                $this->ActivityLog("افزودن تراکنش جدید برای درخواست " . $post['order_number']);
                $this->response_success("تراکنش جدید برای درخواست ".$post['order_number']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addCost($post)
    {
        $sql = "SELECT cost_vids_id FROM tbl_cost WHERE cost_type=? AND part_type=? AND price=? AND date=?";
        $param = array($post['costType'], $post['partType'], $post['order_price'], $post['order_date']);
        $result = $this->doSelect($sql, $param);

        if (sizeof($result) > 0) {
            $this->response_warning("هزینه دیگری با این مشخصات قبلا ثبت شده است", "exist");
        } else {
            $dirCover = "public/images/bank-receipt/";
            mkdir($dirCover);
            $coverImg = NULL;
            if (isset($_FILES["image"]["tmp_name"])) {
                $coverImg = time() . "_cost_" . $_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"], $dirCover ."/". $coverImg);
            }
            $vids = $this->getLastId("cost");

            $sql2 = "INSERT INTO tbl_cost (cost_vids_id,part_type,cost_type,type,pay_to,price,date,date_created,image,description,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $params = [$vids, $post['partType'], $post['costType'], $post['order_type'], $post['order_typePay'], $post['order_price'], $post['order_date'], $this->jalali_date(), $coverImg, $post['desc'], 1];
            $this->doQuery($sql2, $params);

            $this->ActivityLog("افزودن هزینه ".$post['desc']." در بخش مالی ");
            $this->response_success("هزینه ".$post['desc']." با موفقیت ثبت شد");
        }
    }

    function editPayment($post)
    {
        try {
            if (isset($_FILES["image"]["tmp_name"])) {
                $dirCover = "public/images/bank-receipt/";
                mkdir($dirCover);

                $coverImg = time() . "_" . $_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"], $dirCover . "/" . $coverImg);

                $res = $this->doSelect("SELECT image FROM tbl_payment_log WHERE payment_vids_id=?", array($post['id']), 1);
                if ($res['image'] != NULL) {
                    unlink($dirCover . $res['image']);
                }

                $sql = "UPDATE tbl_payment_log SET image=?  WHERE payment_vids_id=?";
                $params = array($coverImg, $post['id']);
                $this->doQuery($sql, $params);
            }

            $sql3 = "UPDATE tbl_payment_log SET order_vids_id=?, part=?, price=?, afterpay=?, pay_to=?, date_payment=?, type=?  WHERE payment_vids_id=?";
            $params1 = [$post['order_number'], $post['partType'], $post['order_price'], $post['order_afterpay'], $post['order_typePay'], $post['order_date'], $post['order_type'], $post['id']];
            $this->doQuery($sql3, $params1);

            if ($post['partType'] == 1) {
                $partType = "خدمات";
            } else {
                $partType = "سایر";
            }

            $this->ActivityLog("ویرایش تراکنش مربوط به درخواست " . $post['order_number'] . " در بخش " . $partType);
            $this->response_success("تراکنش برای درخواست ".$post['order_number']." با موفقیت ثبت شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function deleteImgPayment($post)
    {
        try {
            $dirCover = "public/images/bank-receipt/";
            $res = $this->doSelect("SELECT image FROM tbl_payment_log WHERE payment_vids_id=?", array($post['id']), 1);

            if ($res['image'] != NULL) {
                unlink($dirCover . $res['image']);
            }

            $sql3 = "UPDATE tbl_payment_log SET image=? WHERE payment_vids_id=?";
            $params1 = [NULL, $post['id']];
            $this->doQuery($sql3, $params1);

            $this->ActivityLog("حذف تصویر تراکنش مربوط به سفارش " . $post['order_number']);
            $this->response_success("تصویر تراکنش مربوط به سفارش " . $post['order_number'] . " با موفقیت حذف شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCostCategoryInfoEdit($attrId)
    {
        $result = $this->doSelect("SELECT * FROM tbl_cost_type WHERE cost_category_vids_id=?", array($attrId));

        return $result;
    }

    function editCostCategory($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_cost_type WHERE cost_category_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("دسته بندی مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_cost_type SET title=?  WHERE cost_category_vids_id=?";
                $params = array($post['name'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش دسته بندی " . $post['name'] . " در بخش دسته بندی هزینه ها");
                $this->response_success("اطلاعات دسته بندی ".$post['name']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editCost($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_cost WHERE cost_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("هزینه مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_cost SET part_type=?, cost_type=?, price=?, description=?, date=?  WHERE cost_vids_id=?";
                $params = array($post['partType'], $post['costType'], $post['order_price'], $post['desc'], $post['order_date'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش هزینه " . $post['desc']);
                $this->response_success("اطلاعات هزینه ".$post['desc']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addCash($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_cash WHERE c_name=?", array($post['id']));

            if (sizeof($result) > 0) {
                $this->response_warning("صندوق دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $vids = $this->getLastId("cash");

                $sql = "INSERT INTO tbl_cash (cash_vids_id, c_name, c_currency, c_current_balance, c_desc, c_date, c_status) VALUES (?,?,?,?,?,?,?)";
                $params = [$vids, $post['name'], $post['curreny'], $post['current_balance'], $post['desc'], $this->jalali_date("Y/m/d"), 1];
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش صندوق");
                $this->updateLastId("cash");
                $this->response_success("صندوق جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCashAjax($get)
    {
        $columns = array(
            array('db' => 'cash_vids_id', 'dt' => 0),
            array('db' => 'c_name', 'dt' => 1),
            array(
                'db'        => 'c_desc', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array(
                'db'        => 'c_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['cash_vids_id'] . '" data-id="' . $row['cash_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['cash_vids_id'] . '" data-id="' . $row['cash_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array(
                'db' => 'cash_vids_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return '<a class="btn btn-success btn-xs" title="گردش حساب"
                                                   href="'.ADMIN_PATH.'/cash/transactions/' . $row['cash_vids_id'] . '">
                                                    <i class="fa fa-money"></i>
                                                </a>
                                                <a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/cash/edit/' . $row['cash_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['cash_vids_id'] . '"
                                                        data-id="' . $row['cash_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT c.* FROM tbl_cash c  $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(cash_vids_id) FROM tbl_cash c $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(cash_vids_id) FROM tbl_cash");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusCash($post)
    {
        try {
            $this->doQuery("UPDATE tbl_cash SET c_status=(case when c_status=1 then 0 else 1 end) WHERE cash_vids_id=?", array($post['id']));
            $result = $this->doSelect("SELECT c_status,c_name FROM tbl_cash WHERE cash_vids_id=?", array($post['id']), 1);

            if ($result['c_status'] == 1) {
                $this->ActivityLog("فعالسازی " . $result['c_name'] . " در بخش صندوق ها");
                $this->response_success("صندوق ".$result['c_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی " . $result['c_name'] . " در بخش صندوق ها");
                $this->response_success("صندوق ".$result['name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delCash($post)
    {
        try {
            $result = $this->doSelect("SELECT c_name FROM tbl_cash WHERE cash_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_cash WHERE cash_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['c_name'] . " از لیست صندوق ها");
                $this->response_success("صندوق ".$result['0']['c_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("دسته بندی مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetCash($id)
    {
        $result = $this->doSelect("SELECT cash_vids_id FROM tbl_cash WHERE cash_vids_id= ?",  array($id));
        return $result;
    }

    function getCashInfo($attrId = '')
    {
        if ($attrId != '') {
            $sql = "SELECT * FROM tbl_cash WHERE c_status=1 AND cash_vids_id=?";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT * FROM tbl_cash WHERE c_status=1";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function editCash($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_cash WHERE cash_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("صندوق مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_cash SET c_name=?, c_currency=?, c_current_balance=?, c_desc=? WHERE cash_vids_id=?";
                $params = [$post['name'], $post['curreny'], $post['current_balance'], $post['desc'], $post['id']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات صندوق " . $post['name']);
                $this->response_success("اطلاعات صندوق ".$post['name']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addpettyCash($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_pettyCash WHERE p_name=?", array($post['name']));

            if (sizeof($result) > 0) {
                $this->response_warning("تنخواه گردان دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $vids = $this->getLastId("pettyCash");

                $sql = "INSERT INTO tbl_pettyCash (pettyCash_vids_id, p_name, p_currency, p_desc, p_date, p_status) VALUES (?,?,?,?,?,?)";
                $params = array($vids, $post['name'], $post['curreny'], $post['desc'], $this->jalali_date("Y/m/d"), 1);
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['name'] . " در بخش تنخواه گردان");
                $this->updateLastId("pettyCash");

                $this->response_success("تنخواه گردان ".$post['name']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getpettyCashAjax($get)
    {
        $columns = array(
            array('db' => 'pettyCash_vids_id', 'dt' => 0),
            array('db' => 'p_name', 'dt' => 1),
            array(
                'db' => 'p_currency', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $sql = "SELECT c_name, c_short_name FROM tbl_currency WHERE c_id=?";
                    $result = $this->doSelect($sql, array($d), 1);
                    return $result['c_name']. " - " . $result['c_short_name'];
                }
            ),
            array(
                'db'        => 'p_desc', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return $d == "" ? '-' : $d;
                }
            ),
            array(
                'db'        => 'p_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    return $d == 1 ? '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pettyCash_vids_id'] . '" data-id="' . $row['pettyCash_vids_id'] . '" class="btn btn-success btn-xs">فعال</button>' : '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pettyCash_vids_id'] . '" data-id="' . $row['pettyCash_vids_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                }
            ),
            array(
                'db' => 'pettyCash_vids_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    return '<a class="btn btn-warning btn-xs"
                                                   href="'.ADMIN_PATH.'/pettyCash/edit/' . $row['pettyCash_vids_id'] . '">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['pettyCash_vids_id'] . '"
                                                        data-id="' . $row['pettyCash_vids_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT c.* FROM tbl_pettyCash c  $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(pettyCash_vids_id) FROM tbl_pettyCash c $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(pettyCash_vids_id) FROM tbl_pettyCash");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statuspettyCash($post)
    {
        try {
            $this->doQuery("UPDATE tbl_pettyCash SET p_status=(case when p_status=1 then 0 else 1 end) WHERE pettyCash_vids_id=?", array($post['id']));
            $result = $this->doSelect("SELECT p_status,p_name FROM tbl_pettyCash WHERE pettyCash_vids_id=?", array($post['id']), 1);

            if ($result['p_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت " . $result['p_name'] . " در بخش تنخواه گردان ها");
                $this->response_success("تنخواه گردان ".$result['p_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت " . $result['p_name'] . " در بخش تنخواه گردان ها");
                $this->response_success("تنخواه گردان ".$result['p_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delpettyCash($post)
    {
        try {
            $result = $this->doSelect("SELECT p_name FROM tbl_pettyCash WHERE pettyCash_vids_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_pettyCash WHERE pettyCash_vids_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['p_name'] . " از لیست تنخواه گردان ها");
                $this->response_success("تنخواه گردان ".$result['0']['p_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("تنخواه گردان مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetpettyCash($id)
    {
        $result = $this->doSelect("SELECT pettyCash_vids_id FROM tbl_pettyCash WHERE pettyCash_vids_id= ?", array($id));
        return $result;
    }

    function getpettyCashInfo($attrId = '')
    {
        if ($attrId != '') {
            $sql = "SELECT * FROM tbl_pettyCash WHERE pettyCash_vids_id=?";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT * FROM tbl_pettyCash";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

    function editpettyCash($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_pettyCash WHERE pettyCash_vids_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("تنخواه گردان مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_pettyCash SET p_name=?, p_currency=?, p_desc=? WHERE pettyCash_vids_id=?";
                $params = array($post['name'], $post['curreny'], $post['desc'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات " . $post['name'] . " در بخش تنخواه گردان");
                $this->response_success("اطلاعات تنخواه گردان ".$post['name']." با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getCreditInfo()
    {
        $res = 0;
        if($this->getPublicInfo('sms_status') == 1) {
            $sms_api_key = $this->getPublicInfo('sms_api_key');
            $sms_secret_key = $this->getPublicInfo('sms_secret_key');
            $sms_site = $this->getPublicInfo('sms_site');

            if($sms_api_key!=""){
                if($sms_site == "faraz") {
                    $url = "https://ippanel.com/services.jspd";
                    $param = array
                    (
                        'uname'=> $sms_api_key,
                        'pass'=> $sms_secret_key,
                        'op'=> 'credit'
                    );

                    $handler = curl_init($url);
                    curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
                    curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                    $response2 = curl_exec($handler);
                    $response2 = json_decode($response2);
                    $res_code = $response2[0];

                    if($response2[1] != "the username or password is incorrect") {
                        $res = $response2[1];
                    }
                } else if($sms_site == "sms_ir") {
                    if($this->getPublicInfo('sms_secret_key') !="") {
                        $SmsIR_GetCredit = new SmsIR_GetCredit($sms_api_key, $sms_secret_key);
                        $GetCredit = $SmsIR_GetCredit->GetCredit();

                        if($GetCredit != "شما هر 30 ثانیه مجاز به ارسال 1 درخواست میباشید") {
                            $res = $GetCredit;
                        }
                    } else {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.sms.ir/v1/credit',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'x-api-key: '.$sms_api_key
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $response = json_decode($response, true);
                        if($response['status'] == "1") {
                            $res = $response['data'];
                        }
                    }
                }
            }
        }

        return $res;
    }

}
