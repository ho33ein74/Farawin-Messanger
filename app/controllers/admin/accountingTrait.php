<?php

trait accountingTrait
{
    function accounting($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("account_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/accounting/accounting');
        } else {
            $this->noaccess();
        }
    }

    function payment($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("payment_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $cashInfo = $this->model->getCashInfo();
                $data = array('cashInfo' => $cashInfo);
                $this->view('admin/accounting/payment-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("payment_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetPayment($attrId);
                if (sizeof($id_isset) > 0) {
                    $getPaymentLog = $this->model->getPaymentLog($attrId, NULL);
                    $cashInfo = $this->model->getCashInfo();
                    $bankInfo = $this->model->getBankInfo();

                    $data = array(
                        'PaymentLog' => $getPaymentLog,
                        'attrId' => $attrId,
                        'id' => $this->checkLoginAdmin,
                        'cashInfo' => $cashInfo,
                        'bankInfo' => $bankInfo
                    );
                    $this->view('admin/accounting/payment-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("payment_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/accounting/paymentLog');
            } else {
                $this->noaccess();
            }
        }
    }

    function cost($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("cost_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getCostType = $this->model->getCostType();
                $cashInfo = $this->model->getCashInfo();
                $data = array('costType' => $getCostType, 'cashInfo' => $cashInfo);
                $this->view('admin/accounting/cost-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("cost_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetCost($attrId);
                if (sizeof($id_isset) > 0) {
                    $getCostType = $this->model->getCostType();
                    $getCostLog = $this->model->getCostLog($attrId);
                    $data = array('CostLog' => $getCostLog, 'attrId' => $attrId, 'costType' => $getCostType);
                    $this->view('admin/accounting/cost-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("cost_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getCostType = $this->model->getCostType();
                $data = array('costType' => $getCostType);
                $this->view('admin/accounting/costLog', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getAccountingAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getAccountingAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getPaymentAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getPaymentAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getAccountsTransactionsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_transactions_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getAccountsTransactionsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getCashTransactionsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_transactions_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCashTransactionsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getCostAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCostAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function accounts($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("account_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $currency = $this->model->getCurrency();
                $data = array('currency' => $currency);
                $this->view('admin/accounting/account-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("account_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetBank($attrId);
                if (sizeof($id_isset) > 0) {
                    $getBankInfo = $this->model->getBankInfo($attrId);
                    $currency = $this->model->getCurrency();
                    $data = array('bankInfo' => $getBankInfo, 'attrId' => $attrId, 'currency' => $currency);
                    $this->view('admin/accounting/account-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "transactions") {
            $admin_permission = $this->model->admin_permission_check("account_transactions_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $data = array('attrId' => $attrId);
                $this->view('admin/accounting/account-transactions', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("account_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/accounting/account');
            } else {
                $this->noaccess();
            }
        }
    }

    function addAccount()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addAccount($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editAccount()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editAccount($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getAccountAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getAccountAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delAccount()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delAccount($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusAccount()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("account_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusAccount($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getPaymentType()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getPaymentType($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addPayment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addPayment($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCost()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCost($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editPayment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editPayment($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function deleteImgPayment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->deleteImgPayment($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editCost()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editCost($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function cash($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("cash_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $currency = $this->model->getCurrency();
                $data = array('currency' => $currency);
                $this->view('admin/accounting/cash-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetCash($attrId);
                if (sizeof($id_isset) > 0) {
                    $getCashInfo = $this->model->getCashInfo($attrId);
                    $currency = $this->model->getCurrency();
                    $data = array('cashInfo' => $getCashInfo, 'attrId' => $attrId, 'currency' => $currency);
                    $this->view('admin/accounting/cash-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "transactions") {
            $admin_permission = $this->model->admin_permission_check("cash_transactions_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $data = array('attrId' => $attrId);
                $this->view('admin/accounting/cash-transactions', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("cash_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/accounting/cash');
            } else {
                $this->noaccess();
            }
        }
    }

    function getCashAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCashAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function pettyCash($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("petty_cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetpettyCash($attrId);
                if (sizeof($id_isset) > 0) {
                    $getpettyCashInfo = $this->model->getpettyCashInfo($attrId);
                    $currency = $this->model->getCurrency();
                    $data = array('pettyCashInfo' => $getpettyCashInfo, 'attrId' => $attrId, 'currency' => $currency);
                    $this->view('admin/accounting/pettyCash-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("petty_cash_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $currency = $this->model->getCurrency();
                $data = array('currency' => $currency);
                $this->view('admin/accounting/pettyCash', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getpettyCashAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("petty_cash_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getpettyCashAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statuspettyCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("petty_cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statuspettyCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delpettyCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("petty_cash_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delpettyCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addpettyCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("petty_cash_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addpettyCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editpettyCash()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("petty_cash_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editpettyCash($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function costCategory($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("cost_category_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $costCategoryInfoEdit = $this->model->getCostCategoryInfoEdit($attrId);
                $data = array('costCategory' => $costCategoryInfoEdit, 'attrId' => $attrId);
                $this->view('admin/accounting/costCategory-edit', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("cost_category_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/accounting/costCategory');
            } else {
                $this->noaccess();
            }
        }
    }

    function getCostCategoryAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_category_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCostCategoryAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCostCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_category_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCostCategory($_POST['name']);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editCostCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_category_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editCostCategory($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCost()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_category_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCost($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delPayment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("payment_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delPayment($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCostCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("cost_category_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCostCategory($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusSettlementSold()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_staff_status_payment_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusSettlementSold($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
