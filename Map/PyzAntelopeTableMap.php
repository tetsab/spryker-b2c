<?php

namespace Orm\Zed\Antelope\Persistence\Map;

use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'pyz_antelope' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PyzAntelopeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = '.Map.PyzAntelopeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pyz_antelope';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PyzAntelope';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Antelope\\Persistence\\PyzAntelope';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'PyzAntelope';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_antelope field
     */
    public const COL_ID_ANTELOPE = 'pyz_antelope.id_antelope';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'pyz_antelope.name';

    /**
     * the column name for the color field
     */
    public const COL_COLOR = 'pyz_antelope.color';

    /**
     * the column name for the fk_location field
     */
    public const COL_FK_LOCATION = 'pyz_antelope.fk_location';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdAntelope', 'Name', 'Color', 'FkLocation', ],
        self::TYPE_CAMELNAME     => ['idAntelope', 'name', 'color', 'fkLocation', ],
        self::TYPE_COLNAME       => [PyzAntelopeTableMap::COL_ID_ANTELOPE, PyzAntelopeTableMap::COL_NAME, PyzAntelopeTableMap::COL_COLOR, PyzAntelopeTableMap::COL_FK_LOCATION, ],
        self::TYPE_FIELDNAME     => ['id_antelope', 'name', 'color', 'fk_location', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdAntelope' => 0, 'Name' => 1, 'Color' => 2, 'FkLocation' => 3, ],
        self::TYPE_CAMELNAME     => ['idAntelope' => 0, 'name' => 1, 'color' => 2, 'fkLocation' => 3, ],
        self::TYPE_COLNAME       => [PyzAntelopeTableMap::COL_ID_ANTELOPE => 0, PyzAntelopeTableMap::COL_NAME => 1, PyzAntelopeTableMap::COL_COLOR => 2, PyzAntelopeTableMap::COL_FK_LOCATION => 3, ],
        self::TYPE_FIELDNAME     => ['id_antelope' => 0, 'name' => 1, 'color' => 2, 'fk_location' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAntelope' => 'ID_ANTELOPE',
        'PyzAntelope.IdAntelope' => 'ID_ANTELOPE',
        'idAntelope' => 'ID_ANTELOPE',
        'pyzAntelope.idAntelope' => 'ID_ANTELOPE',
        'PyzAntelopeTableMap::COL_ID_ANTELOPE' => 'ID_ANTELOPE',
        'COL_ID_ANTELOPE' => 'ID_ANTELOPE',
        'id_antelope' => 'ID_ANTELOPE',
        'pyz_antelope.id_antelope' => 'ID_ANTELOPE',
        'Name' => 'NAME',
        'PyzAntelope.Name' => 'NAME',
        'name' => 'NAME',
        'pyzAntelope.name' => 'NAME',
        'PyzAntelopeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'pyz_antelope.name' => 'NAME',
        'Color' => 'COLOR',
        'PyzAntelope.Color' => 'COLOR',
        'color' => 'COLOR',
        'pyzAntelope.color' => 'COLOR',
        'PyzAntelopeTableMap::COL_COLOR' => 'COLOR',
        'COL_COLOR' => 'COLOR',
        'pyz_antelope.color' => 'COLOR',
        'FkLocation' => 'FK_LOCATION',
        'PyzAntelope.FkLocation' => 'FK_LOCATION',
        'fkLocation' => 'FK_LOCATION',
        'pyzAntelope.fkLocation' => 'FK_LOCATION',
        'PyzAntelopeTableMap::COL_FK_LOCATION' => 'FK_LOCATION',
        'COL_FK_LOCATION' => 'FK_LOCATION',
        'fk_location' => 'FK_LOCATION',
        'pyz_antelope.fk_location' => 'FK_LOCATION',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('pyz_antelope');
        $this->setPhpName('PyzAntelope');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Antelope\\Persistence\\PyzAntelope');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_antelope', 'IdAntelope', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('color', 'Color', 'VARCHAR', false, 100, null);
        $this->addForeignKey('fk_location', 'FkLocation', 'INTEGER', 'pyz_antelope_location', 'id_location', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PyzAntelopeLocation', '\\Orm\\Zed\\Antelope\\Persistence\\PyzAntelopeLocation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_location',
    1 => ':id_location',
  ),
), 'SET NULL', null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdAntelope', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? PyzAntelopeTableMap::CLASS_DEFAULT : PyzAntelopeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (PyzAntelope object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PyzAntelopeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PyzAntelopeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PyzAntelopeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PyzAntelopeTableMap::OM_CLASS;
            /** @var PyzAntelope $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PyzAntelopeTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PyzAntelopeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PyzAntelopeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PyzAntelope $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PyzAntelopeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PyzAntelopeTableMap::COL_ID_ANTELOPE);
            $criteria->addSelectColumn(PyzAntelopeTableMap::COL_NAME);
            $criteria->addSelectColumn(PyzAntelopeTableMap::COL_COLOR);
            $criteria->addSelectColumn(PyzAntelopeTableMap::COL_FK_LOCATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_antelope');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.color');
            $criteria->addSelectColumn($alias . '.fk_location');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PyzAntelopeTableMap::COL_ID_ANTELOPE);
            $criteria->removeSelectColumn(PyzAntelopeTableMap::COL_NAME);
            $criteria->removeSelectColumn(PyzAntelopeTableMap::COL_COLOR);
            $criteria->removeSelectColumn(PyzAntelopeTableMap::COL_FK_LOCATION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_antelope');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.color');
            $criteria->removeSelectColumn($alias . '.fk_location');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(PyzAntelopeTableMap::DATABASE_NAME)->getTable(PyzAntelopeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PyzAntelope or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PyzAntelope object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Antelope\Persistence\PyzAntelope) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PyzAntelopeTableMap::DATABASE_NAME);
            $criteria->add(PyzAntelopeTableMap::COL_ID_ANTELOPE, (array) $values, Criteria::IN);
        }

        $query = PyzAntelopeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PyzAntelopeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PyzAntelopeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pyz_antelope table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PyzAntelopeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PyzAntelope or Criteria object.
     *
     * @param mixed $criteria Criteria or PyzAntelope object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzAntelopeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PyzAntelope object
        }

        if ($criteria->containsKey(PyzAntelopeTableMap::COL_ID_ANTELOPE) && $criteria->keyContainsValue(PyzAntelopeTableMap::COL_ID_ANTELOPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PyzAntelopeTableMap::COL_ID_ANTELOPE.')');
        }


        // Set the correct dbName
        $query = PyzAntelopeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
