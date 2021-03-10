<?php

/*

  Receiving an unsubscribe SMS using SMSLink - Blacklists Webhooks (API)

  This example illustrates receiving a SMS MO (Mobile Originated) for unsubscribe sent by a mobile subscriber to a shortcode using 
  SMSLink - Blacklists API

  This script should be availabile to a public URL using HTTP/HTTPS protocol and must accept HTTP(S) requests from SMSLink. 
  In case the HTTP(S) request sent by SMSLink cannot be completed (1) due to a connection error (ie. Connection Timeout etc.) or 
  (2) due to a returned HTTP Status Code between 400 and 599 (id. 404 Not Found, 500 Internal Server Error samd.), SMSLink will 
  retry resending the HTTP(S) request for 2 times within the following 2 hours.

  Form your SMSLink Account, access Blocked Receivers > SMS Unsubscription and configure your SMS Unsubscribe Keyword and a your 
  public URL endpoint where SMSLink.ro will send to you each SMS unsubscription sent by the mobile subscribers to the shortcode, 
  using a HTTP(S) GET request.

*/

if ((isset($_GET["unsubscribe_message_id"])) and 
    (isset($_GET["sender"])) and 
    (isset($_GET["receiver"])) and 
    (isset($_GET["message"])) and 
    (isset($_GET["timestamp"])) and 
    (isset($_GET["network_id"])) and 
    (isset($_GET["network_name"])) and 
    (isset($_GET["response_message_id"])) and 
    (isset($_GET["response_message"])) and 
    (isset($_GET["service_ids"])) and 
    (isset($_GET["unsubscribe_status_id"])) and 
    (isset($_GET["unsubscribe_status_message"]))
  )
{
   /*

    The Unsubscribe Message ID in Universally Unique Udentifier (UUID Version 4) Format 
    
      variabile $_GET["unsubscribe_message_id"] is typeof string 
      (ie. 279beab2-a10c-48e3-b637-0bf5557b7785)

  */
  $unsubscribe_message_id = $_GET["unsubscribe_message_id"];  

  /*

    The Sender of the SMS (ie. 07xyzzzzzz)

      variabile $_GET["sender"] is typeof string

  */
  $sender = $_GET["sender"];  

  /*

    The Shortcode on which the SMS was sent (ie. 17xy, 18xy, 37xy, 38xy etc.)

      variabile $_GET["receiver"] is typeof string

  */
  $receiver = $_GET["receiver"];

  /*

    The Message sent by the Sender to the Shortcode

      variabile $_GET["message"] is typeof string

  */
  $message = $_GET["message"];

  /*

    The Timestamp in which the Message was received on the Shortcode, in UNIX Timestamp format.

      variabile $_GET["timestamp"] is typeof integer

  */
  $timestamp = $_GET["timestamp"]; 

  /*

    The Network ID in which the Sender is located, with the following possible values:
    
      variabile $_GET["network_id"] is typeof integer

      1 for Vodafone Romania
      2 for Orange Romania
      3 for Telekom Romania Mobile / Telekom Romania
      5 for Digimobil (RCS-RDS)

  */
  $network_id = $_GET["network_id"]; 

  /*

    The Network Name corresponding to the Network ID

      variabile $_GET["network_name"] is typeof string

  */
  $network_name = urldecode($_GET["network_name"]); 

  /*

    SMS Response Sent to the Sender of the Unsubscribe SMS (according to the Blacklist Service Settings)

      variabile $_GET["response_message_id"] is typeof integer
      variabile $_GET["response_message"] is typeof string
      
  */
  $response_message_id = $_GET["response_message_id"]; 
  $response_message    = urldecode($_GET["response_message"]); 

  /*

    Blocked Service IDs (according to the Blacklist Service Settings)
      
      variabile $_GET["service_ids"] is typeof string

  */
  $service_ids = urldecode($_GET["service_ids"]); 

  /*

    Unsubscribe Status

      variabile $_GET["unsubscribe_status_id"] is typeof integer
      variabile $_GET["unsubscribe_status_message"] is typeof string

      Possible Values:

      unsubscribe_status_id      =  1
      unsubscribe_status_message = Success.

      unsubscribe_status_id      = -4
      unsubscribe_status_message = Invalid blocking rule for keyword 'Unsubscribe Keyword'.

      unsubscribe_status_id      = -5
      unsubscribe_status_message = Service not active for keyword 'Unsubscribe Keyword'.

  */
  $unsubscribe_status_id      = $_GET["unsubscribe_status_id"]; 
  $unsubscribe_status_message = urldecode($_GET["unsubscribe_status_message"]); 

  /*

    Write the SMS received to a text file

      Please note that this is for example purpose only and the file(s) below must be not be publicly accessible. If you will 
      choose to store the SMS received to file(s) you must enable access restrictions and deny access from public to the respective 
      file(s) and you must disable directory listing on the directory where the files are stored.

      We recommend you storing the SMS received to a database.

  */

  $handler = fopen("unsubscribe-sms-mobile-originated-".date("d-m-Y", $timestamp)."txt", "a+");

  fwrite($handler, 
            "Unsubscribe SMS Received: ID ".$unsubscribe_message_id.", ".
            "From ".$sender.", ".
            "Receiver ".$receiver.", ".
            "Network ID: ".$network_id.", ".
            "Network Name: ".$network_name.", ".
            "Date / Time: ".date("d-m-Y H:i:s", $timestamp).", ".
            "Unsubscribe Message: ".$message.", ".
            "Unsubscribe Service IDs: ".$service_ids.", ".
            "Response Message: ".($response_message_id)." ".$response_message.", ".
            "Unsubscribe Status: ".($unsubscribe_status_id)." ".$unsubscribe_status_message.
            "\r\n"
    );

  fclose($handler);

  echo "Succes.";

}
else
{
  echo "Invalid Request.";
  
}
    
?> 