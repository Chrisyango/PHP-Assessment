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

function updateShoppingCart($requests) {
  // Create a shoppingCart
  $shoppingCart = [];
  // Loop through each request in the requests array
  foreach($requests as $request) {
    // Check to see what kind of request it is
    $request = explode(':', $request);
    $whatToDo = trim($request[0]);
    $itemToAdd = (count($request) != 1) ? trim($request[1]) : null;
    $quantity = (count($request) == 3) ? (int)trim($request[2]) : 1;
    switch($whatToDo) {
      case 'quantity_upd':
      // Jump to add case
        $whatToDo = 'add';
      case 'add':
        // Add item to shoppingCart
        if (count($shoppingCart) < 1) {
          // If shoppingCart is empty, Add item
          array_push($shoppingCart, "$itemToAdd : $quantity");
        } else {
          // Keep an iteration number to know which item you're on
          $i = 0;
          foreach($shoppingCart as $key => $shoppingCartItem) {
            // Get itemInCart and quantityInCart
            $shoppingCartItem = explode(':', $shoppingCartItem);
            $itemInCart = trim($shoppingCartItem[0]);
            $quantityInCart = trim($shoppingCartItem[1]);
            if ($itemToAdd == $itemInCart) {
              // If item exists in shoppingCart, Update Quantity
              $quantity = ($quantity) + $quantityInCart;
              $shoppingCart[$key] = "$itemToAdd : $quantity";
              break;
            } elseif (count($shoppingCart) === ($i + 1)) {
              // If item does not exist in shoppingCart, Add to shoppingCart
              array_push($shoppingCart, "$itemToAdd : $quantity");
              $i = 0;
              break;
            }
            // Increase iteration number if we don't break out of loop
            $i += 1;
          }
        }
        break;
      case 'remove':
      // Remove item from shoppingCart
        foreach($shoppingCart as $shoppingCartItem) {
          // If item is found in shoppingCart, remove it
          if(strpos($shoppingCartItem, $itemToAdd) !== false) {
            $shoppingCart = array_diff($shoppingCart, [$shoppingCartItem]);
            break;
          }
        }
        break;
      case 'checkout':
      // Clear the shoppingCart
        $shoppingCart = [];
        break;
    }
  }
  return $shoppingCart;
}

print_r(updateShoppingCart($requests1));
echo "<br>";
print_r(updateShoppingCart($requests2));
echo "<br>";
?>