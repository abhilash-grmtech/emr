<?php

namespace App\Http\Controllers;

use App\Bmi;
use Illuminate\Http\Request;
use DB;
use Predis\Autoloader;
\Predis\Autoloader::register();

class BmiController extends Controller
{
    public function get_all_temporal_bmis($pPtUuid)
    {
        $bmiQueryResultObj = DB::select(DB::raw('SELECT *, round(UNIX_TIMESTAMP(ROW_START) * 1000) as ROW_START, round(UNIX_TIMESTAMP(ROW_END) * 1000) as ROW_END, trim((UNIX_TIMESTAMP(timeOfMeasurementInMilliSecs) * 1000))+0 as timeOfMeasurementInMilliSecs FROM sc_vital_signs.bmi FOR SYSTEM_TIME ALL where ptUuid = "'.$pPtUuid.'" order by ROW_START desc'));

        return response()->json($bmiQueryResultObj);
    }

    public function get_one_bmi($pServerSideRowUuid)
    {
        $bmiQueryResultObj = DB::select(DB::raw("SELECT *, round(UNIX_TIMESTAMP(ROW_START) * 1000) as ROW_START, round(UNIX_TIMESTAMP(ROW_END) * 1000) as ROW_END, UNIX_TIMESTAMP(timeOfMeasurementInMilliSecs) * 1000 as timeOfMeasurementInMilliSecs FROM sc_vital_signs.bmi FOR SYSTEM_TIME ALL WHERE serverSideRowUuid LIKE '{$pServerSideRowUuid}' order by ROW_START desc"));

        return response()->json($bmiQueryResultObj);
    }

    public function create(Request $pRequest)
    {
        $requestData = $pRequest->all();

        $serverSideRowUuid = $requestData['data']['serverSideRowUuid'];
        $ptUuid = $requestData['data']['ptUuid'];
        $timeOfMeasurementInMilliSecs = (int)($requestData['data']['timeOfMeasurementInMilliSecs']);
        $bmiInKgM2 = $requestData['data']['bmiInKgM2'];
        $notes = $requestData['data']['notes'];
        $recordChangedByUuid = $requestData['data']['recordChangedByUuid'];
        $recordChangedFromIPAddress = $this->get_client_ip();

        $insertBmi = DB::statement("INSERT INTO `sc_vital_signs`.`bmi` (`serverSideRowUuid`, `ptUuid`, `bmiInKgM2`, `timeOfMeasurementInMilliSecs`, `notes`, `recordChangedByUuid`, `recordChangedFromIPAddress`) VALUES ('{$serverSideRowUuid}', '{$ptUuid}', {$bmiInKgM2}, FROM_UNIXTIME({$timeOfMeasurementInMilliSecs}/1000), '{$notes}', '{$recordChangedByUuid}', '{$recordChangedFromIPAddress}')");

        return response()->json($insertBmi, 201);
    }

    public function update($pServerSideRowUuid, Request $pRequest)
    {
        $requestData = $pRequest->all();

        $timeOfMeasurementInMilliSecs = (int)($requestData['rowToUpsert']['timeOfMeasurementInMilliSecs']);
        $bmiInKgM2 = $requestData['rowToUpsert']['bmiInKgM2'];
        $notes = $requestData['rowToUpsert']['notes'];
        $recordChangedByUuid = $requestData['rowToUpsert']['recordChangedByUuid'];
        $recordChangedFromIPAddress = $this->get_client_ip();

        $updateBmi = DB::statement("UPDATE `sc_vital_signs`.`bmi` SET `bmiInKgM2` = {$bmiInKgM2}, `timeOfMeasurementInMilliSecs` = FROM_UNIXTIME({$timeOfMeasurementInMilliSecs}/1000), `notes` = '{$notes}', `recordChangedByUuid` = '{$recordChangedByUuid}', `recordChangedFromIPAddress` = '{$recordChangedFromIPAddress}' WHERE `bmi`.`serverSideRowUuid` = '{$pServerSideRowUuid}'");

        return response()->json($updateBmi, 200);
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
