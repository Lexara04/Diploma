<?php
    use \koolreport\widgets\google\DonutChart;

    $category_amount = array(
        array("category"=>"Принято","cost"=>20000,),
        array("category"=>"Отклонено","cost"=>36000),
    );
?>
<div class="report-content w-50">
    <div style="margin:50px;">
    <?php
    DonutChart::create(array(
        "title"=>"",
        "dataSource"=>$category_amount,
        "columns"=>array(
            "category",
            "cost"=>array(
                "type"=>"number",
                "prefix"=>"$",
            )
        ),
        "colorScheme"=>array(
            "#2f4454",
            "#2e1518",
            "#da7b93",
            "#376e6f",
            "#1c3334"
        )
    ));
    ?>
    </div>
</div>
