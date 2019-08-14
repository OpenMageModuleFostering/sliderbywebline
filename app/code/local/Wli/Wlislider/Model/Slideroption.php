<?php
class Wli_Wlislider_Model_Slideroption
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'fade', 'label'=>Mage::helper('wlislider')->__('Fade')),
            array('value'=>'slide', 'label'=>Mage::helper('wlislider')->__('Slide')),
        );
    }

}

