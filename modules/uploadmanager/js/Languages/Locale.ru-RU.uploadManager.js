/*
---
name: Locale.ru-RU.uploadManager
description: Russian Language File for uploadManager
authors: Thierry Bela
requires: [More/Locale]
provides: Locale.ru-RU.uploadManager
...
*/

Locale.define('ru-RU', 'uploadManager', {
    BROWSE: 'Обзор',
    CANCEL: 'Отмена',
	DROP_FILE_HERE: 'Для загрузки переместите сюда файлы',
	EMPTY_FILE: 'Выбранный вами файл пуст',
	FILE_CORRUPTED: 'Файл поврежден',
    MAX_FILE_SIZE_EXCEEDED: function (size) {
	
		return 'Слишком большой файл (размер должен быть не более ' + size + ')'
	},
	PAUSE: 'Пауза',
	PREFETCH_FAILED: 'Невоможно получить информацию о файле',
	RESUME: 'Продолжить',
	RETRY: 'Повторить',
    TOTAL_FILES_SIZE_EXCEEDED: function (size) {
	
		return 'Общий размер файлов должен быть не более ' + size + ''
	},
	UPLOADING: 'Загрузка, пожайлуста подождите ...',
    UNAUTHORIZED_FILE_TYPE: 'Неверный формат файла'
});
