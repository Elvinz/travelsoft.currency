# travelsoft.currency
Конвертер валюты для Bitrix Framework

## Установка модуля
Для установки модуля необходимо скопировать папку модуля или склонировать репозиторий 
в директорию /local/modules сайта командой
```
git clone https://github.com/dimabresky/travelsoft.currency.git version-2.0
```
Затем необходимо в административной панели сайта перейти в Marketplace->Установленные решения
и установить Модуль валюты

![Шаг установки 1](https://github.com/dimabresky/travelsoft.currency/raw/dev/img/install_1.png)

Следующим шагом нужно указать ISO код национальной валюты (по-умолчанию BYN)
и ISO коды остальных валют и их курсы и нажать кнопку далее

![Шаг установки 2](https://github.com/dimabresky/travelsoft.currency/raw/dev/img/install_2.png)

Все!!!! Установка модуля завершена.

Можно настроить модуль ( Настройки->настройки модулей->модуль валюты)
![Шаг установки 3](https://github.com/dimabresky/travelsoft.currency/raw/dev/img/install_3.png)

## Использование модуля
После установки модуля доступно API для использования конвертера валюты
и компонент переключения валюты на сайте

![Шаг установки 3](https://github.com/dimabresky/travelsoft.currency/raw/dev/img/install_3.png)

Данный компонент устанавливает и запоминает текущую валюту для пользователя и инициализирует
конвертер валюты в зависимости от установленной валюты.

![Компонент](https://github.com/dimabresky/travelsoft.currency/raw/dev/img/use_1.png)

Для того чтобы использовать конвертер его необходимо вызвать вот так:
```php

    // При необходимости подключаем модуль
    \Bitrix\Main\Loader::includeModule('travelsoft.booking');

    //
    // Получаем конвертер валюты, используя фабрику конвертера и метод getInstance
    //
    // Вызываем метод convert:
    // Первый параметр - значение для конвертации
    // Второй параметр - iso код валюты из которой необходимо сконвертировать
    // Третий параметр - ISO код валюты в которую необходимо сконвертировать. Если не указать,
    // то значение будет сконвертировано в текущую установленную валюту.
    // 
    // Для получения результата необходимо вызвать метод getResult (он возвращает результат в виде отформатированной строки)
    // или getResultLikeArray (он возвращает результат в виде массива array("price" => значение, "ISO" => ISO код валюты))
    //
    // Также API предоставляет функцию \travelsoft\currency\format() для полуния отформатированной строки
    // подробности смотреть в файле lib/functions.php модуля
    //
    \travelsoft\currency\factory\Converter::getInstance()->convert(100, "BYN", "USD")->getResult();

```

Также модуль позволяет выгружать валюту из нац. банка РБ (можно повесить на крон)
``````php

    // При необходимости подключаем модуль
    \Bitrix\Main\Loader::includeModule('travelsoft.booking');

    //
    // Получаем валюту из нац. банка
    //
    \travelsoft\currency\CurrencyImporterCurrencyImporter::importFromNationalBankRepablicOfBelarus()->convert(100, "BYN", "USD")->getResult();

```





