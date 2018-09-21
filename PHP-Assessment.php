<?php
/*You are one of the engineers building the Fare Estimator, so knowing cost per minute and cost per mile for each car type, as well as ride distance and ride time, return the fare estimates for all car types.

ride_time = 30,
ride_distance = 7,
cost_per_minute = [0.2, 0.35, 0.4, 0.45], and
cost_per_mile = [1.1, 1.8, 2.3, 3.5], the output should be
fareEstimator(ride_time, ride_distance, cost_per_minute, cost_per_mile) = [13.7, 23.1, 28.1, 38] 
*/

// (Cost per minute) * (ride time) + (Cost per mile) * (ride distance)

$ride_time = 30;
$ride_distance = 7;
$cost_per_minute = [0.2, 0.35, 0.4, 0.45];
$cost_per_mile = [1.1, 1.8, 2.3, 3.5];

function fareEstimator($ride_time, $ride_distance, $cost_per_minute, $cost_per_mile) {
  // Create an empty array for my results
  $results = [];

  // Loop through my cost_per_minute and cost_per_mile arrays
  for($i = 0; $i < count($cost_per_minute); $i ++) {
    // Do the eqaution
    $ride_cost = ($cost_per_minute[$i] * $ride_time) + ($cost_per_mile[$i] * $ride_distance);
    // Push the ride_cost into my results array
    array_push($results, $ride_cost);
  }

  // Return results
  return $results;
}

print_r(fareEstimator($ride_time, $ride_distance, $cost_per_minute, $cost_per_mile));
echo '<br>';




/*
With Jet Smart Cart the more items you buy, the more you save. The algorithm behind how this works is a bit complicated, and since it's your first day at Jet you decide to ask one of your co-workers for more information. In return, you offer to implement a new cart update algorithm for them. The update algorithm works like this:

add : <item_name>: the <item_name> item was added to the cart;
remove : <item_name>: all <item_name> items were removed from the cart;
quantity_upd : <item_name> : <value>: the <item_name> quantity in the cart was changed by <value>, which is an integer in the format +a or -a;
checkout: the customer has paid and the cart is now empty.
*/

$requests1 = [
  "add : milk",
  "add : pickles",
  "remove : milk",
  "add : milk",
  "quantity_upd : pickles : +4",
  "quantity_upd : pickles : -2"
];

$requests2 = [
  "add : rock",
  "add : paper",
  "add : scissors",
  "checkout",
  "add : golden medal"
];

// Create shoppingCart outside of function for global usage
$shoppingCart = [];

// Create addToCart Function for easier readablity
function addToCart($item, $quantity = 1) {
  // Get global shoppingCart
  global $shoppingCart;
  // Check to see if item already exists in shoppingCart
  if(array_key_exists($item, $shoppingCart)) {
    // If item exists in shopping cart, update quantity
     $shoppingCart[$item] += $quantity;
  } else {
    // If item doesn't exists in shopping cart, add to shopping cart
    $shoppingCart[$item] = $quantity;
  }
  return $shoppingCart;
}

// Create removeFromCart Function for easier readablity
function removeFromCart($item) {
  // Get global shoppingCart
  global $shoppingCart;
  // Unset/Remove item from shoppingCart
  unset($shoppingCart[$item]);
  return $shoppingCart;
}

// Create updateShoppingCart Function
function updateShoppingCart($requests) {
  // Get global shoppingCart
  global $shoppingCart;
  // Loop through all of my requests
  for($i = 0; $i < count($requests); $i ++) {
    // Get the currentRequest
    $currentRequest = $requests[$i];
    // Check to see what kind of request it is
    if(substr($currentRequest, 0, 3 ) === 'add') {
      // If request is to add, get the item name and run the addToCart function
      $item = substr($currentRequest, strpos($currentRequest, ":") + 2); 
      addToCart($item);
    } elseif(substr($currentRequest, 0, 3 ) === 'rem') {
      // If request is to remove, get the item name and run the removeFromCart function
      $item = substr($currentRequest, strpos($currentRequest, ":") + 2); 
      removeFromCart($item);
    } elseif(substr($currentRequest, 0, 3 ) === 'qua') {
      // If request is quantity_upd, get the item name
      $positionOfColon = [];
      // Loop through the request string
      for($j = 0; $j < strlen($currentRequest); $j ++) {
        // If the current position of the string is a colon, keep track of it by putting it in the positionOfColon array
        if ($currentRequest[$j] === ':') {
          array_push($positionOfColon, $j);
        }
      }
      // Get the item name because we know the item name is in between 2 colons
      $item = substr($currentRequest, $positionOfColon[0] + 2, $positionOfColon[1] - ($positionOfColon[0] + 3));
      // Get quantity we want to update the item by
      $quantity = substr($currentRequest, strrpos($currentRequest, ":") + 2);
      // Run the addToCart function because it can update the quantity
      addToCart($item, $quantity);
    } elseif(substr($currentRequest, 0, 3 ) === 'che') {
      // If the request is checkout, we clear the shoppingCart
      $shoppingCart = [];
    }
  }

  print_r($shoppingCart);
}

updateShoppingCart($requests1);
echo '<br>';
updateShoppingCart($requests2);
?>