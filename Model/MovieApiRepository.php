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

use Aislan\MovieCatalog\Api\Data\GenreSearchResultInterfaceFactory;
use Aislan\MovieCatalog\Api\Data\MovieApiInterface;
use Aislan\MovieCatalog\Api\MovieApiRepositoryInterface;
use Magento\Framework\Api\FilterBuilderFactory;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class MovieApiRepository
 */
class MovieApiRepository extends AbstractMovieApiRepository implements MovieApiRepositoryInterface
{
    /**
     * @var GenreFactory
     */
    private $movieApiFactory;

    /**
     * @var GenreSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var ResourceModel\Genre\CollectionFactory
     */
    private $movieApiCollectionFactory;

    /**
     * @var FilterBuilderFactory
     */
    private $filterBuilderFactory;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;

    public function __construct(
        MovieApiFactory $movieApiFactory,
        GenreSearchResultInterfaceFactory $searchResultFactory,
        ResourceModel\MovieApi\CollectionFactory $movieApiCollectionFactory,
        FilterBuilderFactory $filterBuilderFactory,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {
        $this->movieApiFactory = $movieApiFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->movieApiCollectionFactory = $movieApiCollectionFactory;
        $this->filterBuilderFactory = $filterBuilderFactory;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
    }

    /**
     * @param MovieApiInterface $movieApi
     * @return MovieApiInterface
     */
    public function save(MovieApiInterface $movieApi)
    {
        $movieApi->getResource()->save($movieApi);
        return $movieApi;
    }

    /**
     * @param MovieApiInterface $movieApi
     * @return void
     */
    public function delete(MovieApiInterface $movieApi)
    {
        $movieApi->getResource()->delete($movieApi);
    }

    /**
     * @param int $id
     * @return \Aislan\MovieCatalog\Api\Data\GenreInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $obj = $this->movieApiFactory->create();
        $obj->getResource()->load($obj, $id);
        if (! $obj->getId()) {
            throw new NoSuchEntityException(__('Unable to find movie with ID "%1"', $id));
        }
        return $obj;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById($id)
    {
        $obj = $this->getById($id);
        $obj->delete();
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Aislan\MovieCatalog\Api\Data\MovieApiSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->movieApiCollectionFactory->create();
        $searchResults = $this->searchResultFactory->create();
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        $collection->load();
        return $this->buildSearchResult($searchCriteria, $collection, $searchResults);
    }

    /**
     * @param $apiId
     * @return \Aislan\MovieCatalog\Api\Data\MovieApiInterface
     */
    public function getMovieApiByApiId($apiId)
    {
        $filters[] = $this->filterBuilderFactory->create()->setField('api_id')
            ->setValue($apiId)
            ->create();
        $searchCriteria = $this->searchCriteriaBuilderFactory->create()->addFilters($filters)->create();
        return $this->getList($searchCriteria);
    }
}
