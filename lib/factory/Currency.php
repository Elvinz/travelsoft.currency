<?php

namespace travelsoft\currency\factory;

/**
 * Фабрика для получения объекта валюты
 *
 * @author dimabresky
 * @copyright (c) 2017, travelsoft
 */
class Currency extends \travelsoft\currency\interfaces\Factory{
        
    public static function getInstance(int $courseId = null, array $commissions = null, string $iso = null) : \travelsoft\currency\Currency{
        
        static $instances = array();
        
        if(!$courseId) {
            $courseId = \travelsoft\currency\Settings::currentCourseId();
        }
        
        if ($commissions) {
            $commissions = \travelsoft\currency\Settings::commissions();
        }

        if (!$iso) {
            $iso = (string) $arCurrencies[$arCourse["UF_BASE_ID"]]["UF_ISO"];
        }

        $hash = parent::hashGeneration(array($courseId, $commissions));
        
        if (!$instances[$hash]) {
            $arCurrencies = \travelsoft\currency\stores\Currencies::get();
            $arCourse = current(\travelsoft\currency\stores\Courses::get(array("filter" => array("ID" => $courseId))));

            $currency = new \travelsoft\currency\Currency($iso);//, intVal($arCourse["UF_BASE_ID"]));

            if (!empty($commissions)) {

                foreach ($arCurrencies as $arCurrency) {

                    $value = $arCourse["UF_" . $arCurrency["UF_ISO"]];
                    if (!$arCourse["UF_BASE_ID"] !== $arCurrency["ID"] && $commissions[$arCurrency["UF_ISO"]] > 0) {
                        # расчёт курса с комиссией
                        $value = $value + $value * ($commissions[$arCurrency["UF_ISO"]] / 100);
                    }
                    $currency->addCourse($arCurrency["UF_ISO"], new \travelsoft\currency\Course((float) $value, (string) $arCourse["UF_DATE"]));
                }
            } else {

                foreach ($arCurrencies as $arCurrency) {

                    $currency->addCourse($arCurrency["UF_ISO"], new \travelsoft\currency\Course((float) $arCourse["UF_" . $arCurrency["UF_ISO"]], (string) $arCourse["UF_DATE"]));
                }
            }
            
            $instances[$hash] = $currency;
        }

        return $instances[$hash];
        
    }
    
}
