<?php
?>
<main class="content">
    <section class="section container">
        <div class="section__body">
            <div class="catalog">
                <h1 class="catalog__title">
                    <?php if (isset($selectedBrand)): ?>
                        Часы <?= htmlspecialchars($selectedBrand) ?>
                    <?php else: ?>
                        Каталог часов
                    <?php endif; ?>
                </h1>
                
                <!-- Search and filters wrapper -->
                <div class="catalog__filters-wrapper">
                    <!-- Search form -->
                    <div class="catalog__search">
                        <input type="text" id="searchInput" class="catalog__search-input" placeholder="Поиск часов по названию">
                    </div>

                    <!-- Filters -->
                    <div class="catalog__filters">
                        <div class="catalog__filter-group">
                            <label class="catalog__filter-label">Категория</label>
                            <select class="catalog__filter-select" id="categoryFilter">
                                <option value="all">Все категории</option>
                                <option value="Мужские">Мужские</option>
                                <option value="Женские">Женские</option>
                            </select>
                        </div>
                        <div class="catalog__filter-group">
                            <label class="catalog__filter-label">Наличие</label>
                            <select class="catalog__filter-select" id="availabilityFilter">
                                <option value="all">Все</option>
                                <option value="in_stock">В наличии</option>
                                <option value="out_of_stock">Нет в наличии</option>
                            </select>
                        </div>
                        <div class="catalog__filter-group">
                            <label class="catalog__filter-label">Цена</label>
                            <select class="catalog__filter-select" id="priceFilter">
                                <option value="all">Любая</option>
                                <option value="10000-30000">10 000 - 30 000 ₽</option>
                                <option value="30000-50000">30 000 - 50 000 ₽</option>
                                <option value="50000+">Более 50 000 ₽</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="catalog__content">
                    <ul class="catalog__list">
                        <?php foreach ($data as $item) { ?>
                            <li class="catalog__item" 
                                data-category="<?=$item['name_category']?>"
                                data-availability="<?=$item['amoynt_product'] > 0 ? 'in_stock' : 'out_of_stock'?>"
                                data-price="<?=$item['price']?>">
                                <article class="product-card">
                                    <a class="product-card__link" href="product-single.php?id=<?=$item['id_product']?>" title="Перейти на страницу товара <?=$item['name_product']?> и посмотреть характеристики..">
                                        <img
                                                class="product-card__image"
                                                src="<?=$item['img_path']?>"
                                                alt="<?=$item['name_product']?>"
                                                width="201" height="328" loading="lazy"
                                        >
                                    </a>
                                    <div class="product-card__body">
                                        <h2 class="product-card__title"><?=$item['name_product']?></h2>
                                        <span class="product-card__condition">
                                        <?php if ($item['amoynt_product'] == 0) {
                                            ?>Нет в наличии<?php
                                        }
                                        else {
                                            ?>В наличии<?php
                                        }
                                        ?>
                                        </span>
                                        <div class="product-card__cart-inner">
                                            <span class="product-card__price"><?=\services\Helper::addSpaceBasedOnLength($item['price'])?> р</span>
                                            <?php
                                            if($item['amoynt_product'] != 0) {
                                                $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null';
                                                    ?>
                                                    <button onclick="addToCart(<?=$item['id_product']?>, '<?=addslashes($item['name_product'])?>', <?=$item['price']?>, '<?=$userId?>', '<?=$item['img_path']?>', 
                                                        <?=$item['amoynt_product']?>)" class="product-card__button button button--in-cart-catalog" type="submit" title="Добавить товар в корзину">В корзину</button>
                                                    <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const availabilityFilter = document.getElementById('availabilityFilter');
    const priceFilter = document.getElementById('priceFilter');
    const catalogItems = document.querySelectorAll('.catalog__item');

    function filterItems() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value;
        const selectedAvailability = availabilityFilter.value;
        const selectedPrice = priceFilter.value;

        catalogItems.forEach(item => {
            const productName = item.querySelector('.product-card__title').textContent.toLowerCase();
            const category = item.dataset.category;
            const availability = item.dataset.availability;
            const price = parseInt(item.dataset.price);

            // Search filter
            const matchesSearch = productName.includes(searchTerm);

            // Category filter
            const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

            // Availability filter
            const matchesAvailability = selectedAvailability === 'all' || availability === selectedAvailability;

            // Price filter
            let matchesPrice = true;
            if (selectedPrice !== 'all') {
                if (selectedPrice === '50000+') {
                    matchesPrice = price >= 50000;
                } else {
                    const [min, max] = selectedPrice.split('-').map(val => parseInt(val));
                    matchesPrice = price >= min && price <= max;
                }
            }

            // Show/hide item based on all filters
            if (matchesSearch && matchesCategory && matchesAvailability && matchesPrice) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Add event listeners
    searchInput.addEventListener('input', filterItems);
    categoryFilter.addEventListener('change', filterItems);
    availabilityFilter.addEventListener('change', filterItems);
    priceFilter.addEventListener('change', filterItems);
});
</script>

<script defer src="public/assets/js/cart-view.js"></script> 