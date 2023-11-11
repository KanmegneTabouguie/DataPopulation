<?php
function encryptPaymentDetails($data, $encryptionKey) {
    $method = 'aes-256-cbc'; // You can choose a different method.
    $ivSize = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivSize);

    var_dump($data); // Add this line to check the content of $data
    $data = $data->format('Y-m-d H:i:s'); // Convert DateTime to a string
    $encrypted = openssl_encrypt($data, $method, $encryptionKey, 0, $iv);

    return base64_encode($iv . $encrypted);
}


function decryptPaymentDetails($data, $encryptionKey) {
    $method = 'aes-256-cbc'; // Must match the encryption method used for encryption.
    $data = base64_decode($data);
    $ivSize = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $ivSize);
    $data = substr($data, $ivSize);

    $decrypted = openssl_decrypt($data, $method, $encryptionKey, 0, $iv);

    return $decrypted;
}

?>