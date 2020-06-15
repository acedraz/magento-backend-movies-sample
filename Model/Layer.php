<?php
/**
 * Aislan
 *
 * NOTICE OF LICENSE
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to aislan.cedraz@gmail.com.br for more information.
 *
 * @module      Aislan Movie Catalog
 * @category    Aislan
 * @package     Aislan_MovieCatalog
 *
 * @copyright   Copyright (c) 2020 Aislan.
 *
 * @author      Aislan Core Team <aislan.cedraz@gmail.com.br>
 */

declare(strict_types=1);

namespace Aislan\MovieCatalog\Model;

use Aislan\MovieCatalog\Model\ResourceModel\MovieEntity\CollectionFactory;
use Magento\Framework\DataObject;

/**
 * Class Layer
 */
class Layer extends DataObject
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Layer constructor.
     * @param CollectionFactory $collection
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collection,
        array $data = []
    ) {
        parent::__construct($data);
        $this->collection = $collection;
    }

    /**
     * Product collections array
     *
     * @var array
     */
    protected $_movieCollections = [];

    /**
     * Retrieve current layer movie collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getMovieCollection()
    {
        return $this->collection->create();
    }
}
