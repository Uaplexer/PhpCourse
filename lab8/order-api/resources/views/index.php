<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформлення замовлення</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<h2>Оформлення замовлення</h2>
<form id="orderForm">
    <label>Номер замовлення:
        <input type="text" name="order_number" required>
    </label><br><br>

    <label>Вага замовлення (кг):
        <input type="number" name="weight" step="0.1" min="0" required>
    </label><br><br>

    <label>Місто доставки:
        <input type="text" name="city" id="city" required autocomplete="off">
        <ul id="city-list" style="display:none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;"></ul>
    </label><br><br>

    <label>Тип доставки:
        <select name="delivery_type" id="delivery_type" required>
            <option value="post_office">Відділення</option>
            <option value="parcel_machine">Поштомат</option>
        </select>
    </label><br><br>

    <label>Оберіть відділення або поштомат:
        <input type="text" name="address" id="warehouse" required autocomplete="off">
        <ul id="warehouse-list" style="display:none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;"></ul>
    </label><br><br>

    <button type="submit">Оформити замовлення</button>
</form>
<script>
    $(document).ready(function () {
        $(
            '#city').on('input', function () {
            const cityName = $(this).val();

            if (cityName.length >= 3) {
                $.get('/api/cities', {city_name: cityName}, function (data) {
                    const cities = data.data;
                    let cityList = '';

                    cities.forEach(city => {
                        cityList += `<li data-id="${city.Description}">${city.Description}</li>`;
                    });

                    if (cityList) {
                        $('#city-list').html(cityList).show();
                    } else {
                        $('#city-list').hide();
                    }
                });
            } else {
                $('#city-list').hide();
            }
        });

        $('#city-list').on('click', 'li', function () {
            const selectedCity = $(this).text();
            $('#city').val(selectedCity);
            $('#city-list').hide();
        });

        $('input[name="weight"]').on('input', function () {
            const weight = parseFloat($(this).val());
            if (weight > 30) {
                $('#delivery_type option[value="parcel_machine"]').prop('disabled', true);
                if ($('#delivery_type').val() === 'parcel_machine') {
                    $('#delivery_type').val('post_office');
                }
            } else {
                $('#delivery_type option[value="parcel_machine"]').prop('disabled', false);
            }
        });

        $('#city, #delivery_type, #warehouse').on('change', function () {
            const cityName = $('#city').val();
            const deliveryType = $('#delivery_type').val();
            const warehouseName = $('#warehouse').val();
            if (cityName && deliveryType && warehouseName) {
                $.get('/api/post_offices', {
                    city_name: cityName,
                    delivery_type: deliveryType,
                    warehouse_name: warehouseName
                }, function
                    (data) {
                    const warehouses = data.data;
                    let warehouseList = '';

                    warehouses.forEach(warehouse => {
                        warehouseList += `<li data-id="${warehouse.Ref}">${warehouse.Description}</li>`;
                    });

                    if (warehouseList) {
                        $('#warehouse-list').html(warehouseList).show();
                    } else {
                        $('#warehouse-list').hide();
                    }
                });
            }
        });

        $('#warehouse-list').on('click', 'li', function () {
            const selectedWarehouse = $(this).text();
            $('#warehouse').val(selectedWarehouse);
            $('#warehouse-list').hide();
        });

        $('#orderForm').submit(function (e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.post('/api/orders', formData, function (response) {
                alert("Замовлення успішно оформлене!");
                $('#orderForm')[0].reset();
            }).fail(function () {
                alert("Помилка при оформленні замовлення, будь-ласка, перевірте свої дані");
            });
        });
    });
</script>
</body>
</html>
