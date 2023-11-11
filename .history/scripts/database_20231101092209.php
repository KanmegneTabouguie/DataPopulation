<?php
// Database connection configuration.
$dbHost = '127.0.0.1';  // Use the local loopback address.
$dbUser = 'root';
$dbPass = 'yvan2021';
$dbName = 'e-commerce';

// Create a MySQLi database connection.
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check for a successful connection.
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function insertUserData($username, $password, $email, $first_name, $last_name, $phone_number, $registration_date) {
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO user (username, password, email, first_name, last_name, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssssss", $username, $password, $email, $first_name, $last_name, $phone_number, $registration_date);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertAddressData($user_id, $street_address, $city, $state, $postal_code, $country) {
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO address (user_id, street_address, city, state, postal_code, country) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("isssss", $user_id, $street_address, $city, $state, $postal_code, $country);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertCartData($user_id, $product_id, $quantity, $date_added) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, date_added) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("iiss", $user_id, $product_id, $quantity, $date_added);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertCategoryData($category_name, $description, $parent_category_id) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO category (category_name, description, parent_category_id) VALUES (?, ?, ?)");

    $stmt->bind_param("ssi", $category_name, $description, $parent_category_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertOrderData($user_id, $product_id, $quantity, $order_date, $status) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO command (user_id, product_id, quantity, order_date, status) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("iiiss", $user_id, $product_id, $quantity, $order_date, $status);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertContactUsData($user_id, $subject, $message, $contact_date, $response) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO contactus (user_id, subject, message, contact_date, response) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("issss", $user_id, $subject, $message, $contact_date, $response);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertCurrencyData($currency_name, $currency_code) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO currency (currency_name, currency_code) VALUES (?, ?)");

    $stmt->bind_param("ss", $currency_name, $currency_code);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertInventoryData($product_id, $batch_number, $purchase_date, $expiration_date, $quantity) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO inventory (product_id, batch_number, purchase_date, expiration_date, quantity) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("issii", $product_id, $batch_number, $purchase_date, $expiration_date, $quantity);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertInvoiceData($order_id, $total_amount, $invoice_date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO invoices (order_id, total_amount, invoice_date) VALUES (?, ?, ?)");

    $stmt->bind_param("ids", $order_id, $total_amount, $invoice_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertLanguageData($language_name, $language_code) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO language (language_name, language_code) VALUES (?, ?)");

    $stmt->bind_param("ss", $language_name, $language_code);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertNotificationData($user_id, $notification_type, $message, $sent_date, $is_read) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO notification (user_id, notification_type, message, sent_date, is_read) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("isssi", $user_id, $notification_type, $message, $sent_date, $is_read);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertPaymentData($user_id, $payment_method, $payment_details, $expiration_date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO payement (user_id, payment_method, payment_details, expiration_date) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("issi", $user_id, $payment_method, $payment_details, $expiration_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertPhotoData($user_id, $product_id, $photo_data) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO photo (user_id, product_id, photo_data) VALUES (?, ?, ?)");

    // Assuming that $photo_data is a binary representation of the image, you can bind it as a BLOB.
    $stmt->bind_param("iib", $user_id, $product_id, $photo_data);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertProductData($product_name, $description, $price, $category, $stock_quantity) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO product (product_name, description, price, category, stock_quantity) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("ssdii", $product_name, $description, $price, $category, $stock_quantity);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertPromotionData($product_id, $promotion_description, $discount_amount, $start_date, $end_date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO promotion (product_id, promotion_description, discount_amount, start_date, end_date) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("issss", $product_id, $promotion_description, $discount_amount, $start_date, $end_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertRateData($product_id, $user_id, $rating_value, $date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO rate (product_id, user_id, rating_value, date) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("iiss", $product_id, $user_id, $rating_value, $date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertReturnData($order_id, $return_reason, $return_date, $return_status) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO retour (order_id, return_reason, return_date, return_status) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("isss", $order_id, $return_reason, $return_date, $return_status);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertReviewData($product_id, $user_id, $review_text, $review_rating, $review_date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO review (product_id, user_id, review_text, review_rating, review_date) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("iissi", $product_id, $user_id, $review_text, $review_rating, $review_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertShippingData($order_id, $shipping_method, $tracking_number, $shipping_status) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO shipping (order_id, shipping_method, tracking_number, shipping_status) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("isss", $order_id, $shipping_method, $tracking_number, $shipping_status);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertWishlistData($user_id, $product_id, $date_added) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO wishlist (user_id, product_id, date_added) VALUES (?, ?, ?)");

    $stmt->bind_param("iis", $user_id, $product_id, $date_added);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


?>
