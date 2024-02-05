Тестовое задание на вакансию 
PHP Developer

Используемые технологии
PHP 8+
Laravel 9+
PostgreSQL
Задача
Необходимо на базе фреймворка Laravel сделать REST API приложение которое реализует следующий функционал:
Работа с пользователями:
Регистрация.
Обязательные поля:
email (проверка на валидность формата)
username (только символы латинского алфавита)
Необязательные поля:
Имя
Получение информации об авторизованном пользователем.
Здесь и далее, пользователь является авторизованным, если в запросе присутствует заголовок User-Id со значением равным ID пользователя от которого должно выполняться действие. 
В ответе должны возвращаться следующие данные:
id
email
username
name
Редактирование данных авторизованного пользователя.
Пользователь должен иметь возможность редактировать свои username и имя.
Удаление пользователя.
В системе не может быть зарегистрировано два одинаковых email или username.
Работа с сервисом https://the-one-api.dev/documentation:
Раз в 3 часа собирать 3 страницы фильмов из /movie
Сохранять name и budgetInMillions
В базе не должно быть повторяющихся фильмов
Работа с сохраненными фильмами
Вывод всех сохраненных в базе фильмов с постраничной навигацией. По дефолту отдавать первые 10 фильмов
У пользователей должна быть возможность добавления фильмов в избранное.
У пользователя должна быть возможность удаления фильмов из избранного
Должен быть отдельный эндпоинт для вывода всех фильмов, которых у пользователя нет в избранном. В запросе должен передаваться query параметр loaderType. Должно быть реализовано 2 сервиса по поиску фильмов которых нет в избранном:
С использованием SQL запроса для выборки
(loaderType=sql)
В памяти приложения. Загрузить список всех фильмов и список избранных фильмов пользователя, и среди всех найти те, которых нет в избранном
(loaderType=inMemory)


Структуру базы, эндпоинты, успешные и неуспешные ответы сервиса продумать самостоятельно.
В случае возникновения исключений во время запроса, должен возвращаться json ответ {“error”: “INTERNAL_ERROR”} и статус 500
