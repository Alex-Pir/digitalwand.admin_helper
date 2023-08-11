<?php

namespace DigitalWand\AdminHelper\Widget;

class DateWidget extends DateTimeWidget
{
    /**
     * Генерирует HTML для редактирования поля
     * @see AdminEditHelper::showField();
     * @return mixed
     */
    protected function getEditHtml()
    {
        return \CAdminCalendar::CalendarDate($this->getEditInputName(), ConvertTimeStamp(strtotime($this->getValue())), 10, true);
    }

    /**
     * Генерирует HTML для поля в списке
     * @see AdminListHelper::addRowCell();
     * @param CAdminListRow $row
     * @param array $data - данные текущей строки
     * @return mixed
     */
    public function generateRow(&$row, $data)
    {
        if (isset($this->settings['EDIT_IN_LIST']) AND $this->settings['EDIT_IN_LIST'])
        {
            $row->AddCalendarField($this->getCode());
        }
        else
        {
            $arDate = ParseDateTime($this->getValue());

            if ($arDate['YYYY'] < 10)
            {
                $stDate = '-';
            }
            else
            {
                $stDate = ConvertDateTime($this->getValue(), "DD.MM.YYYY", "ru");
            }

            $row->AddViewField($this->getCode(), $stDate);
        }
    }
}