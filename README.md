# Rule Engine
An engine to rule them all... 

## What is it good for?
In this implementation, we calculate the total shipping costs for a cart that contains products.

A stakeholder specifies rules that need to be applied to calculate the shipping costs of a cart.
Moreover, they want to be able to change these specifications over time 
(today free-shipping of one product applies to all products in the cart, tomorrow only to one product).

For example:
1) The cart's total shipping cost is the sum of all contained product's shipping costs.
```behat
Scenario: Normal shipping costs
    Given I have a cart with the following products:
      | product_id | shipping_costs | shipping_flatrate
      | 1          | 0.00           | false
      | 2          | 20.00          | false
      | 3          | 10.00          | false
    Then the total shipping cost for the cart is "30.00" Euro
```
2) If one product in the cart has a shipping flatrate (free shipping), 
   then shipping for all other products is free.
```behat
Scenario: Shipping Flatrate
    Given I have a cart with the following products:
      | product_id | shipping_costs | shipping_flatrate
      | 1          | 0.00           | true
      | 2          | 20.00          | false
      | 3          | 10.00          | false
    Then the total shipping cost for the cart is "00.00" Euro
```

To specify the cart for the second scenario, 
we use the following data structure as input for the rule engine:
```php
# input
$data = ['cart' => 
            ['items' => [
                    'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 0.00],
                    'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
                    'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
                ]
            ]
        ];
        
        
# output
$totalShippingCosts = 0.00;
```

    # Rule Engine:
    # <, > , = , <= , >=, contains, not expression (will negate anything that it gets)
    # &&, ||, XOR, LogicEvaluator, BooleanValue

    # Expression Engine:
    # expression: ArithmeticOperator +, *, /, modulo

## Dependencies
```
"symfony/property-access": "^5.3"
```

