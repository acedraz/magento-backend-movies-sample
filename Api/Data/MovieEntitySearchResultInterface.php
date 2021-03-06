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

namespace Aislan\MovieCatalog\Api\Data;

use Magento\Framework\Data\SearchResultInterface;

/**
 * Interface MovieEntitySearchResultInterface
 * @api
 */
interface MovieEntitySearchResultInterface extends SearchResultInterface
{
    /**
     * @return \Aislan\MovieCatalog\Api\Data\MovieEntityInterface[]
     */
    public function getItems();

    /**
     * @param \Aislan\MovieCatalog\Api\Data\MovieEntityInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
