<?php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($json_data);

    // Check if the 'audio_base64' key exists in the decoded data
    if (isset($data->audio_base64)) {

        // Decode the base64-encoded audio data
        $audio_data = base64_decode($data->audio_base64);

        // Generate a unique ID for the audio file (you may use your own logic here)
        $audio_id = generateUniqueID();

        // Define the path to store the audio file
        $audio_path = "audio_files/{$audio_id}.wav"; // Adjust the file extension as needed

        // Save the audio data to the file
        file_put_contents($audio_path, $audio_data);

        // Respond with a JSON object containing the generated audio ID
        echo json_encode(array('audio_id' => $audio_id));
    } else {
        // If 'audio_base64' key is not present in the data
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Invalid data format'));
    }
} else {
    // If the request is not a POST request
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Method not allowed'));
}

// Function to generate a unique ID (you may implement your own logic)
function generateUniqueID() {
    return subject_id();
}

?>
