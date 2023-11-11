<?php

// Require the Faker and database configuration files.
require 'faker.php';
require 'database.php';
require_once('encryption_utils.php');


// Create a Faker instance.
$faker = getFaker();

// Number of records to generate.
$numRecords = 100; // Change this as needed.

// Generate and insert data into your database tables (e.g., user and address).
for ($i = 0; $i < $numRecords; $i++) {
    // Example: Generate and insert data into the 'user' table.
    $username = $faker->userName;
    $password = password_hash($faker->password, PASSWORD_DEFAULT);
    $email = $faker->email;
    $first_name = $faker->firstName;
    $last_name = $faker->lastName;
    $phone_number = $faker->phoneNumber;
    $registration_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

        // Insert user data into the 'user' table.
    insertUserData($username, $email, $password , $first_name , $last_name , $phone_number ,$registration_date );
}

// Example 2: Address Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $street_address = $faker->streetAddress;
    $city = $faker->city;
    $state = $faker->state;
    $postal_code = $faker->postcode;
    $country = $faker->country;
    insertAddressData($user_id, $street_address, $city, $state, $postal_code, $country);
}


// Example 3: Cart Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $product_id = getValidProductID($mysqli);
    $quantity = rand(1, 10); // Assuming a random quantity.
    $date_added = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    insertCartData($user_id, $product_id, $quantity, $date_added);
}

// Example 4: Category Table
for ($i = 0; $i < $numRecords; $i++) {
    $category_name = $faker->word; // Assuming a random category name.
    $description = $faker->sentence; // Assuming a random description.
    $parent_category_id = rand(1, $numRecords); // Assuming parent_category_id referring to other categories.
    insertCategoryData($category_name, $description, $parent_category_id);
}

// Example 5: Command Table (Orders)
for ($i = 0; $i < $numRecords; $i++) {
    // Generate a random user ID
    $user_id = getValidUserID($mysqli);

    // Generate a random product ID
    $product_id = getValidProductID($mysqli);

    // Generate a random quantity between 1 and 10
    $quantity = rand(1, 10);

    // Generate a random order date within the last year
    $order_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

    // Randomly choose the order status (pending or shipped)
    $status = $faker->randomElement(['pending', 'shipped']);

    // Insert the order data into the table
    insertOrderData($mysqli, $user_id, $product_id, $quantity, $order_date, $status);
}

// Example 6: Contact Us Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $subject = $faker->sentence;
    $message = $faker->paragraph;
    $contact_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    $response = $faker->optional(0.7)->paragraph; // 70% of records have a response.

    insertContactUsData($user_id, $subject, $message, $contact_date, $response);
}

// Example 7: Currency Table
for ($i = 0; $i < $numRecords; $i++) {
    $symbol = generateCurrencySymbol(); // Call a function to generate currency symbols.
    $currencyCode = generateCurrencyCode(); // Call a function to generate currency codes.

    insertCurrencyData($symbol, $currencyCode); // Update the insertCurrencyData function to accept the correct parameters.
}

function generateCurrencySymbol() {
    $currencySymbols = ['$', '€', '£', '¥', '₹']; // Add more currency symbols if needed.
    $randomSymbol = array_rand($currencySymbols, 1);

    return $currencySymbols[$randomSymbol];
}

function generateCurrencyCode() {
    $currencyCodes = ['USD', 'EUR', 'GBP', 'JPY', 'INR']; // Add more currency codes if needed.
    $randomCode = array_rand($currencyCodes, 1);

    return $currencyCodes[$randomCode];
}


// Example 8: Inventory Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_id = getValidProductID($mysqli);
    $batch_number = $faker->unique()->randomNumber(5);
    $purchase_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    $expiration_date = $faker->dateTimeBetween('now', '+2 years')->format('Y-m-d H:i:s');
    $quantity = $faker->numberBetween(1, 100);

    insertInventoryData($product_id, $batch_number, $purchase_date, $expiration_date, $quantity);
}

// Example 9: Invoices Table
for ($i = 0; $i < $numRecords; $i++) {
    $order_id = rand(1, $numOrders); // Assuming $numOrders is the total number of orders in your Command Table.
    $total_amount = $faker->randomFloat(2, 10, 500);
    $invoice_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

    insertInvoiceData($order_id, $total_amount, $invoice_date);
}
$language_names = [
    "English",
    "Spanish",
    "French",
    // Add more language names as needed.
];

// Example 10: Language Table
for ($i = 0; $i < $numRecords; $i++) {
    $language_name = $language_name[array_rand($language_names)]; // Select a random language name from the array.
    $language_code = $faker->languageCode;


    insertLanguageData($language_name, $language_code);
}





// Example  11: Notification Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    // Replace with your logic to select a valid user_id.
    $notification_type = $faker->randomElement(['order confirmation', 'promotion']);
    $message = $faker->text;
    $sent_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    $is_read = $faker->boolean;

    insertNotificationData($user_id, $notification_type, $message, $sent_date, $is_read);
}

// Example 12: Payment Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $payment_method = encryptPaymentDetails($faker->creditCardNumber, $encryptionKey); // Encrypt the payment method.
    $payment_details = encryptPaymentDetails($faker->iban, $encryptionKey); // Encrypt the payment details.
    $expiration_date = encryptPaymentDetails($faker->creditCardExpirationDate, $encryptionKey); // Encrypt the expiration date.

    insertPaymentData($user_id, $payment_method, $payment_details, $expiration_date);
}


for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $product_id = getValidProductID($mysqli);
    // Use "Lorem Picsum" to generate a random image URL
    $photo_data = "https://picsum.photos/200/300?random=" . rand(1, 1000);

    // Insert photo data
    if (insertPhotoData($user_id, $product_id, $photo_data)) {
        echo "Photo inserted successfully<br>";
    } else {
        echo "Failed to insert photo<br>";
    }
}

// Example 14: Product Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_name = $faker->words(3, true); // Generate a random product name.
    $description = $faker->text; // Generate a random product description.
    $price = $faker->randomFloat(2, 1, 1000); // Generate a random price.
    $category = $faker->word; // Generate a random category name.
    $stock_quantity = $faker->numberBetween(1, 1000); // Generate a random stock quantity.

    insertProductData($product_name, $description, $price, $category, $stock_quantity);
}

// Example 15: Promotion Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_id = getValidProductID($mysqli);
    $promotion_description = $faker->sentence; // Generate a random promotion description.
    $discount_amount = $faker->randomFloat(2, 0.01, 0.5); // Generate a random discount amount between 1% and 50%.
    $start_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'); // Generate a random start date within the last year.
    $end_date = $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'); // Generate a random end date within the next year.

    insertPromotionData($product_id, $promotion_description, $discount_amount, $start_date, $end_date);
}


// Example 16: Rate Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_id = getValidProductID($mysqli);
    $user_id = getValidUserID($mysqli);
    $rating_value = $faker->numberBetween(1, 5); // Generate a random rating value between 1 and 5.
    $date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'); // Generate a random date within the last year.

    insertRateData($product_id, $user_id, $rating_value, $date);
}

// Example 17: Return Table
for ($i = 0; $i < $numRecords; $i++) {
    $order_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid order_id.
    $return_reason = $faker->sentence(6); // Generate a random return reason.
    $return_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'); // Generate a random date within the last year.
    $return_status = $faker->randomElement(['processing', 'refunded']); // Randomly select a return status.

    insertReturnData($order_id, $return_reason, $return_date, $return_status);
}

// Example 18: Review Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_id = getValidProductID($mysqli);
    $user_id = getValidUserID($mysqli);
    $review_text = $faker->paragraph(2); // Generate a random review text.
    $review_rating = $faker->numberBetween(1, 5); // Generate a random rating between 1 and 5.
    $review_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'); // Generate a random date within the last year.

    insertReviewData($product_id, $user_id, $review_text, $review_rating, $review_date);
}

// Example 19: Shipping Table
for ($i = 0; $i < $numRecords; $i++) {
    $order_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid order_id.
    $shipping_method = $faker->randomElement(['standard', 'express']);
    $tracking_number = $faker->ean8; // Generate a random tracking number (adjust as needed).
    $shipping_status = $faker->randomElement(['shipped', 'out for delivery']); // Generate a random shipping status.

    insertShippingData($order_id, $shipping_method, $tracking_number, $shipping_status);
}

// Example 20: Wishlist Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = getValidUserID($mysqli);
    $product_id = getValidProductID($mysqli);
    $date_added = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

    insertWishlistData($user_id, $product_id, $date_added);
}


echo "Data insertion completed.";
?>