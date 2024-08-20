### Hexlet tests and linter status:
[![Actions Status](https://github.com/asd1xx/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/asd1xx/php-project-48/actions)
[![asd1xx-check](https://github.com/asd1xx/php-project-48/actions/workflows/asd1xx-check.yml/badge.svg)](https://github.com/asd1xx/php-project-48/actions/workflows/asd1xx-check.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/ea31183dd3cfc6fd30b4/maintainability)](https://codeclimate.com/github/asd1xx/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/ea31183dd3cfc6fd30b4/test_coverage)](https://codeclimate.com/github/asd1xx/php-project-48/test_coverage)

# Difference Calculator (Вычислитель отличий)

## О проекте

Вычислитель отличий – программа, определяющая разницу между двумя структурами данных. Это популярная задача, для решения которой существует множество онлайн-сервисов, например: http://www.jsondiff.com/. Подобный механизм используется при выводе тестов или при автоматическом отслеживании изменении в конфигурационных файлах.  
  
Возможности утилиты:
- Поддержка разных входных форматов: yaml и json
- Генерация отчета в виде plain text, stylish и json

## Системные требования

- Linux, MacOS
- PHP 8.3
- Composer 2.6.6

## Инструкция по установке

Выполните последовательно следующие действия:

1. Клонируем репозиторий:
    
    ```bash
    git clone git@github.com:asd1xx/php-project-48.git difference-calculator
    ```
    
2. Переходим в директорию проекта:
    
    ```bash
    cd difference-calculator
    ```
    
3. Устанавливаем зависимости:
    
    ```bash
    make install
    ```
    
4. Добавляем права на исполнение файлов в директории bin:
    
    ```bash
    chmod +x ./bin/*
    ```

## Запуск программы

Команды для запуска:

- `./bin/gendiff -h` — вывод справки.
- `./bin/gendiff file1.json file2.json` — сравнение файлов формата json.
- `./bin/gendiff file1.yml file2.yml` — сравнение файлов формата yaml.

## Демонстрация

### Вывод справки
#### ./bin/gendiff -h
[![asciicast](https://asciinema.org/a/W5xFnM1k43orI0VKgK5OpX9AJ.svg)](https://asciinema.org/a/W5xFnM1k43orI0VKgK5OpX9AJ)
  
### Пример сравнения файлов формата json
#### ./bin/gendiff tests/fixtures/json-file1.json tests/fixtures/json-file2.json
[![asciicast](https://asciinema.org/a/GfF6983UgE6V9Bw92qNnD9KiY.svg)](https://asciinema.org/a/GfF6983UgE6V9Bw92qNnD9KiY)
  
### Пример сравнения файлов формата yaml
#### ./bin/gendiff tests/fixtures/yaml-file1.yml tests/fixtures/yaml-file2.yml
[![asciicast](https://asciinema.org/a/oJTvWcADNMcJC8E9VMAr2gi73.svg)](https://asciinema.org/a/oJTvWcADNMcJC8E9VMAr2gi73)
