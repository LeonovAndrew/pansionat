<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавить пансионат");
$APPLICATION->SetPageProperty('description', 'Добавить пансионат. 400 пансионатов для пожилых в Pansionat.pro в Москве и Подмосковье. Адреса, телефоны и цены на размещение в пансионаты для пожилых людей.');
?>

    <div class="add_new_form_wrapper">
        <form action="/dev/null" class="shadow simple" id="addNew">
            <p class="title">Выберите категорию</p>
            <select name="type" id="">
                <option value="Дома престарелых">Дома престарелых</option>
                <option value="Пансионаты для ветеранов">Пансионаты для ветеранов</option>
                <option selected value="Пансионаты для пожилых">Пансионаты для пожилых</option>
                <option value="Дома престарелых">Хосписы</option>
            </select>

            <p class="title">Адрес</p>
            <input type="text" name="adres">

            <p class="title">Цена (за сутки)</p>
            <input type="text" name="price">

            <p class="title">Телефон</p>
            <input type="text" name="phone">

            <p class="title">Вместимость</p>
            <input type="text" name="mest">

            <p class="title">Сайт</p>
            <input type="text" name="site">
            <p class="sub_title">(информационный источник, с которого предпочтительнее пополнять информацию по вашему
                учреждению)</p>

            <div style="position: relative;margin: 20px 0">
                <input type="checkbox" name="agree" id="agree">
                <label for="agree">Согласен на обработку персональных данных</label>
            </div>

            <input type="hidden" name="modal_action" value="addNew">
            <button>Отправить на модерацию</button>
        </form>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>