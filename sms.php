<?php

// Set your Africa's Talking credentials
$username = 'your_username'; // Replace with your Africa's Talking username
$apiKey   = 'your_api_key';  // Replace with your Africa's Talking API key

// Define the SMS details
$recipients = '+254711XXXYYY';  // Replace with the recipient's phone number (including country code)
$sender = '+254711XXXYYY';   // Replace with the sender name or shortcode
$message    = 'Hello, this is a test message from Africa\'s Talking!';

// Set the URL for the Africa's Talking SMS API
$url = 'https://api.africastalking.com/version1/messaging'; // for sandbox use https://sandbox.africastalking.com/version1/messaging

// Prepare the POST fields
$data = [
    'username' => $username,
    'to'       => $recipients,
    'message'  => $message,
    'from'  => $sender
];

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "apiKey: $apiKey",
    'Content-Type: application/x-www-form-urlencoded'
]);

// Execute cURL request and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Decode and print the response
    $responseData = json_decode($response, true);
    print_r($responseData);
}

// Close the cURL session
curl_close($ch);


//Sample Response
/* {
    "SMSMessageData": {
        "Message": "Sent to 1/1 Total Cost: KES 0.8000",
        "Recipients": [{
            "statusCode": 101,
            "number": "+254711XXXYYY",
            "status": "Success",
            "cost": "KES 0.8000",
            "messageId": "ATPid_SampleTxnId123"
        }]
    }
} */

