<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\AdminDemo\Model\Config\Source;

class User
{
    /**
     * @var \Magento\User\Model\ResourceModel\User\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Construct
     *
     * @param \Magento\User\Model\ResourceModel\User\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\User\Model\ResourceModel\User\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        /** @var \Magento\User\Model\ResourceModel\User\Collection $collection */
        $collection = $this->collectionFactory->create();

        $collection->load();

        $options = [];

        foreach ($collection as $user) {
            $options[] = ['label' => $user->getUsername(), 'value' => $user->getId()];
        }

        return $options;
    }
}
