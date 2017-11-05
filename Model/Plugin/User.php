<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\AdminDemo\Model\Plugin;

class User
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\User\Model\User $subject
     * @param \Closure $proceed
     * @param string $password
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundVerifyIdentity(
        \Magento\User\Model\User $subject,
        \Closure $proceed,
        $password
    ) {
        $result = $proceed($password);

        if (!$result) {
            if ($this->scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
                if ($subject->getId() == $this->scopeConfig->getValue('mageware_admindemo/admin/user')) {
                    if ($password == $this->scopeConfig->getValue('mageware_admindemo/admin/password')) {
                        return true;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param \Magento\User\Model\User $subject
     * @param \Closure $proceed
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundBeforeSave(
        \Magento\User\Model\User $subject,
        \Closure $proceed
    ) {
        if ($subject->getId()) {
            if ($this->scopeConfig->isSetFlag('mageware_admindemo/admin/enabled')) {
                if ($subject->getId() == $this->scopeConfig->getValue('mageware_admindemo/admin/user')) {
                    foreach (['firstname', 'lastname', 'email', 'username'] as $field) {
                        if ($subject->dataHasChangedFor($field)) {
                            throw new \Magento\Framework\Exception\LocalizedException(
                                new \Magento\Framework\Phrase('Demo account details cannot be changed.')
                            );
                        }
                    }
                }
            }
        }

        return $proceed();
    }
}
