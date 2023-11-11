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
    $registration_date = $faker->registration_date;

    insertUserData($username, $email, $password , $first_name , $last_name , $phone_number ,$registration_date );


    // Generate and insert data into the 'address' table.
    $user_id = ...; // Get the user_id from a previously inserted user.
    $street_address = $faker->streetAddress;
    $city = $faker->city;
    $state = $faker->state;
    $postal_code = $faker->postcode;
    $country = $faker->country;
    insertAddressData($user_id, $street_address, $city, $state, $postal_code, $country);



    // Repeat this process for other tables as needed (e.g., 'address').
    // Modify the data fields to match your database schema.
}

echo "Data insertion completed.";
