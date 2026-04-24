<?php
/**
 * Russian language strings for mod_coursestudio
 *
 * @package    mod_coursestudio
 * @copyright  2026 cforj.studio
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename'] = 'Course Studio';
$string['modulenameplural'] = 'Активности Course Studio';
$string['modulename_help'] = 'Встраивайте интерактивные курсы Course Studio прямо в Moodle. Поддержка авторесайза, оценок и отслеживания завершения.';
$string['pluginname'] = 'Course Studio';
$string['pluginadministration'] = 'Администрирование Course Studio';

// Поля формы.
$string['name'] = 'Название активности';
$string['coursesettings'] = 'Настройки Course Studio';
$string['courseid'] = 'ID курса';
$string['courseid_help'] = 'UUID курса в Course Studio. Найдите его в настройках курса или в URL.';
$string['iframeheight'] = 'Высота плеера (px)';
$string['gradeenabled'] = 'Включить оценивание';
$string['grademax'] = 'Максимальная оценка';
$string['grademaxerror'] = 'Максимальная оценка должна быть не менее 1';

// Настройки администратора.
$string['apiurl'] = 'URL Course Studio';
$string['apiurl_desc'] = 'Базовый URL вашего экземпляра Course Studio (например, https://app.cforj.studio)';
$string['apikey'] = 'API ключ';
$string['apikey_desc'] = 'API ключ для межсерверного взаимодействия (опционально, используется для обратных вызовов оценок)';
$string['defaultheight'] = 'Высота плеера по умолчанию';
$string['defaultheight_desc'] = 'Высота iframe по умолчанию в пикселях для новых активностей';

// Права доступа.
$string['coursestudio:addinstance'] = 'Добавить активность Course Studio';
$string['coursestudio:view'] = 'Просматривать активность Course Studio';
$string['coursestudio:grade'] = 'Оценивать активность Course Studio';

// Конфиденциальность.
$string['privacy:metadata'] = 'Плагин Course Studio не хранит персональные данные локально. Данные о завершении и оценках управляются ядром Moodle.';
