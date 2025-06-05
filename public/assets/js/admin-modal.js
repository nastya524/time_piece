const modalAddProduct = document.getElementById('modalAddProduct'); // Получить модальное окно
const closeModalBtnAddProduct = document.getElementById("closeModalAddProduct"); // Получить кнопку закрытия модального окна
let scrollPosition; // Переменная для сохранения позиции прокрутки при открытии модального окна

// При клике на кнопку закрытия, скрываем модальное окно
closeModalBtnAddProduct.onclick = function() {
    closeModal(modalAddProduct);
}

// Функция для закрытия модального окна
const closeModal = (modal) => {
    setTimeout(function() {
        modal.style.display = "none";
    }, 200);
    document.body.removeAttribute('class'); // Возобновляем прокрутку
    let scrollPos = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--scroll-position'));
    window.scrollTo(0, scrollPos); // Восстанавливаем позицию прокрутки
    document.documentElement.removeAttribute('style');
}

// // Закрытие модального окна при клике вне него
// window.onclick = function(event) {
//     if (event.target === modalAddProduct) {
//         closeModal(modalAddProduct);
//     }
// }

// При открытии модального окна сохраняем текущую позицию прокрутки
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('openModalAddProduct')) {
        scrollPosition = document.documentElement.scrollTop || window.pageYOffset;
        document.body.classList.add('no-scroll'); // Останавливаем прокрутку
        setTimeout(function() {
            modalAddProduct.style.display = "block";
        }, 150);
        document.documentElement.style.setProperty('--scroll-position', scrollPosition + 'px'); // Сохраняем позицию прокрутки в переменной --scroll-position
        window.scrollTo(0, scrollPosition); // Восстанавливаем позицию прокрутки
    }
});

const modalUpdateProduct = document.getElementById('modalUpdateProduct'); // Получить модальное окно
const closeModalBtnUpdateProduct = document.getElementById("closeModalUpdateProduct"); // Получить кнопку закрытия модального окна

// При клике на кнопку закрытия, скрываем модальное окно
closeModalBtnUpdateProduct.onclick = function() {
    closeModal(modalUpdateProduct);
}


// Закрытие модального окна при клике вне него
window.onclick = function(event) {
    if (event.target === modalUpdateProduct) {
        closeModal(modalUpdateProduct);
    }
    if (event.target === modalAddProduct) {
        closeModal(modalAddProduct);
    }
}

// При открытии модального окна сохраняем текущую позицию прокрутки
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('openModalUpdateProduct')) {
        const productId = event.target.getAttribute('data-id-product');
        console.log('Loading product with ID:', productId); // Отладочная информация
        
        $.ajax({
            type: "POST",
            url: "/getOneProduct",
            data: {
                'id': productId
            },
            success: function(res) {
                console.log('Server response:', res); // Отладочная информация
                try {
                    const data = JSON.parse(res);
                    if (data.error) {
                        alert('Ошибка: ' + data.error);
                        return;
                    }
                    
                    // Заполняем форму данными
                    document.getElementById("productId").value = data.id_product;
                    document.getElementById("productName").value = data.name_product;
                    document.getElementById("productPrice").value = data.price;
                    document.getElementById("productCategory").value = data.category_id;
                    document.getElementById("productAmount").value = data.amoynt_product;
                    document.getElementById("productDescription").value = data.description;
                    document.getElementById("brand_description_id").value = data.brand_description_id;
                    document.getElementById("productCountry").value = data.country_id;
                    document.getElementById("waterResistance").value = data.resistance_id;
                    document.getElementById("productCollectionName").value = data.collection_name;
                    document.getElementById("productStyle").value = data.style_id;
                    document.getElementById("productMechanism").value = data.mechanism_id;
                    document.getElementById("productModelMechaism").value = data.model_mechaism;
                    document.getElementById("amountStones").value = data.amount_stones;
                    document.getElementById("productDiametr").value = data.diametr;
                    document.getElementById("productCaseColor").value = data.case_color_id;
                    document.getElementById("productDialColor").value = data.dial_color_id;

                    // Показываем текущее изображение
                    if (data.img_path) {
                        const currentImage = document.getElementById('currentProductImage');
                        if (currentImage) {
                            currentImage.src = data.img_path;
                            currentImage.style.display = 'block';
                        }
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('Ошибка при обработке данных продукта');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', {xhr, status, error});
                alert('Ошибка при загрузке данных продукта: ' + error);
            }
        });

        scrollPosition = document.documentElement.scrollTop || window.pageYOffset;
        document.body.classList.add('no-scroll');
        setTimeout(function() {
            modalUpdateProduct.style.display = "block";
        }, 150);
        document.documentElement.style.setProperty('--scroll-position', scrollPosition + 'px');
        window.scrollTo(0, scrollPosition);
    }
});

// Обработчик для кнопки удаления
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('deleteProduct')) {
        if (confirm('Вы уверены, что хотите удалить этот продукт?')) {
            const productId = event.target.getAttribute('data-id-product');
            console.log('Deleting product with ID:', productId); // Отладочная информация
            
            $.ajax({
                type: "POST",
                url: "/deleteDataProduct",
                data: {
                    'id': productId
                },
                success: function(response) {
                    console.log('Server response:', response); // Отладочная информация
                    try {
                        const result = JSON.parse(response);
                        if (result.success) {
                            // Удаляем строку из таблицы
                            const row = event.target.closest('.admin-panel__content-inner');
                            if (row) {
                                row.remove();
                            }
                            alert('Продукт успешно удален');
                        } else {
                            alert('Ошибка при удалении продукта: ' + (result.error || 'Неизвестная ошибка'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        alert('Ошибка при обработке ответа сервера');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', {xhr, status, error}); // Отладочная информация
                    alert('Ошибка при удалении продукта: ' + error);
                }
            });
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Обработчик отправки формы обновления продукта
    const updateForm = document.querySelector('form[action="/admin-panel/update-product"]');
    if (updateForm) {
        updateForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            $.ajax({
                type: "POST",
                url: "/admin-panel/update-product",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Server response:', response);
                    try {
                        const result = JSON.parse(response);
                        if (result.success) {
                            alert('Продукт успешно обновлен');
                            window.location.reload();
                        } else {
                            alert('Ошибка при обновлении продукта: ' + (result.error || 'Неизвестная ошибка'));
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        console.error('Raw response:', response);
                        alert('Ошибка при обработке ответа сервера. Проверьте консоль для деталей.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', {xhr, status, error});
                    console.error('Response text:', xhr.responseText);
                    alert('Ошибка при обновлении продукта: ' + error);
                }
            });
        });
    }
});