<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\AdminDemo\Model\Backend;

class Url extends \Magento\Backend\Model\Url
{
    /**
     * {@inheritdoc}
     */
    public function getStartupPageUrl()
    {
        if ($this->_scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
            if ($this->_session->getUser()->getId() == $this->_scopeConfig->getValue('mageware_admindemo/admin/user')) {
                if ($this->_scopeConfig->isSetFlag('mageware_admindemo/admin/redirect_account')) {
                    return '*/system_account/index';
                }
            }
        }

        return parent::getStartupPageUrl();
    }
}
