<?php
foreach (glob("app/controllers/admin/*.php") as $filename) {
    require_once $filename;
}

class admin extends Controller
{
    use accountingTrait;
    use blogTrait;
    use calendarTrait;
    use categoryTrait;
    use discountTrait;
    use faqTrait;
    use loginTrait;
    use rtlThemeTrait;
    use servicesTrait;
    use settingTrait;
    use statsTrait;
    use statusesTrait;
    use storeroomTrait;
    use supportTrait;
    use tagsTrait;
    use usersTrait;
    use viewsTrait;

    public $checkLoginAdmin = '';

    function __construct()
    {
        parent::__construct();
        $this->checkLoginAdmin = Model::decrypt(Model::cookie_get('adminId'), KEY);

        if ($_GET['url'] != ADMIN_PATH . "/login") {
            if ($_GET['url'] != ADMIN_PATH . "/forgetPassword") {
                if ($_GET['url'] != ADMIN_PATH . "/loginCheck") {
                    if ($_GET['url'] != ADMIN_PATH . "/authCheck") {
                        if ($_GET['url'] != ADMIN_PATH . "/forgetPasswordSendSMS") {
                            if ($_GET['url'] != ADMIN_PATH . "/logout") {
                                if ($this->checkLoginAdmin == FALSE) {
                                    header("Location:" . URL . ADMIN_PATH . "/login");
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function noCache()
    {
        $this->view('admin/noCache');
    }

    function noaccess($text = "متاسفانه شما به این بخش دسترسی ندارید.")
    {
        $data = array('text' => $text);
        $this->view('admin/noaccess', $data);
    }

    function index()
    {
        if ($this->checkLoginAdmin != FALSE) {
            $this->view('admin/notfound');
        } else {
            $this->view('notfound/index');
        }
    }

    function dashboard()
    {
        $admin_permission = $this->model->admin_permission_check("dashboard_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $getDashboardItems = $this->model->getDashboardItems($this->checkLoginAdmin);

            $data = array('dashboardItems' => $getDashboardItems);
            $this->view('admin/index', $data);
        } else {
            $this->noaccess();
        }
    }
}
