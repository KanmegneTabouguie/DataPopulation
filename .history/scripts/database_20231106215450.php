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

function insertAddressData($user_id, $street_address, $city, $state, $postale_code, $country) {
    global $mysqli;
    
    $stmt = $mysqli->prepare("INSERT INTO address (user_id, street_address, city, state, postale_code, country) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("isssss", $user_id, $street_address, $city, $state, $postale_code, $country);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertCartData($user_id, $product_id, $quantity, $date_added) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, date_added) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("ssi", $category_name, $description, $parent_category_id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to insert order data into the database
function insertOrderData($mysqli, $user_id, $product_id, $quantity, $order_date, $status) {
    // Assuming 'orders' is the name of your table
    $query = "INSERT INTO command (user_id, product_id, quantity, order_date, status) 
              VALUES (?, ?, ?, ?, ?)";
    
    // Prepare the query
    $stmt = $mysqli->prepare($query);
    
    if (!$stmt) {
        // Handle the error
        die('Error: ' . $mysqli->error);
    }
    
    // Bind parameters
    $stmt->bind_param('iiiss', $user_id, $product_id, $quantity, $order_date, $status);
    
    // Execute the query
    if (!$stmt->execute()) {
        // Handle the error
        die('Error: ' . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
}


function insertContactUsData($user_id, $subject, $message, $contact_date, $reponse) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO contactus (user_id, subject, message, contact_date, reponse) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("issss", $user_id, $subject, $message, $contact_date, $reponse);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertCurrencyData($symbol,$currencycode) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO currency (symbol,currencycode) VALUES (?,?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $symbol,$currencycode);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertInventoryData($product_id, $batch_number, $purchase_date, $expiration_date, $quantity) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO inventory (product_id, batch_number, purchase_date, expiration_date, quantity) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("isssi", $product_id, $batch_number, $purchase_date, $expiration_date, $quantity);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertInvoiceData($order_id, $total_amount, $invoice_date) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO invoices (order_id, total_amount, invoice_date) VALUES (?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("ids", $order_id, $total_amount, $invoice_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertLanguageData($languageCode, $languageName) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO language (language_code, language_name) VALUES (?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $languageCode, $languageName);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertNotificationData($user_id, $notification_type, $message, $sent_date, $is_read) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO notification (user_id, notification_type, message, sent_date, is_read) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("isss", $user_id, $payment_method, $payment_details, $expiration_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function insertPhotoData($user_id, $product_id, $photo_data) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO photo (user_id, product_id, photo_data) VALUES (?, ?, ?)");


    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }
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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("iisss", $product_id, $user_id, $review_text, $review_rating, $review_date);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function insertShippingData($order_id, $shipping_method, $tracking_number, $shipping_status) {
    global $mysqli;

    $stmt = $mysqli->prepare("INSERT INTO shipping (order_id, shipping_method, tracking_number, shipping_status) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

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

    if (!$stmt) {
        die("Error: " . $mysqli->error);
    }

    $stmt->bind_param("iis", $user_id, $product_id, $date_added);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Add this code to your database.php file

function getValidUserID($mysqli) {
    $userQuery = "SELECT user_id FROM user ORDER BY RAND() LIMIT 1";
    $userResult = $mysqli->query($userQuery);
    
    if ($userResult) {
        $userRow = $userResult->fetch_assoc();
        return $userRow['user_id'];
    } else {
        die("Error: " . $mysqli->error);
    }
}

function getValidProductID($mysqli) {
    $productQuery = "SELECT product_id FROM product ORDER BY RAND() LIMIT 1";
    $productResult = $mysqli->query($productQuery);
    
    if ($productResult) {
        $productRow = $productResult->fetch_assoc();
        return $productRow['product_id'];
    } else {
        die("Error: " . $mysqli->error);
    }
}




?>
