<?php

require_once __DIR__ . '/core/ini.php';

if(Input::get('id')) {

    $user = new User(Input::get('user'));

    $customer = null;
    $lead = null;

    if(Input::get('case') === 'customer'){
        $customer = New Customer(Input::get('id'));
    }else{
        $lead = New Lead(Input::get('id'));
    }


    $data = Input::get('data');

    $quote = new ProposalAndQuotes();
    $id = date('ymdhis');

    try{

        $quote->create([
            'ID' => (int) $id,
            'title' => Input::get('title'),
            'type' => 'proposal',
            'customerID' =>  $customer ? (int) $customer->data()->id : null,
            'leadID' => $lead != null ? (int) $lead->data()->id : null,
            'userID' => (int) $user->data()->id,
            'introduction' => Input::get('introduction'),
            'requiredInvestment' => Input::get('requiredInvestment'),
            'dateCreated' => date("m/d/Y")
        ]);

        $count = 0;

        foreach ($data as $workshop){

            $quote->createDetails([
                'ID' => date('ymdhis') + $count,
                'proposalQuoteID' => $id,
                'workshopTitle' => $workshop['title'],
                'workshopDescription' => $workshop['description'],
                'workshopLearnerOutcomes' => $workshop['learnerOutcomes'],
                'workshopPrerequisites' => $workshop['prerequisites'],
                'workshopPrice' => $workshop['msrp']
            ]);

            $count++;

        }

        $id = $customer ? $customer->data()->id : $lead->data()->id;

        Redirect::to('info.php?case=customer&id=' . $id);

    }catch (Exception $e){
        die($e->getMessage());
    }


}