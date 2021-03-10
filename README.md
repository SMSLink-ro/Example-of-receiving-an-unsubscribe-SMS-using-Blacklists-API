# Example for receiving an unsubscribe SMS using SMSLink Blacklists Webhooks (API)

This example illustrates receiving a SMS MO (Mobile Originated) for unsubscribe sent by a mobile subscriber to a shortcode using SMSLink - Blacklists API. 

SMSLink.ro allows you to send SMS to all mobile networks in Romania and also to more than 168 countries and more than 1000 mobile operators worldwide. 

## Requirements & Usage

1. Create an account on [SMSLink.ro](https://www.smslink.ro/inregistrare/)
2. Form your SMSLink Account, access Blocked Receivers > SMS Unsubscription and configure your SMS Unsubscribe Keyword and a your public URL endpoint where SMSLink.ro will send to you each SMS unsubscription sent by the mobile subscribers to the shortcode, using a HTTP(S) GET request.

## Parameters for the received unsubscribe SMS

- *unsubscribe_message_id* the Unsubscribe Message ID in Universally Unique Udentifier (UUID Version 4) format 
- *sender* the Sender of the SMS (ie. 07xyzzzzzz)
- *receiver* the Shortcode on which the SMS was sent (ie. 17xy, 18xy, 37xy, 38xy etc.)
- *message* the Message sent by the Sender to the Shortcode
- *timestamp* the Timestamp in which the Message was received on the Shortcode, in UNIX Timestamp format
- *network_id* the Network ID in which the Sender is located, with the following possible values:
  - 1 for Vodafone Romania
  - 2 for Orange Romania
  - 3 for Telekom Romania Mobile / Telekom Romania
  - 5 for Digimobil (RCS-RDS)
- *network_name* the Network Name corresponding to the Network ID
- *response_message_id* the Message ID of the SMS response sent to Sender (according to the Blacklist Service Settings)
- *response_message* the Message of the SMS response sent to Sender (according to the Blacklist Service Settings)
- *service_ids* the Blocked Service IDs (according to the Blacklist Service Settings)
- *unsubscribe_status_id* the Unsubscribe Status ID
  - 1 for Success.
  - -4 for Invalid blocking rule for keyword 'Unsubscribe Keyword'.
  - -5 for Service not active for keyword 'Unsubscribe Keyword'.
- *unsubscribe_status_message* the Unsubscribe Status Message

## Support

For technical support inquiries contact us at contact@smslink.ro or by using any other available method described [here](https://www.smslink.ro/contact.php).
