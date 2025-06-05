<main class="content">
    <!-- Слайдер -->
    <section class="section container">
        <div class="section__body">
            <div class="hero">
                <div class="hero__content">
                    <h1 class="hero__title visually-hidden">Главная страница сайта "<span lang="en">TimePiece Palace</span>"</h1>
                    <div class="hero-slider">
                        <?php
                        // Массив с данными для слайдера
                        $sliderItems = [
                            [
                                'image' => 'public/assets/media/img/slider/slider-1.jpg',
                                'id' => 8
                            ],
                            [
                                'image' => 'public/assets/media/img/slider/slider-2.jpg',
                                'id' => 13
                            ],
                            [
                                'image' => 'public/assets/media/img/slider/slider-3.jpg',
                                'id' => 3
                            ],
                            [
                                'image' => 'public/assets/media/img/slider/slider-4.jpg',
                                'id' => 11
                            ],
                            [
                                'image' => 'public/assets/media/img/slider/slider-5.jpg',
                                'id' => 4
                            ]
                        ];

                        foreach ($sliderItems as $item): ?>
                            <div class="hero-slider__slide">
                                <a href="/product-single.php?id=<?= $item['id'] ?>">
                                    <img src="<?= $item['image'] ?>"
                                         alt=""
                                         width="1336" height="447" loading="lazy">
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <button class="hero-slider__button hero-slider__button--prev" aria-label="Предыдущий слайд">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button class="hero-slider__button hero-slider__button--next" aria-label="Следующий слайд">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="hero-slider__dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- О магазине -->
    <section class="section container">
        <div class="section__body">
            <div class="about-store">
                <div class="about-store__content">
                    <img
                        class="about-store__img"
                        src="public/assets/media/img/home/about-store.jpg"
                        alt="Интернет-магазин наручных часов TimePiece Palace"
                        width="510" height="398" loading="lazy"
                    >
                    <div class="about-store__body">
                        <h2 class="about-store__title">Интернет-магазин наручных часов <span lang="en">TimePiece Palace</span></h2>
                        <p class="about-store__description">
                            Добро пожаловать в <span lang="en">TimePiece Palace</span> — вашу врата в мир элегантности и роскоши наручных часов<br><br>

                            Наши часы — это не просто инструмент для отслеживания времени, это выражение вашего стиля и индивидуальности. Мы гордимся предлагать широкий ассортимент моделей для любого вкуса и повода: от утонченных деловых часов до ярких спортивных моделей<br><br>

                            В нашем магазине вы найдете коллекции от мировых брендов, таких как <span lang="en">Rolex, TAG Heuer, Omega</span> и многих других, гарантируя вам высочайшее качество и непревзойденный стиль.<br>
                            Доверьтесь нам, чтобы сделать каждый момент вашей жизни неповторимым и стильным
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Блок с двумя изображениями -->
    <section class="section container">
        <div class="section__body">
            <div class="novelty">
                <h2 class="novelty__title">Популярные часы</h2>
                <div class="novelty__content">
                    <ul class="novelty__block-list">
                        <li class="novelty__block-item">
                            <a href="/product-single.php?id=6">
                                <img
                                    class="novelty__block-img"
                                    src="public/assets/media/img/home/novelty/novelty-1.jpg"
                                    alt="Rolex Submariner HD"
                                    width="658" height="495" loading="lazy"
                                >
                                <h3 class="novelty__block-title"><span lang="en">Rolex CMT-MASTER II</span></h3>
                            </a>
                        </li>
                        <li class="novelty__block-item">
                            <a href="/product-single.php?id=9">
                                <img
                                    class="novelty__block-img"
                                    src="public/assets/media/img/home/novelty/novelty-2.jpg"
                                    alt="Rosini Automatic"
                                    width="658" height="495" loading="lazy"
                                >
                                <h3 class="novelty__block-title"><span lang="en">TISSOT PR100</span></h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Условия доставки, оплаты, гарантия -->
    <section class="section container">
        <div class="section__body ">
            <div class="features">
                <div class="features__content">
                    <h2 class="features_title visually-hidden">Преимущества интернет-магазина "<span lang="en">TimePiece Palace</span>"</h2>
                    <ul class="features__card-list">
                        <li class="features__card-item">
                            <a href="/delivery.php">
                                <img
                                    class="features__card-img"
                                    src="public/assets/media/svg/home/features/free-delivery.svg"
                                    alt=""
                                    width="126" height="70" loading="lazy"
                                >
                                <h3 class="features__card-title">Условия доставки</h3>
                                <p class="features__card-description">Быстрая доставка или самовывоз из пунктов </p>
                            </a>
                        </li>
                        <li class="features__card-item">
                            <a href="/payment.php">
                                <img
                                    class="features__card-img"
                                    src="public/assets/media/svg/home/features/payment.svg"
                                    alt=""
                                    width="70" height="70" loading="lazy"
                                >
                                <h3 class="features__card-title">Условия оплаты</h3>
                                <p class="features__card-description">Оплата при получении</p>
                            </a>
                        </li>
                        <li class="features__card-item">
                            <a href="/warranty.php">
                                <img
                                    class="features__card-img"
                                    src="public/assets/media/svg/home/features/official-warranty.svg"
                                    alt=""
                                    width="70" height="70" loading="lazy"
                                >
                                <h3 class="features__card-title">Официальная гарантия</h3>
                                <p class="features__card-description">На весь ассортимент</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

