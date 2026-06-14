# Woman Conference

Сайт ежегодной женской конференции «Крепость и красота - одежда её».

Проект сделан на Vue 3 + Vuetify.

## Что такое Vite

Vite — это инструмент, который запускает Vue-проект во время разработки и собирает готовую папку `dist` для хостинга.

Обычно нужны только три команды:

```bash
npm install
npm run dev
npm run build
```

## Запуск

```bash
npm install
npm run dev
```

После запуска в терминале появится локальная ссылка, обычно `http://localhost:5173/`.

## Сборка для сайта

```bash
npm run build
```

Готовые файлы появятся в папке `dist`.

## Картинки и шрифты

Нужно перенести папку `assets` из старого сайта в:

```text
public/assets
```

Например:

```text
public/assets/img/larisa.png
public/assets/img/elenahuda.png
public/assets/img/julia.png
public/assets/img/galina.png
public/assets/img/tatjana.png
public/assets/img/time-img.jpg
public/assets/img/bg.jpg
public/assets/cache_image/assets/img/main/bg.jpg
public/assets/fonts/miama.ttf
public/assets/fonts/grav.ttf
```

## Важно

Файл `mail.php` пока является заглушкой. Для реальной отправки формы его нужно отдельно настроить под хостинг и почту.
