<?php

namespace Orm\Zed\Antelope\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Antelope\Persistence\PyzAntelope as ChildPyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery as ChildPyzAntelopeQuery;
use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
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
 * Base class that represents a query for the `pyz_antelope` table.
 *
 * @method     ChildPyzAntelopeQuery orderByIdAntelope($order = Criteria::ASC) Order by the id_antelope column
 * @method     ChildPyzAntelopeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPyzAntelopeQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     ChildPyzAntelopeQuery orderByFkLocation($order = Criteria::ASC) Order by the fk_location column
 *
 * @method     ChildPyzAntelopeQuery groupByIdAntelope() Group by the id_antelope column
 * @method     ChildPyzAntelopeQuery groupByName() Group by the name column
 * @method     ChildPyzAntelopeQuery groupByColor() Group by the color column
 * @method     ChildPyzAntelopeQuery groupByFkLocation() Group by the fk_location column
 *
 * @method     ChildPyzAntelopeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPyzAntelopeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPyzAntelopeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPyzAntelopeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPyzAntelopeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPyzAntelopeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPyzAntelopeQuery leftJoinPyzAntelopeLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the PyzAntelopeLocation relation
 * @method     ChildPyzAntelopeQuery rightJoinPyzAntelopeLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PyzAntelopeLocation relation
 * @method     ChildPyzAntelopeQuery innerJoinPyzAntelopeLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the PyzAntelopeLocation relation
 *
 * @method     ChildPyzAntelopeQuery joinWithPyzAntelopeLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PyzAntelopeLocation relation
 *
 * @method     ChildPyzAntelopeQuery leftJoinWithPyzAntelopeLocation() Adds a LEFT JOIN clause and with to the query using the PyzAntelopeLocation relation
 * @method     ChildPyzAntelopeQuery rightJoinWithPyzAntelopeLocation() Adds a RIGHT JOIN clause and with to the query using the PyzAntelopeLocation relation
 * @method     ChildPyzAntelopeQuery innerJoinWithPyzAntelopeLocation() Adds a INNER JOIN clause and with to the query using the PyzAntelopeLocation relation
 *
 * @method     \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPyzAntelope|null findOne(?ConnectionInterface $con = null) Return the first ChildPyzAntelope matching the query
 * @method     ChildPyzAntelope findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPyzAntelope matching the query, or a new ChildPyzAntelope object populated from the query conditions when no match is found
 *
 * @method     ChildPyzAntelope|null findOneByIdAntelope(int $id_antelope) Return the first ChildPyzAntelope filtered by the id_antelope column
 * @method     ChildPyzAntelope|null findOneByName(string $name) Return the first ChildPyzAntelope filtered by the name column
 * @method     ChildPyzAntelope|null findOneByColor(string $color) Return the first ChildPyzAntelope filtered by the color column
 * @method     ChildPyzAntelope|null findOneByFkLocation(int $fk_location) Return the first ChildPyzAntelope filtered by the fk_location column
 *
 * @method     ChildPyzAntelope requirePk($key, ?ConnectionInterface $con = null) Return the ChildPyzAntelope by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelope requireOne(?ConnectionInterface $con = null) Return the first ChildPyzAntelope matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzAntelope requireOneByIdAntelope(int $id_antelope) Return the first ChildPyzAntelope filtered by the id_antelope column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelope requireOneByName(string $name) Return the first ChildPyzAntelope filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelope requireOneByColor(string $color) Return the first ChildPyzAntelope filtered by the color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzAntelope requireOneByFkLocation(int $fk_location) Return the first ChildPyzAntelope filtered by the fk_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzAntelope[]|Collection find(?ConnectionInterface $con = null) Return ChildPyzAntelope objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPyzAntelope> find(?ConnectionInterface $con = null) Return ChildPyzAntelope objects based on current ModelCriteria
 *
 * @method     ChildPyzAntelope[]|Collection findByIdAntelope(int|array<int> $id_antelope) Return ChildPyzAntelope objects filtered by the id_antelope column
 * @psalm-method Collection&\Traversable<ChildPyzAntelope> findByIdAntelope(int|array<int> $id_antelope) Return ChildPyzAntelope objects filtered by the id_antelope column
 * @method     ChildPyzAntelope[]|Collection findByName(string|array<string> $name) Return ChildPyzAntelope objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildPyzAntelope> findByName(string|array<string> $name) Return ChildPyzAntelope objects filtered by the name column
 * @method     ChildPyzAntelope[]|Collection findByColor(string|array<string> $color) Return ChildPyzAntelope objects filtered by the color column
 * @psalm-method Collection&\Traversable<ChildPyzAntelope> findByColor(string|array<string> $color) Return ChildPyzAntelope objects filtered by the color column
 * @method     ChildPyzAntelope[]|Collection findByFkLocation(int|array<int> $fk_location) Return ChildPyzAntelope objects filtered by the fk_location column
 * @psalm-method Collection&\Traversable<ChildPyzAntelope> findByFkLocation(int|array<int> $fk_location) Return ChildPyzAntelope objects filtered by the fk_location column
 *
 * @method     ChildPyzAntelope[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPyzAntelope> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PyzAntelopeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Antelope\Persistence\Base\PyzAntelopeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Antelope\\Persistence\\PyzAntelope', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPyzAntelopeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPyzAntelopeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPyzAntelopeQuery) {
            return $criteria;
        }
        $query = new ChildPyzAntelopeQuery();
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
     * @return ChildPyzAntelope|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = PyzAntelopeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPyzAntelope A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_antelope, name, color, fk_location FROM pyz_antelope WHERE id_antelope = :p0';
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
            /** @var ChildPyzAntelope $obj */
            $obj = new ChildPyzAntelope();
            $obj->hydrate($row);
            PyzAntelopeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPyzAntelope|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idAntelope Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAntelope_Between(array $idAntelope)
    {
        return $this->filterByIdAntelope($idAntelope, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idAntelopes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdAntelope_In(array $idAntelopes)
    {
        return $this->filterByIdAntelope($idAntelopes, Criteria::IN);
    }

    /**
     * Filter the query on the id_antelope column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAntelope(1234); // WHERE id_antelope = 1234
     * $query->filterByIdAntelope(array(12, 34), Criteria::IN); // WHERE id_antelope IN (12, 34)
     * $query->filterByIdAntelope(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_antelope > 12
     * </code>
     *
     * @param     mixed $idAntelope The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdAntelope($idAntelope = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idAntelope)) {
            $useMinMax = false;
            if (isset($idAntelope['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $idAntelope['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAntelope['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $idAntelope['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idAntelope of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $idAntelope, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzAntelopeTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $colors Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColor_In(array $colors)
    {
        return $this->filterByColor($colors, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $color Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColor_Like($color)
    {
        return $this->filterByColor($color, Criteria::LIKE);
    }

    /**
     * Filter the query on the color column
     *
     * Example usage:
     * <code>
     * $query->filterByColor('fooValue');   // WHERE color = 'fooValue'
     * $query->filterByColor('%fooValue%', Criteria::LIKE); // WHERE color LIKE '%fooValue%'
     * $query->filterByColor([1, 'foo'], Criteria::IN); // WHERE color IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $color The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByColor($color = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $color = str_replace('*', '%', $color);
        }

        if (is_array($color) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$color of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(PyzAntelopeTableMap::COL_COLOR, $color, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLocation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocation_Between(array $fkLocation)
    {
        return $this->filterByFkLocation($fkLocation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLocations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocation_In(array $fkLocations)
    {
        return $this->filterByFkLocation($fkLocations, Criteria::IN);
    }

    /**
     * Filter the query on the fk_location column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLocation(1234); // WHERE fk_location = 1234
     * $query->filterByFkLocation(array(12, 34), Criteria::IN); // WHERE fk_location IN (12, 34)
     * $query->filterByFkLocation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_location > 12
     * </code>
     *
     * @see       filterByPyzAntelopeLocation()
     *
     * @param     mixed $fkLocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLocation($fkLocation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLocation)) {
            $useMinMax = false;
            if (isset($fkLocation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeTableMap::COL_FK_LOCATION, $fkLocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzAntelopeTableMap::COL_FK_LOCATION, $fkLocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzAntelopeTableMap::COL_FK_LOCATION, $fkLocation, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Antelope\Persistence\PyzAntelopeLocation object
     *
     * @param \Orm\Zed\Antelope\Persistence\PyzAntelopeLocation|ObjectCollection $pyzAntelopeLocation The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPyzAntelopeLocation($pyzAntelopeLocation, ?string $comparison = null)
    {
        if ($pyzAntelopeLocation instanceof \Orm\Zed\Antelope\Persistence\PyzAntelopeLocation) {
            return $this
                ->addUsingAlias(PyzAntelopeTableMap::COL_FK_LOCATION, $pyzAntelopeLocation->getIdLocation(), $comparison);
        } elseif ($pyzAntelopeLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PyzAntelopeTableMap::COL_FK_LOCATION, $pyzAntelopeLocation->toKeyValue('PrimaryKey', 'IdLocation'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPyzAntelopeLocation() only accepts arguments of type \Orm\Zed\Antelope\Persistence\PyzAntelopeLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PyzAntelopeLocation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPyzAntelopeLocation(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PyzAntelopeLocation');

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
            $this->addJoinObject($join, 'PyzAntelopeLocation');
        }

        return $this;
    }

    /**
     * Use the PyzAntelopeLocation relation PyzAntelopeLocation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery A secondary query class using the current class as primary query
     */
    public function usePyzAntelopeLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPyzAntelopeLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PyzAntelopeLocation', '\Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery');
    }

    /**
     * Use the PyzAntelopeLocation relation PyzAntelopeLocation object
     *
     * @param callable(\Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery):\Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPyzAntelopeLocationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePyzAntelopeLocationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PyzAntelopeLocation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery The inner query object of the EXISTS statement
     */
    public function usePyzAntelopeLocationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery */
        $q = $this->useExistsQuery('PyzAntelopeLocation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PyzAntelopeLocation table for a NOT EXISTS query.
     *
     * @see usePyzAntelopeLocationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery The inner query object of the NOT EXISTS statement
     */
    public function usePyzAntelopeLocationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery */
        $q = $this->useExistsQuery('PyzAntelopeLocation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PyzAntelopeLocation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery The inner query object of the IN statement
     */
    public function useInPyzAntelopeLocationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery */
        $q = $this->useInQuery('PyzAntelopeLocation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PyzAntelopeLocation table for a NOT IN query.
     *
     * @see usePyzAntelopeLocationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery The inner query object of the NOT IN statement
     */
    public function useNotInPyzAntelopeLocationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Antelope\Persistence\PyzAntelopeLocationQuery */
        $q = $this->useInQuery('PyzAntelopeLocation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPyzAntelope $pyzAntelope Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pyzAntelope = null)
    {
        if ($pyzAntelope) {
            $this->addUsingAlias(PyzAntelopeTableMap::COL_ID_ANTELOPE, $pyzAntelope->getIdAntelope(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pyz_antelope table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PyzAntelopeTableMap::clearInstancePool();
            PyzAntelopeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PyzAntelopeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PyzAntelopeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PyzAntelopeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
