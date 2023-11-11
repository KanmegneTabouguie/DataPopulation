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
    $user_id = rand(1, $numRecords); // Assuming user IDs from 1 to $numRecords.
    $street_address = $faker->streetAddress;
    $city = $faker->city;
    $state = $faker->state;
    $postal_code = $faker->postcode;
    $country = $faker->country;
    insertAddressData($user_id, $street_address, $city, $state, $postal_code, $country);
}


// Example 3: Cart Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = rand(1, $numRecords); // Assuming user IDs from 1 to $numRecords.
    $product_id = rand(1, $numRecords); // Assuming product IDs from 1 to $numRecords.
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
    $user_id = rand(1, $numRecords); // Assuming a random user_id.
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
    $product_id = rand(1, $numProducts); // Assuming $numProducts is the total number of products in your Product Table.
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
$language_name = [
    "English",
    "Spanish",
    "French",
    // Add more language names as needed.
];

// Example 10: Language Table
for ($i = 0; $i < $numRecords; $i++) {
    $language_name = $language_name[array_rand($language_name)]; // Select a random language name from the array.
    $language_code = $faker->languageCode;


    insertLanguageData($language_name, $language_code);
}





// Example  11: Notification Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
    $notification_type = $faker->randomElement(['order confirmation', 'promotion']);
    $message = $faker->text;
    $sent_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    $is_read = $faker->boolean;

    insertNotificationData($user_id, $notification_type, $message, $sent_date, $is_read);
}

// Example 12: Payment Table
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
    $payment_method = encryptPaymentDetails($faker->creditCardNumber, $encryptionKey); // Encrypt the payment method.
    $payment_details = encryptPaymentDetails($faker->iban, $encryptionKey); // Encrypt the payment details.
    $expiration_date = encryptPaymentDetails($faker->creditCardExpirationDate, $encryptionKey); // Encrypt the expiration date.

    insertPaymentData($user_id, $payment_method, $payment_details, $expiration_date);
}


// Example 13: Photo Table (Optional)
for ($i = 0; $i < $numRecords; $i++) {
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
    $product_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid product_id.

    // Example external image URL (replace with actual image URLs).
    $imageUrls = [
        'data:image/jpeg;base64,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',
        // Add more image URLs as needed.
    ];

    // Select a random image URL.
    $randomImageUrl = $faker->randomElement($imageUrls);

    // Download and store the image from the URL.
    $photo_data = base64_encode(file_get_contents($randomImageUrl));

    insertPhotoData($user_id, $product_id, $photo_data);
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
    $product_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid product_id.
    $promotion_description = $faker->sentence; // Generate a random promotion description.
    $discount_amount = $faker->randomFloat(2, 0.01, 0.5); // Generate a random discount amount between 1% and 50%.
    $start_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'); // Generate a random start date within the last year.
    $end_date = $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'); // Generate a random end date within the next year.

    insertPromotionData($product_id, $promotion_description, $discount_amount, $start_date, $end_date);
}


// Example 16: Rate Table
for ($i = 0; $i < $numRecords; $i++) {
    $product_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid product_id.
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
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
    $product_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid product_id.
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
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
    $user_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid user_id.
    $product_id = $faker->numberBetween(1, $numRecords); // Replace with your logic to select a valid product_id.
    $date_added = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

    insertWishlistData($user_id, $product_id, $date_added);
}


echo "Data insertion completed.";
?>