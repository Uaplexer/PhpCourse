 $(document).ready(function () {
    $('#city').on('input', function () {
        const cityName = $(this).val();

        if (cityName.length >= 3) {
            $.get('/api/cities', { city_name: cityName }, function (data) {
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
    $.get('/api/post_offices', { city_name: cityName, delivery_type: deliveryType, warehouse_name: warehouseName }, function (data) {
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
