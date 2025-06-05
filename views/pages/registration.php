<?php
?>
<main class="content">
    <section class="section container">
        <div class="section__body section__body--non-border">
            <div class="registration">
                <div class="registration__content">
                    <h1 class="registration__title">Регистрация</h1>
                    <form class="form-registration" action="/auth/registration" method="post" id="registerForm">
                        <div class="form-registration__wrapper">
                            <label class="visually-hidden" for="email">Электронная почта</label>
                            <input
                                    class="form-registration__input input"
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="E-mail"
                                    minlength="3"
                                    required
                            >
                        </div>
                        <div class="form-registration__wrapper form-registration-min">
                            <label class="visually-hidden" for="FIO">Имя</label>
                            <input
                                    class="form-registration__input input"
                                    type="text"
                                    id="firstName"
                                    name="firstName"
                                    placeholder="Имя"
                                    minlength="3"
                                    required
                            >
<!--                            <div class="error" id="firstName_error"></div>-->
                            <label class="visually-hidden" for="lastName">Фамилия</label>
                            <input
                                    class="form-registration__input input"
                                    type="text"
                                    id="lastName"
                                    name="lastName"
                                    placeholder="Фамилия"
                                    minlength="3"
                                    required
                            >
<!--                            <div class="error" id="lastName_error"></div>-->
                        </div>
                        <div class="form-registration__wrapper">
                            <label class="visually-hidden" for="phone">Номер телефона</label>
                            <input
                                    class="form-registration__input input"
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    placeholder="Номер телефона"
                                    pattern="[0-9]{11}"
                                    title="Введите номер телефона в формате 89991234567"
                                    required
                            >
                            <div class="error" id="phone_error"></div>
                        </div>
                        <div class="form-registration__wrapper">
                            <label class="visually-hidden" for="password">Пароль</label>
                            <input
                                    class="form-registration__input input"
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Пароль"
                                    minlength="8"
                                    maxlength="32"
                                    required
                            >
                            <div class="error" id="password_error"></div>
                            <div id="password-hint" class="hint">
                                Пароль должен содержать минимум 8 символов, включая цифры, буквы и специальные символы.
                            </div>
                        </div>
                        <div class="form-registration__wrapper">
                            <label class="visually-hidden" for="password_confirmation">Подтверждение пароля</label>
                            <input
                                    class="form-registration__input input"
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Подтверждение пароля"
                                    minlength="8"
                                    maxlength="32"
                                    required
                            >
                            <div class="error" id="password_confirmation_error"></div>
                        </div>
                        <div class="form-registration__button-wrapper">
                            <button id="reg-button" class="form-registration__button button" type="submit">
                                Зарегистрироваться
                            </button>
                        </div>
                    </form>
                    <span class="registration__question">Уже есть аккаунт?</span>
                    <a class="registration__link button button--small" href="/log-in">Войти</a>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="/public/assets/js/validation.js"></script>
