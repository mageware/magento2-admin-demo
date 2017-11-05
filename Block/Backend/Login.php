<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\AdminDemo\Block\Backend;

class Login extends \Magento\Backend\Block\Template
{
    /**
     * @return string
     */
    public function getUsername()
    {
        if (!$this->_scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
            return '';
        }

        $userId = $this->_scopeConfig->getValue(
            'mageware_admindemo/admin/user'
        );

        $user = \Magento\Framework\App\ObjectManager::getInstance()->create(
            \Magento\User\Model\User::class
        );

        $user->load($userId);

        return $user->getUsername();
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        if (!$this->_scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
            return '';
        }

        $password = $this->_scopeConfig->getValue(
            'mageware_admindemo/admin/password'
        );

        return $password;
    }
}
