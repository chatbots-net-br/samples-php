<?php
    
/**
 * ChatBots WebHook Version 1.0.0
 */


header('Content-Type: application/json;charset=utf-8');

/**
 * Receiving the message from the chatbots whatsapp library
 */
$inbound = file_get_contents('php://input');


/**
 * Convert the message received in json to a php array
 */
$inboundArray = json_decode($inbound,true);


/**
 * Event: Connected
 * Chatbots whatsapp library connection status 
 */
if (array_key_exists('connected',$inboundArray)) {
    /**
    * Write status to the log
    */
    file_put_contents('status.log', "{$inbound}");
}


/**
 * Event: Ack
 * Message read confirmation
 */
if (array_key_exists('ack',$inboundArray)) {
    /**
     * Write ack to the log 
    */
    file_put_contents('ack.log', "{$inbound}\r\n",FILE_APPEND);
}


/**
 * Event: Message
 * incoming messages
 */
if (array_key_exists('message',$inboundArray)) {

    
    /**
    * Write incoming messages to the log
    */
    file_put_contents('message.log', "{$inbound}\r\n",FILE_APPEND);


    /**
     * Device
     * Device that received the message
     * $to['user']; // number of device
     * $to['name']; // name of device
    */
    $to = $inboundArray['to'];


    /**
     * Groups
     * $group = $inboundArray['group'];
     * $group['id']; // group identification
     * $group['name']; // Group's name
     * $group['picture']; // group image. Undefined if the group does not have a photo
    */
    $group = $inboundArray['group'];


    /**
     * Contact
     * $contact = $inboundArray['contact'];
     * $contact['name']; // contact name
     * $contact['id']; // contact phone number
     * $contact['picture']; // whatsapp profile picture. Undefined if no photo 
    */
    $contact = $inboundArray['contact'];


    /**
     * Message
     * $message = $inboundArray['message'];
     * $message['id']; // unique message identification 
     * $message['isDoc']; // return true or false. if the message is a document, this parameter returns true
     * $message['isMedia']; // return true or false. if the message has any media, this parameter is returned as true
     * $message['type']; // [chat, image, video, document, sticker, button-response ]
     * $message['message']; // message content
     * $message['timestamp']; // timestamp 
    */
    $message = $inboundArray['message'];
}

/**
 * response
 * 
 */
$res = [];
echo json_encode($res);
	
?>