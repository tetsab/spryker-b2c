<?php

namespace Orm\Zed\Antelope\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation as ChildPyzAntelopeLocation;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery as ChildPyzAntelopeLocationQuery;
use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeLocationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `pyz_antelope_location` table.
 *
 * @method     ChildPyzAntelopeLocationQuery orderByIdLocation($order = Criteria::ASC) Order by the id_location column
 * @method     ChildPyzAntelopeLocationQuery orderByLocationName($order = Criteria::ASC) Order by the location_name column
 *
 * @method     ChildPyzAntelopeLocationQuery groupByIdLocation() Group by the id_location column
 * @method     ChildPyzAntelopeLocationQuery groupByLocationName() Group by the location_name column
 *
 * @method     ChildPyzAntelopeLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPyzAntelopeLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPyzAntelopeLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPyzAntelopeLocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPyzAntelopeLocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPyzAntelopeLocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPyzAntelopeLocationQuery leftJoinPyzAntelope($relationAlias = null) Adds a LEFT JOIN clause to the query using the PyzAntelope relation
 * @method     ChildPyzAntelopeLocationQuery rightJoinPyzAntelope($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PyzAntelope relation
 * @method     ChildPyzAntelopeLocationQuery innerJoinPyzAntelope($relationAlias = null) Adds a INNER JOIN clause to the query using the PyzAntelope relation
 *
 * @method     ChildPyzAntelopeLocationQuery joinWithPyzAntelope($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PyzAntelope relation
 *
 * @method     ChildPyzAntelopeLocationQuery leftJoinWithPyzAntelope() Adds a LEFT JOIN clause and with to the query using the PyzAntelope relation
 * @method     ChildPyzAntelopeLocationQuery rightJoinWithPyzAntelope() Adds a RIGHT JOIN clause and with to the query using the PyzAntelope relation
 * @method     ChildPyzAntelopeLocationQuery innerJoinWithPyzAntelope() Adds a INNER JOIN clause and with to the query using the PyzAntelope relation
 *
 * @method     \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPyzAntelopeLocation|null findOne(?ConnectionInterface $con = null) Return the first ChildPyzAntelopeLocation matching the query
 * @method     ChildPyzAntelopeLocation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPyzAntelopeLocation matching the query, or a new ChildPyzAntelopeLocation object populated from the query conditions when no match is found
 *
 * @method     ChildPyzAntelopeLocation|null findOneByIdLocation(int $id_location) Return the first ChildPyzAntelopeLocation filtered by the id_location column
 * @method     ChildPyzAntelopeLocation|null findOneByLocationName(string $location_name) Return the first ChildPyzAntelopeLocation filtered by the location_name column
 *
 * @method     ChildPyzAntelopeLocation requirePk($key, ?ConnectionInterface $con = null) Return the ChildPyzAntelopeLocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelopeLocation requireOne(?ConnectionInterface $con = null) Return the first ChildPyzAntelopeLocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzAntelopeLocation requireOneByIdLocation(int $id_location) Return the first ChildPyzAntelopeLocation filtered by the id_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelopeLocation requireOneByLocationName(string $location_name) Return the first ChildPyzAntelopeLocation filtered by the location_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzAntelopeLocation[]|Collection find(?ConnectionInterface $con = null) Return ChildPyzAntelopeLocation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPyzAntelopeLocation> find(?ConnectionInterface $con = null) Return ChildPyzAntelopeLocation objects based on current ModelCriteria
 *
 * @method     ChildPyzAntelopeLocation[]|Collection findByIdLocation(int|array<int> $id_location) Return ChildPyzAntelopeLocation objects filtered by the id_location column
 * @psalm-method Collection&\Traversable<ChildPyzAntelopeLocation> findByIdLocation(int|array<int> $id_location) Return ChildPyzAntelopeLocation objects filtered by the id_location column
 * @method     ChildPyzAntelopeLocation[]|Collection findByLocationName(string|array<string> $location_name) Return ChildPyzAntelopeLocation objects filtered by the location_name column
 * @psalm-method Collection&\Traversable<ChildPyzAntelopeLocation> findByLocationName(string|array<string> $location_name) Return ChildPyzAntelopeLocation objects filtered by the location_name column
 *
 * @method     ChildPyzAntelopeLocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPyzAntelopeLocation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PyzAntelopeLocationQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::exists($con);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function configureSelectColumns(): void
    {
        if (!$this->select) {
            return;
        }

        if ($this->formatter === null) {
            $this->setFormatter(new TypeAwareSimpleArrayFormatter());
        }

        parent::configureSelectColumns();
     }
        protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\Antelope\Persistence\Base\PyzAntelopeLocationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Antelope\\Persistence\\PyzAntelopeLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPyzAntelopeLocationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPyzAntelopeLocationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPyzAntelopeLocationQuery) {
            return $criteria;
        }
        $query = new ChildPyzAntelopeLocationQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPyzAntelopeLocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PyzAntelopeLocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPyzAntelopeLocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_location, location_name FROM pyz_antelope_location WHERE id_location = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPyzAntelopeLocation $obj */
            $obj = new ChildPyzAntelopeLocation();
            $obj->hydrate($row);
            PyzAntelopeLocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildPyzAntelopeLocation|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idLocation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocation_Between(array $idLocation)
    {
        return $this->filterByIdLocation($idLocation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idLocations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocation_In(array $idLocations)
    {
        return $this->filterByIdLocation($idLocations, Criteria::IN);
    }

    /**
     * Filter the query on the id_location column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocation(1234); // WHERE id_location = 1234
     * $query->filterByIdLocation(array(12, 34), Criteria::IN); // WHERE id_location IN (12, 34)
     * $query->filterByIdLocation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_location > 12
     * </code>
     *
     * @param     mixed $idLocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdLocation($idLocation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idLocation)) {
            $useMinMax = false;
            if (isset($idLocation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $idLocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $idLocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idLocation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $idLocation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $locationNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocationName_In(array $locationNames)
    {
        return $this->filterByLocationName($locationNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $locationName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocationName_Like($locationName)
    {
        return $this->filterByLocationName($locationName, Criteria::LIKE);
    }

    /**
     * Filter the query on the location_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationName('fooValue');   // WHERE location_name = 'fooValue'
     * $query->filterByLocationName('%fooValue%', Criteria::LIKE); // WHERE location_name LIKE '%fooValue%'
     * $query->filterByLocationName([1, 'foo'], Criteria::IN); // WHERE location_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $locationName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLocationName($locationName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $locationName = str_replace('*', '%', $locationName);
        }

        if (is_array($locationName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$locationName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_LOCATION_NAME, $locationName, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Antelope\Persistence\PyzAntelope object
     *
     * @param \Orm\Zed\Antelope\Persistence\PyzAntelope|ObjectCollection $pyzAntelope the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPyzAntelope($pyzAntelope, ?string $comparison = null)
    {
        if ($pyzAntelope instanceof \Orm\Zed\Antelope\Persistence\PyzAntelope) {
            $this
                ->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $pyzAntelope->getFkLocation(), $comparison);

            return $this;
        } elseif ($pyzAntelope instanceof ObjectCollection) {
            $this
                ->usePyzAntelopeQuery()
                ->filterByPrimaryKeys($pyzAntelope->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPyzAntelope() only accepts arguments of type \Orm\Zed\Antelope\Persistence\PyzAntelope or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PyzAntelope relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPyzAntelope(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PyzAntelope');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PyzAntelope');
        }

        return $this;
    }

    /**
     * Use the PyzAntelope relation PyzAntelope object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery A secondary query class using the current class as primary query
     */
    public function usePyzAntelopeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPyzAntelope($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PyzAntelope', '\Orm\Zed\Antelope\Persistence\PyzAntelopeQuery');
    }

    /**
     * Use the PyzAntelope relation PyzAntelope object
     *
     * @param callable(\Orm\Zed\Antelope\Persistence\PyzAntelopeQuery):\Orm\Zed\Antelope\Persistence\PyzAntelopeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPyzAntelopeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePyzAntelopeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PyzAntelope table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery The inner query object of the EXISTS statement
     */
    public function usePyzAntelopeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery */
        $q = $this->useExistsQuery('PyzAntelope', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PyzAntelope table for a NOT EXISTS query.
     *
     * @see usePyzAntelopeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery The inner query object of the NOT EXISTS statement
     */
    public function usePyzAntelopeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery */
        $q = $this->useExistsQuery('PyzAntelope', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PyzAntelope table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery The inner query object of the IN statement
     */
    public function useInPyzAntelopeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery */
        $q = $this->useInQuery('PyzAntelope', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PyzAntelope table for a NOT IN query.
     *
     * @see usePyzAntelopeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery The inner query object of the NOT IN statement
     */
    public function useNotInPyzAntelopeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeQuery */
        $q = $this->useInQuery('PyzAntelope', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPyzAntelopeLocation $pyzAntelopeLocation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pyzAntelopeLocation = null)
    {
        if ($pyzAntelopeLocation) {
            $this->addUsingAlias(PyzAntelopeLocationTableMap::COL_ID_LOCATION, $pyzAntelopeLocation->getIdLocation(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pyz_antelope_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeLocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PyzAntelopeLocationTableMap::clearInstancePool();
            PyzAntelopeLocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeLocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PyzAntelopeLocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PyzAntelopeLocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PyzAntelopeLocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
