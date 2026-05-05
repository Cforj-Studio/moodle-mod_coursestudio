<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Russian language strings for mod_coursestudio.
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

$string['name'] = 'Название активности';
$string['coursesettings'] = 'Настройки Course Studio';
$string['courseid'] = 'ID курса';
$string['courseid_help'] = 'UUID курса в Course Studio. Найдите его в настройках курса или в URL.';
$string['iframeheight'] = 'Высота плеера (px)';
$string['gradeenabled'] = 'Включить оценивание';
$string['grademax'] = 'Максимальная оценка';
$string['grademaxerror'] = 'Максимальная оценка должна быть не менее 1';

$string['apiurl'] = 'URL Course Studio';
$string['apiurl_desc'] = 'Базовый URL вашего экземпляра Course Studio (например, https://app.cforj.studio)';
$string['apikey'] = 'API ключ';
$string['apikey_desc'] = 'API ключ для межсерверного взаимодействия (опционально, используется для обратных вызовов оценок)';
$string['defaultheight'] = 'Высота плеера по умолчанию';
$string['defaultheight_desc'] = 'Высота iframe по умолчанию в пикселях для новых активностей';

$string['coursestudio:addinstance'] = 'Добавить активность Course Studio';
$string['coursestudio:view'] = 'Просматривать активность Course Studio';
$string['coursestudio:grade'] = 'Оценивать активность Course Studio';

$string['eventcoursemoduleviewed'] = 'Модуль курса просмотрен';
$string['submitgrade'] = 'Отправить оценку';
$string['submitgrade_description'] = 'Отправляет оценку из плеера Course Studio в журнал оценок Moodle.';

$string['privacy:metadata'] = 'Плагин Course Studio не хранит персональные данные в своих таблицах.';
$string['privacy:metadata:core_grades'] = 'Данные об оценках хранятся в журнале оценок Moodle через подсистему core_grades.';
$string['privacy:metadata:core_completion'] = 'Данные о завершении активности управляются подсистемой завершения Moodle.';
