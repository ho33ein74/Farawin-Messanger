<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            <img src="<?= $data['infoAdmin'][0]['a_image']; ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';"
                 class="img-circle" alt="<?= $data['infoAdmin'][0]['a_name']; ?>">
            <img src="public/images/user-default-image.jpg" style="display:none">
        </div>
        <div class="pull-right info">
            <p><?= $data['infoAdmin'][0]['a_name']; ?></p>
            <a id="statusUser"><i class="fa fa-circle text-success"></i>آنلاین</a>
        </div>
    </div>
    <form action="#" onsubmit="return false;" class="sidebar-form">
        <div class="input-group">
            <input type="text" class="form-control search-menu-box" autocomplete="off" placeholder="جستجو">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

        <li class="hidden-xs treeview">
            <a href="javascript:void(0);" onclick="javascript:introJs().setOptions({'showBullets': true, 'showProgress': true, 'nextLabel': 'بعد', 'prevLabel': 'قبل', 'doneLabel': 'اتمام' }).start();">
                <i class="fa fa-mortar-board fa-fw"></i><span>راهنما</span>
            </a>
        </li>

        <?php function displaySidebar($list, $publicData) { ?>
            <?php foreach($list as $item) { ?>
                <li class="treeview">
                    <a style="cursor: pointer" <?= $item["s_link"] != "-" ? "href=".ADMIN_PATH."/".$item["s_link"]:"" ?>>
                        <i class="fa <?= $item["s_icon"]; ?> fa-fw"></i>
                        <span><?= $item["s_name"]; ?></span>

                        <?php if ($item["s_counter_num"] == "1") { ?>
                            <?php
                            $parameters = explode("#", $item['s_counter_num_type']);
                            $counterShow = 0;
                            foreach ($parameters as $parameter){
                                if($parameter!=NULL) {
                                    $counterShow += $publicData["$parameter"][0]['num'];
                                }
                            }
                            ?>
                            <?php if($counterShow>0){ ?>
                                <small class="label pull-left bg-green" style="padding: .4em .6em .1em;<?= array_key_exists("children", $item) ? "margin-left: 15px":"" ?>">
                                    <?= $counterShow; ?>
                                </small>
                            <?php } ?>
                        <?php } ?>

                        <?php if (array_key_exists("children", $item)){ ?>
                            <i class="fa fa-angle-left pull-right"></i>
                        <?php } ?>
                    </a>

                    <?php if (array_key_exists("children", $item)){ ?>
                        <ul class="treeview-menu">
                            <?php displaySidebar($item["children"], $publicData); ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
        <?php } ?>

        <?= displaySidebar($data['sidebarMenu'], $data['publicData']); ?>
    </ul>
</section>
