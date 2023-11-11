<?php

// Require the Faker and database configuration files.
require 'faker.php';
require 'database.php';

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
    $first_name = $faker->first_name;
    $last_name = $faker->last_name;
    $phone_number = $faker->phone_number;
    $registration_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');

        // Insert user data into the 'user' table.
    insertUserData($username, $email, $password , $first_name , $last_name , $phone_number ,$registration_date );

// Get the user_id of the last inserted user.
$user_id = $pdo->lastInsertId();

    // Generate and insert data into the 'address' table.    $street_address = $faker->streetAddress;
    $street_address = $faker->streetAddress;
    $city = $faker->city;
    $state = $faker->state;
    $postal_code = $faker->postcode;
    $country = $faker->country;
    // Insert address data into the 'address' table.
    insertAddressData($user_id, $street_address, $city, $state, $postal_code, $country);
  
}

echo "Data insertion completed.";
?>