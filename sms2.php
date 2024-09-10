<?php

// Define constants for Africa's Talking credentials
const USERNAME = 'your_username'; // Replace with your Africa's Talking username
const API_KEY = 'your_api_key';  // Replace with your Africa's Talking API key

// Define constants for SMS details
const RECIPIENT_PHONE_NUMBER = '+254711XXXYYY';  // Replace with the recipient's phone number (including country code)
const SENDER_NAME_OR_SHORTCODE = '+254711XXXYYY';   // Replace with the sender name or shortcode
const MESSAGE = 'Hello, this is a test message from Africa\'s Talking!';

// Define the URL for the Africa's Talking SMS API
const API_URL = 'https://api.africastalking.com/version1/messaging'; // for sandbox use https://sandbox.africastalking.com/version1/messaging

// Create an array to store the POST data
$postData = [
    'username' => USERNAME,
    'to' => RECIPIENT_PHONE_NUMBER,
    'message' => MESSAGE,
    'from' => SENDER_NAME_OR_SHORTCODE
];

// Initialize cURL
$ch = curl_init(API_URL);

// Set cURL options
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($postData),
    CURLOPT_HTTPHEADER => [
        'apiKey: ' . API_KEY,
        'Content-Type: application/x-www-form-urlencoded'
    ]
]);

// Execute cURL request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    exit;
}

// Close cURL resource
curl_close($ch);

// Process the response
echo $response;


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

