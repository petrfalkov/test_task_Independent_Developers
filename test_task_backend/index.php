<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </head>
    <body>
    <div id="main">
        <table>
            <thead>
                <tr>
                    <td class="id_t">id</td>
                    <td class="name_of_groc">Наименование товара</td>
                    <td class="other">Категория</td>
                    <td class="other">Стоимость</td>
                </tr>
                <tr id="add_tr">
                    <td id='add_add' class="id_t">Add</td>
                    <td id="name_add" contenteditable></td>
                    <td id="cat_add" class="other" contenteditable></td>
                    <td id="price_add" class="other" contenteditable></td>
                    <td id='but_add' align="center" class="add">
                        <button name="add_b" class="close add_b" aria-label="Close">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        function fetch_data() {
            $.ajax({
                url: 'select.php',
                method: "POST",
                success: function (data) {
                    $('tbody').html(data);
                }
            });
        }

        fetch_data();//filling the div with database items

        function edit_data(name, text, column_name) {
            $.ajax({
                url: 'edit.php',
                method: 'POST',
                data: {name: name, text: text, column_name: column_name},
                dataType: 'text',
                success: function (data) {
                }
            })
        }

        $(document).on('blur', '.name_of_groc', function () {
            var name = $(this).data('idn');
            var text = $(this).text();
            if (text != '') { //check for empty field
                edit_data(name, text, "groc_name"); //editing data just in fields
            } else {
                alert('Поле названия не может быть пустым');
                fetch_data();
                return false;
            }
        });

        $(document).on('blur', '.cat_ego', function () {
            var name = $(this).data('idc');
            var text = $(this).text();
            if (text != '') { //check for empty field
                    edit_data(name, text, "groc_category");
            } else {
                alert('Поле категории не может быть пустым');
                fetch_data();
                return false;
            }
        });

        $(document).on('blur', '.pri_ce', function () {
            var name = $(this).data('idp');
            var text = $(this).text();
            if (text != '') { //check for empty field
                if ($.isNumeric(text)) {//check for nonNumeric parameter
                        edit_data(name, text, "groc_price");
                } else {
                        alert('Поле цены может содержать только числовое значение');
                        fetch_data();
                        return false;
                }
            } else {
                alert('Поле цены не может быть пустым');
                fetch_data();
                return false;
            }
        });

        $(document).on('click', '.de_let', function () {
            if (confirm('Вы уверены что хотите удалить ' + this.name + '?') == true) {
                $.ajax({
                    url: 'delete.php',
                    method: 'POST',
                    data: {name: this.name},
                    dataType: 'text',
                    success: function (data) {
                    }
                });
                $('#' + this.id).remove(); //delete element from DOM
            }
        });


        $(document).on('click', '.add_b', function () {
            var name_add = $("#name_add").text();
            var cat_add = $("#cat_add").text();
            var price_add = $("#price_add").text();
            if (name_add == '') { //check for empty field
                alert('Введите название товара');
                return false;
            }
            if (cat_add == '') { //check for empty field
                alert('Введите категорию товара');
                return false;
            }
            if (price_add != '') { //check for empty field
                if (!$.isNumeric(price_add)) { //check for nonNumeric parameter
                    alert("Цена должна содержать только цифры");
                    return false;
                }
            } else {
                alert('Введите цену товара');
                return false;
            }
            $.ajax({
                url: 'insert.php',
                method: 'POST',
                data: {name: name_add, category: cat_add, price: price_add},
                dataType: 'text',
                success: function (data) {
                    fetch_data(); //updating data
                }
            });
            $("#name_add").text('');
            $("#cat_add").text('');
            $("#price_add").text('');
        });
    });
</script>
