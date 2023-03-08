<div data-intro="<?= $help['t_help_txt'] ?>" class="box">
    <div class="box-header with-border">
        <h3 class="box-title">آخرین فعالیت های شما</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->

    <?php if (sizeof($latestActivity) > 0) { ?>
        <div class="box-body direction">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th style="text-align: center;width: 30px;">ردیف</th>
                        <th style="text-align: center;">فعالیت</th>
                        <th style="text-align: center;">زمان انجام</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i=1;
                    foreach ($latestActivity as $activity_data) {
                        $date = explode(" ", $activity_data['log_time']);
                        $newDate = $date['1'] . " - " . Model::MiladiTojalili_2no($date['0'], "-");
                        ?>
                        <tr>
                            <td>
                                <p><?= $i; ?></p>
                            </td>
                            <td>
                                <p title="<?= $activity_data['activity']; ?>"><?= $activity_data['activity']; ?></p>
                            </td>
                            <td style="text-align: center;vertical-align: middle">
                                <?= $newDate; ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
    <?php } else { ?>
        <div class="text-center" style="padding-bottom: 10px !important;padding-top: 10px !important;direction: rtl">
            متاسفانه در حال حاضر فعالتی ثبت نشده است!
        </div>
    <?php } ?>
    <!-- /.box-footer -->
</div>