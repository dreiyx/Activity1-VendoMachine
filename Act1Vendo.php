<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef1f7;
        }
        h1 {
            text-align: left;
            color: #444;
        }
        fieldset {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #666;
            background-color: #fff;
        }
        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
        label {
            margin-bottom: 10px;
            display: block;
        }
        input[type="checkbox"], input[type="number"] {
            margin-right: 8px;
        }
        select {
            margin-left: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0069d9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            margin: 15px 0;
        }
        li {
            margin-bottom: 10px;
        }
        .summary {
            font-size: 1.1em;
        }
        hr {
            margin: 20px 0;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Vending Machine</h1>
    <form method="post">
        <fieldset>
            <legend>Drinks Selection</legend>
            <label><input type="checkbox" name="beverages[]" value="Coke"> Coke - ₱15</label>
            <label><input type="checkbox" name="beverages[]" value="Sprite"> Sprite - ₱20</label>
            <label><input type="checkbox" name="beverages[]" value="Royal"> Royal - ₱20</label>
            <label><input type="checkbox" name="beverages[]" value="Pepsi"> Pepsi - ₱15</label>
            <label><input type="checkbox" name="beverages[]" value="Mountain Dew"> Mountain Dew - ₱20</label>
        </fieldset>

        <fieldset>
            <legend>Order Details</legend>
            <label>Size:
                <select name="drink_size">
                    <option value="Regular" selected>Regular</option>
                    <option value="Up">Up-Size (₱5 extra)</option>
                    <option value="Jumbo">Jumbo-Size (₱10 extra)</option>
                </select>
            </label>
            <label>Quantity: <input type="number" name="drink_quantity" min="1" max="10"></label>
        </fieldset>

        <input type="submit" value="Checkout" name="submit_order">
    </form>

    <?php
    // Price list for beverages
    $beverage_prices = [
        "Coke" => 15,
        "Sprite" => 20,
        "Royal" => 20,
        "Pepsi" => 15,
        "Mountain Dew" => 20
    ];

    // Additional costs based on size
    $size_extra_cost = [
        "Regular" => 0,
        "Up" => 5,
        "Jumbo" => 10
    ];

    // Initialize total cost
    $final_total_cost = 0;

    if (isset($_POST['submit_order'])) {
        $selected_beverages = $_POST['beverages'] ?? [];
        $chosen_size = $_POST['drink_size'] ?? "Regular";
        $drink_count = $_POST['drink_quantity'] ?? 0;

        if (empty($selected_beverages)) {
            echo "<hr><p>Please select at least one drink to proceed.</p>";
        } elseif ($drink_count < 1) {
            echo "<hr><p>Please specify a valid quantity.</p>";
        } else {
            echo "<hr><h2>Order Summary</h2>";
            echo "<ul>";

            foreach ($selected_beverages as $beverage) {
                $drink_price = $beverage_prices[$beverage];
                $size_additional_cost = $size_extra_cost[$chosen_size];
                $item_total_price = ($drink_price + $size_additional_cost) * $drink_count;
                $final_total_cost += $item_total_price;

                echo "<li><strong>$drink_count x $chosen_size $beverage:</strong> ₱$item_total_price</li>";
            }

            echo "</ul>";
            echo "<p class='summary'><strong>Total Cost:</strong> ₱$final_total_cost</p>";
            echo "<p class='summary'><strong>Total Drinks Ordered:</strong> " . count($selected_beverages) . "</p>";
        }
    }
    ?>
</body>
</html>
