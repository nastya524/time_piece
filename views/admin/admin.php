<?php
use core\models\Admin;
?>
    <main class="content">
        <section class="section container">
            <div class="section__body">
                <div class="admin-panel">
                    <h1 class="admin-panel__title">Панель администрирования</h1>
                    <div class="admin-panel__male-category">
                        <header class="admin-panel__header">
                            <h2 class="admin-panel__subtitle">Мужские часы</h2>
                            <div class="admin-panel__button-wrapper">
                                <button class="admin-panel__button button button--modal-admin openModalAddProduct">+ Добавить</button>
                            </div>
                        </header>
                        <div class="admin-panel__content">
                            <?php foreach (Admin::getAllProductsMale() as $item) { ?>
                                <div class="admin-panel__content-inner">
                                    <div class="admin-panel__image-wrapper">
                                        <h3 class="admin-panel__block-title">Фотография</h3>
                                        <img
                                                class="admin-panel__image"
                                                src="<?=$item['img_path']?>"
                                                alt="<?=$item['name_product']?>"
                                                title="<?=$item['name_product']?>"
                                                width="127" height="207" loading="lazy"
                                        >
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Цена</h3>
                                        <h4><?=\services\Helper::addSpaceBasedOnLength($item['price'])?> р</h4>
                                        <h3 class="admin-panel__block-title">Описание</h3>
                                        <p><?=$item['description']?></p>
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Наличие</h3>
                                        <h4>
                                            <?php if ($item['amoynt_product'] == 0) {
                                                ?>Нет в наличии<?php
                                            }
                                            else {
                                                echo $item['amoynt_product'] . " шт.";
                                            }
                                            ?>
                                        </h4>
                                        <h3 class="admin-panel__block-title">О бренде</h3>
                                        <p><?=$item['name_brand_description']?></p>
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Название</h3>
                                        <h4><?=$item['name_product']?></h4>
                                        <h3 class="admin-panel__block-title">Характеристики</h3>
                                        <p>
                                            Пол: Мужские<br>
                                            Страна: <?=$item['name_country']?><br>
                                            Водостойкость: <?=$item['name_resistance']?><br>
                                            Коллекция: <?=$item['collection_name']?><br>
                                            Стиль: <?=$item['name_style']?><br>
                                        </p>
                                    </div>
                                    <div class="admin-panel__block admin-panel__block--buttons">
                                        <button class="admin-panel__button button button--modal-admin openModalUpdateProduct" data-id-product="<?=$item['id_product']?>">Изменить</button>
                                        <button class="admin-panel__button button button--modal-admin deleteProduct" data-id-product="<?=$item['id_product']?>">Удалить</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="admin-panel__female-category">
                        <header class="admin-panel__header">
                            <h2 class="admin-panel__subtitle">Женские часы</h2>
                            <div class="admin-panel__button-wrapper">
                                <button class="admin-panel__button button button--modal-admin openModalAddProduct">+ Добавить</button>
                            </div>
                        </header>
                        <div class="admin-panel__content">
                            <?php foreach (Admin::getAllProductsFemale() as $item) { ?>
                                <div class="admin-panel__content-inner">
                                    <div class="admin-panel__image-wrapper">
                                        <h3 class="admin-panel__block-title">Фотография</h3>
                                        <img
                                                class="admin-panel__image"
                                                src="<?=$item['img_path']?>"
                                                alt="<?=$item['name_product']?>"
                                                title="<?=$item['name_product']?>"
                                                width="127" height="207" loading="lazy"
                                        >
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Цена</h3>
                                        <h4><?=\services\Helper::addSpaceBasedOnLength($item['price'])?> р</h4>
                                        <h3 class="admin-panel__block-title">Описание</h3>
                                        <p><?=$item['description']?></p>
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Наличие</h3>
                                        <h4>
                                            <?php if ($item['amoynt_product'] == 0) {
                                                ?>Нет в наличии<?php
                                            }
                                            else {
                                                echo $item['amoynt_product'] . " шт.";
                                            }
                                            ?>
                                        </h4>
                                        <h3 class="admin-panel__block-title">О бренде</h3>
                                        <p><?=$item['name_brand_description']?></p>
                                    </div>
                                    <div class="admin-panel__block">
                                        <h3 class="admin-panel__block-title">Название</h3>
                                        <h4><?=$item['name_product']?></h4>
                                        <h3 class="admin-panel__block-title">Характеристики</h3>
                                        <p>
                                            Пол: Женские<br>
                                            Страна: <?=$item['name_country']?><br>
                                            Водостойкость: <?=$item['name_resistance']?><br>
                                            Коллекция: <?=$item['collection_name']?><br>
                                            Стиль: <?=$item['name_style']?><br>
                                        </p>
                                    </div>
                                    <div class="admin-panel__block admin-panel__block--buttons">
                                        <button class="admin-panel__button button button--modal-admin openModalUpdateProduct" data-id-product="<?=$item['id_product']?>">Изменить</button>
                                        <button class="admin-panel__button button button--modal-admin deleteProduct" data-id-product="<?=$item['id_product']?>">Удалить</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div id="modalAddProduct" class="modal-admin">
        <div class="modal-admin__content">
            <div class="modal-admin__close-container">
                <span id="closeModalAddProduct" class="modal-admin__close">&times;</span>
            </div>
            <div class="modal-admin__body">
                <h3 class="modal-admin__title">Добавление товара в базу данных</h3>
                <form class="modal-admin__form" action="/admin-panel/add-product" method="post" enctype="multipart/form-data">
                    <div class="modal-admin__input-wrapper">
                        <label for="">Название товара
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="text"
                                    name="name_product"
                                    placeholder="Название товара"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Цена товара
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="number"
                                    name="price"
                                    placeholder="Цена товара"
                                    minlength="1"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Категория товара
                            <select class="modal-admin__input input input--modal-admin" name="category_id" required>
                                <option value="1">Мужские часы</option>
                                <option value="2">Женские часы</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Количество товара
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="number"
                                    name="amoynt_product"
                                    placeholder="Количество товара"
                                    min="0"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Описание
                            <textarea
                                    class="modal-admin__input input input--modal-admin"
                                    name="description"
                                    placeholder="Описание товара"
                                    required
                            ></textarea>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Описание бренда
                            <select class="modal-admin__input input input--modal-admin" name="brand_description_id" required>
                                <?php foreach (Admin::getAllBrandDescriptions() as $brand) { ?>
                                    <option value="<?=$brand['id_brand_description']?>"><?=$brand['name_brand_description']?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Страна
                            <select class="modal-admin__input input input--modal-admin" name="country_id" required>
                                <option value="1">Швейцария</option>
                                <option value="2">Япония</option>
                                <option value="3">Германия</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Водостойкость
                            <select class="modal-admin__input input input--modal-admin" name="resistance_id" required>
                                <option value="1">30 метров</option>
                                <option value="2">50 метров</option>
                                <option value="3">100 метров</option>
                                <option value="4">200 метров</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Коллекция
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="text"
                                    name="collection_name"
                                    placeholder="Название коллекции"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Стиль
                            <select class="modal-admin__input input input--modal-admin" name="style_id" required>
                                <option value="1">Классический</option>
                                <option value="2">Спортивный</option>
                                <option value="3">Повседневный</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Механизм
                            <select class="modal-admin__input input input--modal-admin" name="mechanism_id" required>
                                <option value="1">Кварцевый</option>
                                <option value="2">Механический</option>
                                <option value="3">Автоматический</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Модель механизма
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="text"
                                    name="model_mechaism"
                                    placeholder="Модель механизма"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Количество камней
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="number"
                                    name="amount_stones"
                                    placeholder="Количество камней"
                                    min="0"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Диаметр
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="number"
                                    name="diametr"
                                    placeholder="Диаметр в мм"
                                    min="0"
                                    step="0.1"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Цвет корпуса
                            <select class="modal-admin__input input input--modal-admin" name="case_color_id" required>
                                <option value="1">Серебряный</option>
                                <option value="2">Золотой</option>
                                <option value="3">Черный</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Цвет циферблата
                            <select class="modal-admin__input input input--modal-admin" name="dial_color_id" required>
                                <option value="1">Белый</option>
                                <option value="2">Черный</option>
                                <option value="3">Серебряный</option>
                            </select>
                        </label>
                    </div>
                    <div class="modal-admin__input-wrapper">
                        <label for="">Фотография товара
                            <input
                                    class="modal-admin__input input input--modal-admin"
                                    type="file"
                                    name="product_image"
                                    accept="image/*"
                                    required
                            >
                        </label>
                    </div>
                    <div class="modal-admin__button-wrapper">
                        <button class="modal-admin__button button button--modal-admin" type="submit">Добавить товар</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalUpdateProduct" class="modal-admin">
        <div class="modal-admin__content">
            <div class="modal-admin__close-container">
                <span id="closeModalUpdateProduct" class="modal-admin__close">&times;</span>
            </div>
            <div class="modal-admin__body">
                <h3 class="modal-admin__title">Изменение товара в базе данных</h3>

                    <form class="modal-admin__form" action="/admin-panel/update-product" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="productId" name="id" value="">
                        <div class="modal-admin__input-wrapper">
                            <label for="productName">Название товара
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="text"
                                        id="productName"
                                        name="name_product"
                                        placeholder="Название товара"
                                        value=""
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productPrice">Цена товара
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="number"
                                        id="productPrice"
                                        name="price"
                                        placeholder="Цена товара"
                                        value=""
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productCategory">Категория товара
                                <select class="modal-admin__input input input--modal-admin" id="productCategory" name="category_id" required>
                                    <option value="1">Мужские часы</option>
                                    <option value="2">Женские часы</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productAmount">Наличие товара
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="number"
                                        id="productAmount"
                                        name="amoynt_product"
                                        placeholder="Наличие товара"
                                        value=""
                                        min="0"
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productDescription">Описание
                                <textarea
                                        class="form-update-product__textarea input input--textarea-modal-admin"
                                        id="productDescription"
                                        name="description"
                                        placeholder="Описание"
                                        required
                                        cols="30"
                                        rows="10"
                                ></textarea>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="brand_description_id">Описание бренда
                                <select class="modal-admin__input input input--modal-admin" id="brand_description_id" name="brand_description_id" required>
                                    <?php foreach (Admin::getAllBrandDescriptions() as $brand) { ?>
                                        <option value="<?=$brand['id_brand_description']?>"><?=$brand['name_brand_description']?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productCountry">Страна
                                <select class="modal-admin__input input input--modal-admin" id="productCountry" name="country_id" required>
                                    <option value="1">Швейцария</option>
                                    <option value="2">Япония</option>
                                    <option value="3">Германия</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="waterResistance">Водостойкость
                                <select class="modal-admin__input input input--modal-admin" id="waterResistance" name="resistance_id" required>
                                    <option value="1">30 метров</option>
                                    <option value="2">50 метров</option>
                                    <option value="3">100 метров</option>
                                    <option value="4">200 метров</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productCollectionName">Коллекция
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="text"
                                        id="productCollectionName"
                                        name="collection_name"
                                        placeholder="Коллекция"
                                        value=""
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productStyle">Стиль
                                <select class="modal-admin__input input input--modal-admin" id="productStyle" name="style_id" required>
                                    <option value="1">Классический</option>
                                    <option value="2">Спортивный</option>
                                    <option value="3">Повседневный</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productMechanism">Механизм
                                <select class="modal-admin__input input input--modal-admin" id="productMechanism" name="mechanism_id" required>
                                    <option value="1">Кварцевый</option>
                                    <option value="2">Механический</option>
                                    <option value="3">Автоматический</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productModelMechaism">Модель механизма
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="text"
                                        id="productModelMechaism"
                                        name="model_mechaism"
                                        placeholder="Модель механизма"
                                        value=""
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="amountStones">Количество камней
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="number"
                                        id="amountStones"
                                        name="amount_stones"
                                        placeholder="Количество камней"
                                        value=""
                                        min="0"
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productDiametr">Диаметр
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="number"
                                        id="productDiametr"
                                        name="diametr"
                                        placeholder="Диаметр в мм"
                                        value=""
                                        min="0"
                                        step="0.1"
                                        required
                                >
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productCaseColor">Цвет корпуса
                                <select class="modal-admin__input input input--modal-admin" id="productCaseColor" name="case_color_id" required>
                                    <option value="1">Серебряный</option>
                                    <option value="2">Золотой</option>
                                    <option value="3">Черный</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productDialColor">Цвет циферблата
                                <select class="modal-admin__input input input--modal-admin" id="productDialColor" name="dial_color_id" required>
                                    <option value="1">Белый</option>
                                    <option value="2">Черный</option>
                                    <option value="3">Серебряный</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-admin__input-wrapper">
                            <label for="productImage">Фотография товара
                                <input
                                        class="modal-admin__input input input--modal-admin"
                                        type="file"
                                        id="productImage"
                                        name="product_image"
                                        accept="image/*"
                                >
                            </label>
                        </div>
                        <div class="modal-admin__button-wrapper">
                            <button class="modal-admin__button button button--modal-admin" type="submit">Изменить товар</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
    <script defer src="public/assets/js/admin-modal.js"></script>
    <script defer src="public/assets/js/jquery-3.7.1.min.js"></script>