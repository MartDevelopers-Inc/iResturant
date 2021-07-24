<?php
/*
 * Created on Sat Jul 24 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
require_once('../config/config.php');
require_once('../partials/analytics.php');
/* Load Default Currency */
$ret = "SELECT * FROM `iResturant_Currencies` WHERE status = 'Active'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($currency = $res->fetch_object()) {
?>
    <script>
        var options = {
            chart: {
                height: 320,
                type: "area",
                stacked: !0,
                toolbar: {
                    show: !1,
                    autoSelected: "zoom"
                }
            },
            colors: ["#2a77f4", "#a5c2f1"],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: [1.5, 1.5],
                dashArray: [0, 4],
                lineCap: "round"
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                },
                strokeDashArray: 3
            },
            markers: {
                size: 0,
                hover: {
                    size: 0
                }
            },
            series: [{
                name: "New Visits",
                data: [0, 60, 20, 90, 45, 110, 55, 130, 44, 110, 75, 120]
            }, {
                name: "Unique Visits",
                data: [0, 45, 10, 75, 35, 94, 40, 115, 30, 105, 65, 110]
            }],
            xaxis: {
                type: "month",
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisBorder: {
                    show: !0
                },
                axisTicks: {
                    show: !0
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: .4,
                    opacityTo: .3,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                }
            },
            legend: {
                position: "top",
                horizontalAlign: "right"
            }
        };

        (chart = new ApexCharts(document.querySelector("#ana_dash_1"), options)).render();
        options = {
            chart: {
                height: 270,
                type: "donut"
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "85%"
                    }
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !0,
                width: 2,
                colors: ["transparent"]
            },
            series: [<?php echo $revenue; ?>, <?php echo $expenses; ?>],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "13px",
                offsetX: 0,
                offsetY: 0
            },
            labels: ["Revenue", "Expenses"],
            colors: ["#2a76f4", "rgba(42, 118, 244, .5)"],
            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        donut: {
                            customScale: .2
                        }
                    },
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }],
            tooltip: {
                y: {
                    formatter: function(o) {
                        return "<?php echo $currency->code; ?> "  + o
                    }
                }
            }
        };

        (chart = new ApexCharts(document.querySelector("#ana_device"), options)).render();
    </script>
<?php
} ?>