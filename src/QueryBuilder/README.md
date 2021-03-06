# Query Builder
This Query Builder provides all kinds of [expressions](https://github.com/alexandrajulius/RuleEngine/tree/main/src/QueryBuilder/Expression)
that can be combined to form rules
which will then be applied to a given set of data.
Hence, the API of expects rules and data:
```php
$evaluator->evaluate(ExpressionInterface $rules, array $data);
```

The rules should be formed by a developer and will implement any domain knowledge.
For example, a stakeholder specifies rules that calculate the shipping costs of a cart.
Moreover, they want to be able to change these specifications over time
(today free-shipping of one product applies to all products in the cart,
tomorrow only to one product).

## Usage
In the acceptance tests of this implementation, you can find examples for rules that
[calculate the total shipping costs for a cart](https://github.com/alexandrajulius/RuleEngine/blob/main/tests/QueryBuilder/Acceptance/ShippingCostsTest.php#L80)
or the shipping carrier (todo).

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
we use the following data structure as input:
```php
# input cart data
$data = ['cart' => 
            ['items' => [
                    'product_id_1' => ['shipping_flatrate' => true, 'shipping_cost' => 0.00],
                    'product_id_2' => ['shipping_flatrate' => false, 'shipping_cost' => 20.00],
                    'product_id_3' => ['shipping_flatrate' => false, 'shipping_cost' => 10.00],
                ]
            ]
        ];
# input rule (pseudo code)        
$rule = IF (one product has shipping_flatrate)
        THEN (shipping_costs = 0) 
        ELSE (shipping_costs = sum(all items shipping_costs)); 

# expected output
$totalShippingCosts = 0.00;
```

To calculate the shipping costs for the above cart array, we create a rule in
[ShippingCostsAcceptanceTest.php](https://github.com/alexandrajulius/RuleEngine/blob/main/tests/QueryBuilder/Acceptance/ShippingCostsTest.php#L80).
This rule applies all boolean and arithmetic operations required to resolve the above
cart array to the shipping costs.

    # Todo: calculate carrier, check for vouchers
    # Todo: add to docs
    # Rule Engine:
    # <, > , = , <= , >=, contains, not expression (will negate anything that it gets)
    # &&, ||, XOR, LogicEvaluator, BooleanValue

    # Expression Engine:
    # expression: ArithmeticOperator +, *, /, modulo

## Dependencies
```
"symfony/property-access": "^5.3"
```

