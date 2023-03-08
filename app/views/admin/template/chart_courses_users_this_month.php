<?php
if ($check_admin_permission) {
    $keys_order_sale = array_keys($orderStatOrderSale);
    $values_order_sale = array_values($orderStatOrderSale);
    $values_order_sale = implode(',', $values_order_sale);
} else {
    $values_order_sale = "";
    $values_order_sale = "";
}
?>

<div data-intro="<?= $help['t_help_txt'] ?>" class="box box-success">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="chart">
                    <div id="mainOrderSale" style="height:350px;"></div>
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
    window.onload = LineChartOrderSale();

    function LineChartOrderSale() {
        var theme = {
            textStyle: {
                fontFamily: 'iranyekanwebmediumfanum, sans-serif'
            }
        }
        var myChartSale = echarts.init(document.getElementById('mainOrderSale'), theme);

        myChartSale.setOption({
            title: {
                x: 'center',
                y: 'top',
                padding: [10, 0, 20, 0],
                text: 'شرکت کنندگان دوره های ثبت شده در <?= jdate("F") ?> ماه',
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
                data: ['تعداد شرکت کننده'],
                y: 'bottom'
            },
            xAxis: [{
                type: 'category',
                data: [<?php foreach ($keys_order_sale as $date) {
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
                    name: 'تعداد شرکت کننده',
                    type: 'bar',
                    data: [<?= $values_order_sale ?>]
                }
            ]
        });
    }
</script>