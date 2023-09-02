<?php

class MyReport extends \koolreport\KoolReport
{
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>"mysql:host=sampledb.koolreport.com;dbname=automaker",
                    "username"=>"expusr",
                    "password"=>"koolreport sampledb",
                    "charset"=>"utf8"
                ),
            )
        );
    }
}