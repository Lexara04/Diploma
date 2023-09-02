
<?php
use \koolreport\widgets\koolphp\Card;
use \koolreport\widgets\google\DonutChart;
use \koolreport\widgets\google\BarChart;
require($_SERVER["DOCUMENT_ROOT"]."/novyy-razdel/get_data.php");

global $allVac;
global $allVacPrev;
global $allComp;
global $allStud;
global $allReq;
global $card;

$proj_per_year = array(
    array("year" => "2023", "projects" => 80, "practices" => 90,),
    array("year" => "2024", "projects" => 90, "practices" => 100,),
    array("year" => "2025", "projects" => 100, "practices" => 110,),
    array("year" => "2026", "projects" => 110, "practices" => 120,),
);

?>
<script>


    function allYearsBtnClick(){
        const allYearsBtn = document.getElementById('all') ;
        const currentYearBtn = document.getElementById('cur');
        const currentMonthBtn = document.getElementById('mon');
        allYearsBtn.className = 'btn btn-outline-dark active';
        currentYearBtn.className = 'btn btn-outline-dark';
        currentMonthBtn.className = 'btn btn-outline-dark';
        handleClick('all_years');
    }
    function currentYearBtnClick(){
        const allYearsBtn = document.getElementById('all') ;
        const currentYearBtn = document.getElementById('cur');
        const currentMonthBtn = document.getElementById('mon');
        currentYearBtn.className = 'btn btn-outline-dark active';
        allYearsBtn.className = 'btn btn-outline-dark';
        currentMonthBtn.className = 'btn btn-outline-dark';
        reload_chart();
    }
    function currentMonthBtnClick(){
        const allYearsBtn = document.getElementById('all') ;
        const currentYearBtn = document.getElementById('cur');
        const currentMonthBtn = document.getElementById('mon');
        currentMonthBtn.className = 'btn btn-outline-dark active';
        allYearsBtn.className = 'btn btn-outline-dark';
        currentYearBtn.className = 'btn btn-outline-dark';
        handleClick('current_month');
    }
    function reload_chart() {
        // отправляем AJAX запрос на файл "update_data.php"
        $.ajax({
            url: "update_data.php",
            success: function(data) { // при получении новых данных
                var new_data = JSON.parse(data); // парсим JSON
                // обновляем DataSource графика
                $("#chart").data("koolreport").settings.dataSource = new_data;
                // перерисовываем график
                $("#chart").data("koolreport").render();
            }
        });
    }
    function handleClick(mode) {

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.querySelector('#my-card').innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', 'ajax_handler.php?mode=' + mode , true);
        xhr.send();
    }

</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(
            JSON.parse('<?php echo $json; ?>')
        );

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<div  ></div>
<div class="report-content mb-5">
    <div class="row align-items-start">
        <div class="col-md-3">
<?Card::create(array(
    "value" => $allVac,
    "baseValue" => $allVacPrev,
    "title" => "ПРЕДЛОЖЕНИЙ",
    "subtitle" => "было опубликовано",
    "format" => array(
        "value" => array(
            "thounsandSeparator" => ".",
        ),
        "indicator" => array(
            "prefix" => "+",
            "suffix" => " за последний месяц",
            "decimals" => 0,
            "thounsandSeparator" => ".",

        )
    ),
    "indicator" => function ($value, $baseValue) {
        return $value - $baseValue;
    },
    "cssClass" => array(
        "card" => "bg-info",
        "title" => "text-white",
        "value" => "text-white",
        "indicator" => "text-white",
        "subtitle" => "text-white"
    ),
    "cssStyle" => array(
        "indicator" => "font-size:16px",
        "subtitle" => "font-size:14px; text-align: center",
    )
));?>
        </div>
        <div class="col-md-3" id="chart">
            <?php
            Card::create(array(
                "value" => $allComp,
                "title" => "КОМПАНИЙ",
                "subtitle" => "приняло участие",
                "cssClass" => array(
                    "card" => "bg-warning",
                    "title" => "text-white",
                    "value" => "text-white",
                    "subtitle" => "text-white"
                ),
                "cssStyle" => array(
                    "indicator" => "font-size:16px",
                    "subtitle" => "font-size:14px; text-align: center",
                ),
                "format" => array(
                    "value" => array(
                        "thounsandSeparator" => ".",
                    ),
                    "indicator" => array(
                        "prefix" => "+",
                        "suffix" => "",
                        "decimals" => 0,
                        "thounsandSeparator" => ".",
                    )
                ),
                "indicator" => function ($value, $baseValue) {
                    return $value - $baseValue;
                },
            ));
            ?>
        </div>
        <div class="col-md-3">
            <?php
            Card::create(array(
                "value" => $allStud,
                "title" => "СТУДЕНТОВ",
                "subtitle" => "зарегистрировалось на сайте",
                "cssClass" => array(
                    "card" => "bg-success",
                    "title" => "text-white",
                    "value" => "text-white",
                    "subtitle" => "text-white"
                ),
                "cssStyle" => array(
                    "indicator" => "font-size:16px",
                    "subtitle" => "font-size:14px; text-align: center",
                ),
                "format" => array(
                    "value" => array(
                        "thounsandSeparator" => ".",
                    ),
                    "indicator" => array(
                        "prefix" => "+",
                        "suffix" => "",
                        "decimals" => 0,
                        "thounsandSeparator" => ".",
                    )
                ),
                "indicator" => function ($value, $baseValue) {
                    return $value - $baseValue;
                },
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            Card::create(array(
                "value" => $allReq,
                "title" => "ЗАЯВОК",
                "subtitle" => "было подано",
                "format" => array(
                    "value" => array(
                        "thounsandSeparator" => ".",
                    ),
                    "indicator" => array(
                        "prefix" => "+",
                        "suffix" => "",
                        "decimals" => 0,
                        "thounsandSeparator" => " ",
                    )
                ),
                "indicator" => function ($value, $baseValue) {
                    return $value - $baseValue;
                },
                "cssClass" => array(
                    "card" => "bg-danger",
                    "title" => "text-white",
                    "value" => "text-white",
                    "subtitle" => "text-white"
                )
            ));
            ?>
        </div>
    </div>
    <br>
    <div class="btn-group w-25" role="group">
        <button type="button" class="btn btn-outline-dark active" onclick="allYearsBtnClick()" id="all">Все года</button>
        <button type="button" class="btn btn-outline-dark" onclick="currentYearBtnClick() " id="cur">Текущий год</button>
        <button type="button" class="btn btn-outline-dark" onclick="currentMonthBtnClick()" id="mon">Текущий месяц</button>
    </div>
    <div class="row align-items-start mt-3">

        <div class="col-md-3">
            <div>
                <?php
                DonutChart::create(array(
                        "title" => "Принятые заявки",
                        "dataSource" => $category_amount,
                        "colorScheme" => array(
                            "#ADBD37",
                            "#588133",
                            "grey"
                        ),
                        "options" => array(
                            "pieHole" => 0.2,
                            "slices" => array(
                                "0" => array("offset" => 0.2),
                                "2" => array("offset" => 0.2)
                            ),
                            "legend" => array("position" => "bottom",
                                "textStyle" => array("fontSize" => 14)
                            ),
                            "fontSize" => 16,
                            "is3D" => true
                        ),
                        "columns" => array(
                            "category",
                            "cost" => array(
                                "type" => "number",
                            )
                        )
                    )
                )
                ?>
            </div>
        </div>
        <div class="col-md-9">
            <!--<div id="barchart_material" style="height: 400px;"></div>-->
            <?php
            BarChart::create(array(
                "title" => "Предложения за период",
                "dataSource" => $proj_per_week,
                "columns" => array(
                    "year",
                    "projects" => array("label" => "Проекты", "type" => "number",),
                    "practices" => array("label" => "Практики", "type" => "number",)
                ),
                "colorScheme" => array(
                    "#67819D",
                    "#4F5060",
                )
            ));
            ?>
        </div>
    </div>
</div>