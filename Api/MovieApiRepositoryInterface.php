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

namespace Aislan\MovieCatalog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface MovieApiRepositoryInterface
 * @package Aislan\MovieCatalog\Api
 */
interface MovieApiRepositoryInterface
{
    /**
     * @param \Aislan\MovieCatalog\Api\Data\MovieApiInterface $movieApi
     * @return \Aislan\MovieCatalog\Api\Data\MovieApiInterface
     */
    public function save(\Aislan\MovieCatalog\Api\Data\MovieApiInterface $movieApi);

    /**
     * @param \Aislan\MovieCatalog\Api\Data\MovieApiInterface $movieApi
     * @return \Aislan\MovieCatalog\Api\Data\MovieApiInterface
     */
    public function delete(\Aislan\MovieCatalog\Api\Data\MovieApiInterface $movieApi);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return \Aislan\MovieCatalog\Api\Data\MovieApiSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);

    /**
     * @param $apiId
     * @return mixed
     */
    public function getMovieApiByApiId($apiId);
}
