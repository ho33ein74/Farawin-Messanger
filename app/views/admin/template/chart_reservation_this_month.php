<?php
if ($check_admin_permission) {
    $keys_order = array_keys($getReservationStatOrder);
    $values_order = array_values($getReservationStatOrder);
    $values_order = implode(',', $values_order);
} else {
    $keys_order = "";
    $values_order = "";
}
?>

<div data-intro="<?= $help['t_help_txt'] ?>" class="box box-warning">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="chart">
                    <div id="mainReservation" style="height:350px;"></div>
                </div>
                <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- ./box-body -->
    <?php if (!$check_admin_permission) { ?>
        <div class="overlay" style="background: rgba(255,255,255,.8);">
            <p style="display: flex;justify-content: center;align-items: center;height: 100%;">متاسفانه به اطلاعات این بخش دسترسی ندارید</p>
        </div>
    <?php } ?>
</div>

<script src="public/panel/plugins/echarts/dist/echarts.min.js"></script>
<script type="text/javascript">
    window.onload = LineChartOrder();

    function LineChartOrder() {
        var theme = {
            textStyle: {
                fontFamily: 'iranyekanwebmediumfanum, sans-serif'
            }
        }
        var myChart = echarts.init(document.getElementById('mainReservation'), theme);
        myChart.setOption({
            title: {
                x: 'center',
                y: 'top',
                padding: [10, 0, 20, 0],
                text: 'نوبت های رزرو شده در <?= jdate("F") ?> ماه',
                textStyle: {
                    fontSize: 14,
                    fontWeight: 'normal'
                }
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                y: 'top',
                feature: {
                    magicType: {
                        show: true,
                        title: {
                            line: '',
                            bar: ''
                        },
                        type: ['line', 'bar']
                    },
                    saveAsImage: {
                        show: true,
                        title: ' '
                    }
                }
            },
            calculable: true,
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                data: ['تعداد نوبت'],
                y: 'bottom'
            },
            xAxis: [{
                type: 'category',
                data: [<?php foreach ($keys_order as $date) {
                    echo "'$date',";
                } ?>]
            }],
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: [
                {
                    name: 'تعداد نوبت',
                    type: 'bar',
                    data: [<?= $values_order ?>]
                }
            ]
        });
    }
</script>