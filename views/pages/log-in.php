<?php
    use services\Helper;
    Helper::checkUser();
?>
    <main class="content">
        <section class="section container">
            <div class="section__body section__body--non-border">
                <div class="log-in">
                    <div class="log-in__content">
                        <h1 class="log-in__title">Авторизация</h1>

                        <form class="form-log-in" action="/auth/login" method="post">
                            <div class="form-log-in__wrapper">
                                <label class="visually-hidden" for="email">Электронная почта</label>
                                <input
                                        class="form-log-in__input input"
                                        type="email"
                                        name="email"
                                        placeholder="E-mail"
                                        minlength="3"
                                        value="<?php echo Helper::old('email') ?>"
                                    <?= Helper::validationErrorAttr('email'); ?>
                                        required
                                >

                            </div>
                            <div class="form-log-in__wrapper">
                                <label class="visually-hidden" for="password">Пароль</label>
                                <input
                                        class="form-log-in__input input"
                                        type="password"
                                        name="password"
                                        placeholder="Пароль"
                                        maxlength="32"
                                        required
                                >
                            </div>

                            <div class="form-log-in__button-wrapper">
                                <button id="reg-button" class="form-log-in__button button" type="submit">Авторизироваться</button>
                            </div>
                        </form>
                        <span class="log-in__question">Не зарегистрированы? </span>
                        <a class="log-in__link button button--small" href="/registration">Регистрация</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    