    <main class="content">
        <section class="section container">
            <div class="section__body">
                <div class="product-single">
                    <header class="product-single__header">
                        <span class="product-single__category-name"><?=$data['name_category']?> - <?=$data['name_product']?></span>
                    </header>
                    <div class="product-single__content">
                        <div class="product-single__images-wrapper">
                            <div class="product-single__image-wrapper product-single__image-wrapper--small">
                                <img class="product-single__image "
                                        src="<?=$data['img_path']?>"
                                        alt="<?=$data['name_product']?>"
                                        width="57" height="94" loading="lazy"
                                >
                            </div>
                            <div class="product-single__image-wrapper">
                                <img class="product-single__image"
                                     src="<?=$data['img_path']?>"
                                     alt="<?=$data['name_product']?>"
                                     width="258" height="413" loading="lazy"
                                >
                            </div>
                        </div>
                        <div class="product-single__body">
                            <h1 class="product-single__title">Наручные часы <?=$data['name_product']?></h1>
                            <div class="product-single__condition">
                                <span><?=$data['name_category']?></span>
                                <span>
                                    <?php if ($data['amoynt_product'] == 0) {
                                            ?>Нет в наличии<?php
                                            }
                                        else {
                                            ?>В наличии<?php
                                        }
                                     ?>
                                </span>
                            </div>
                            <span class="product-single__price"><?=\services\Helper::addSpaceBasedOnLength($data['price'])?> р</span>
                            <?php
                            if($data['amoynt_product'] != 0){
                                $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null';
                                    ?>
                                    <div class="product-single__in-cart">
                                    <button onclick="addToCart(<?=$data['id_product']?>, '<?=addslashes($data['name_product'])?>', <?=$data['price']?>, '<?=$userId?>', '<?=$data['img_path']?>', 
                                        <?=$data['amoynt_product']?>)" class="product-single__button button button--in-cart" type="submit" title="Добавить товар в корзину">В корзину</button>
                                    </div>
                                    <?php
                            }
                            ?>
                            <div class="product-single__description">
                                <p><?=$data['description']?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section container">
            <div class="section__body">
                <div class="product-description tab">
                    <header class="product-description__header tab__nav">
                        <h2 class="product-description__tab-title"><button class="product-description__tab tab__button tab__active button button--tab" type="button" data-target-id="0">Характеристики</button></h2>
                        <h2 class="product-description__tab-title"><button class="product-description__tab tab__button button button--tab" type="button" data-target-id="1">О бренде</button></h2>
                    </header>
                    <div class="product-description__content tab__content">
                        <div class="product-description__specifications tab__pane tab__show" data-id="0">
                            <div class="product-description__specifications-inner">
                                <h3 class="product-description__characteristic">Пол:
                                    <span><?=$data['name_category']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Бренд:
                                    <span>Будет позже</span>
                                </h3>
                                <h3 class="product-description__characteristic">Страна:
                                    <span><?=$data['name_country']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Водостойкость:
                                    <span><?=$data['name_resistance']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Коллекция:
                                    <span><?=$data['collection_name']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Стиль:
                                    <span><?=$data['name_style']?></span>
                                </h3>
                            </div>
                            <div class="product-description__specifications-inner">
                                <h3 class="product-description__characteristic">Механизм:
                                    <span><?=$data['name_mechanism']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Модель механизма:
                                    <span><?=$data['model_mechaism']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Камней в механизме:
                                    <span><?=$data['amount_stones']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Диаметр корпуса:
                                    <span>
                                        <?php if ($data['diametr'] == 0) {
                                            ?>Неизвестно<?php
                                        }
                                        else {
                                            ?><?=$data['diametr']?> мм<?php
                                        }
                                        ?>
                                    </span>
                                </h3>
                                <h3 class="product-description__characteristic">Цвет корпуса:
                                    <span><?=$data['name_case_color']?></span>
                                </h3>
                                <h3 class="product-description__characteristic">Цвет циферблата:
                                    <span><?=$data['name_dial_color']?></span>
                                </h3>
                            </div>
                        </div>
                        <div class="product-description__brand tab__pane" data-id="1">
                            <p><?=$data['name_brand_description']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script defer>
            const showTab = (elementTabBtn) => {
                const elTab = elementTabBtn.closest('.tab');
                if (elementTabBtn.classList.contains('tab__active')) {
                    return;
                }
                const targetId = elementTabBtn.dataset.targetId;
                const elementTabPane = elTab.querySelector(`.tab__pane[data-id="${targetId}"]`);
                if (elementTabPane) {
                    const elementTabBtnActive = elTab.querySelector('.tab__active');
                    elementTabBtnActive.classList.remove('tab__active');
                    const elementTabPaneShow = elTab.querySelector('.tab__show');
                    elementTabPaneShow.classList.remove('tab__show');
                    elementTabBtn.classList.add('tab__active');
                    elementTabPane.classList.add('tab__show');
                }
            }

            document.addEventListener('click', (event) => {
                if (event.target && !event.target.closest('.tab__button')) {
                    return;
                }
                const elementTabBtn = event.target.closest('.tab__button');
                showTab(elementTabBtn);
            });
        </script>
    </main>
    <script defer src="public/assets/js/cart-view.js"></script>