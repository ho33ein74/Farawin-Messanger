<?php if($help['t_description'] != NULL){ ?>
    <div class="box box-default">
        <?php if($help['t_show_title']){ ?>
        <div class="box-header with-border">
            <h3 class="box-title"><?= $help['t_title'] ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <?php } ?>
        <div class="box-body" style="direction: rtl;text-align: right">
            <?= $help['t_description'] ?>
        </div>
    </div>
<?php } ?>