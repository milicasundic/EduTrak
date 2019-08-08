<?php

require_once __DIR__ . '/../../core/ini.php';

$user = new User();
$requests = new Request(Input::get('requestID'));
$log = new ActivityLog();

if($user->isLoggedIn()) {
    if (Input::exists()) {

        try{

            $requests->update([
                'quoteTitle' => Input::get('quoteTitle'),
            ], Input::get('requestID'));

            $date = new DateTime('now', new DateTimeZone('America/New_York'));
            $date->setTimezone(new DateTimeZone('UTC'));

            $log->create([
                'userID' => $user->data()->id,
                'caseName' => $requests->data()->customerID ? 'customer' : 'lead',
                'caseID' => $requests->data()->customerID ? $requests->data()->customerID : $requests->data()->leadID,
                'section' => 'quote',
                'time' => $date->format('Y-m-d G:i:s'),
                'text' => 'updated quote for request - '.$requests->data()->ID.'.'
            ]);

        }catch (Exception $e){
            die($e->getMessage());
        }

    }
}