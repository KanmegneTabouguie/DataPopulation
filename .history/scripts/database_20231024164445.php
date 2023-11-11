<?php

// Database connection configuration.
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'yvan2021';
$dbName = 'e-commerce';

// Create a PDO database connection.
$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
} catch (PDOException $e) {
    // Log the error and display a friendly message to the user.
    error_log($e->getMessage());
    echo "There was an error connecting to the database. Please try again later.";
}



function insertUserData($username, $password, $email, $first_name, $last_name, $phone_number, $registration_date) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO user (username, password, email, first_name, last_name, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $password, $email, $first_name, $last_name, $phone_number, $registration_date]);
}

function insertProductData($product_name, $description, $price, $category, $stock_quantity) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO product (product_name, description, price, category, stock_quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$product_name, $description, $price, $category, $stock_quantity]);
}

function insertAddressData($user_id, $street_address, $city, $state , $postale_code , $country) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO address (user_id, street_address, city, state, postale_code,country) VALUES (?, ?, ?, ?, ? , ?)");
    $stmt->execute([$user_id, $street_address, $city, $state, $postale_code , $country]);
}

function insertCartData($user_id, $product_id, $quantity, $date_added ) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity, date_added) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity, $date_added, ]);
}

function insertCategoryData($category_name, $description, $parent_category_id ) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO cart (category_name, description, parent_category_id) VALUES (?, ?, ?)");
    $stmt->execute([$category_name, $description, $parent_category_id ]);
}

function insertCommandData($user_id, $product_id, $quantity, $order_date, $status) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `command` (user_id, product_id, quantity, order_date, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $quantity, $order_date, $status]);
}

function insertInvoiceData($order_id, $total_amount, $invoice_date) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `invoices` (order_id, total_amount, invoice_date) VALUES (?, ?, ?)");
    $stmt->execute([$order_id, $total_amount, $invoice_date]);
}

function insertPhotoData($user_id, $product_id, $photo_data) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `photo` (user_id, product_id, photo_data) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $photo_data]);
}

function insertRateData($product_id, $user_id, $rating_value, $date) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `rate` (product_id, user_id, rating_value, date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$product_id, $user_id, $rating_value, $date]);
}

function insertPaymentData($user_id, $payment_method, $payment_details, $expiration_date) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `payement` (user_id, payment_method, payment_details, expiration_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $payment_method, $payment_details, $expiration_date]);
}


function insertReviewData($product_id, $user_id, $review_text, $review_rating, $review_date) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO `review` (product_id, user_id, review_text, review_rating, review_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$product_id, $user_id, $review_text, $review_rating, $review_date]);
}


function insertWishlistData($user_id, $product_id, $date_added) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `wishlist` (user_id, product_id, date_added) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $product_id, $date_added]);
}

function insertPromotionData($product_id, $promotion_description, $discount_amount, $start_date, $end_date) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `promotion` (product_id, promotion_description, discount_amount, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$product_id, $promotion_description, $discount_amount, $start_date, $end_date]);
}

function insertShippingData($order_id, $shipping_method, $tracking_number, $shipping_status) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `shipping` (order_id, shipping_method, tracking_number, shipping_status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $shipping_method, $tracking_number, $shipping_status]);
}

function insertReturnData($order_id, $return_reason, $return_date, $return_status) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `retour` (order_id, return_reason, return_date, return_status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$order_id, $return_reason, $return_date, $return_status]);
}

function insertContactUsData($user_id, $subject, $message, $contact_date, $response) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `contactus` (user_id, subject, message, contact_date, response) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $subject, $message, $contact_date, $response]);
}

function insertNotificationData($user_id, $notification_type, $message, $sent_date, $is_read) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `notification` (user_id, notification_type, message, sent_date, is_read) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $notification_type, $message, $sent_date, $is_read]);
}


function insertLanguageData($language_name, $language_code) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `language` (language_name, language_code) VALUES (?, ?)");
    $stmt->execute([$language_name, $language_code]);
}

function insertCurrencyData($currency_name, $currency_code) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `currency` (currency_name, currency_code) VALUES (?, ?)");
    $stmt->execute([$currency_name, $currency_code]);
}

function insertInventoryData($product_id, $batch_number, $purchase_date, $expiration_date, $quantity) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO `inventory` (product_id, batch_number, purchase_date, expiration_date, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$product_id, $batch_number, $purchase_date, $expiration_date, $quantity]);
}



?>

