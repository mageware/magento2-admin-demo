<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\AdminDemo\Block\Backend\System\Account\Edit;

class Form extends \Magento\Backend\Block\System\Account\Edit\Form
{
    /**
     * {@inheritdoc}
     */
    protected function _prepareForm()
    {
        $result = parent::_prepareForm();

        if ($this->_scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
            if ($this->_authSession->getUser()->getId() == $this->_scopeConfig->getValue('mageware_admindemo/admin/user')) {
                $element = $this->getForm()->getElement(self::IDENTITY_VERIFICATION_PASSWORD_FIELD);
                $element->setValue($this->_scopeConfig->getValue('mageware_admindemo/admin/password'));
            }
        }

        return $result;
    }
}
