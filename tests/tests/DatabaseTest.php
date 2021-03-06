<?php

use Openbuildings\DBFixtures\Fixture;
use PHPUnit\Framework\TestCase;

/**
 * @package spiderling
 * @group   driver
 * @group   driver.kohana
 */
class Driver_KohanaTest extends TestCase {

	public function test_connect()
	{
		$database = new Fixture();
		$database->connect('mysql:host=localhost;dbname=test-db-fixtures', 'root');

		$database->load(file_get_contents(__DIR__.'/../test_data/database.sql'));

		$this->assertEquals(array('table1', 'table2'), $database->list_tables());

		$database->pdo()->exec('INSERT INTO table1 SET id = 1, name = "test1", description = "test test", price = 0.32');
		$database->pdo()->exec('INSERT INTO table1 SET id = 2, name = "test2", description = "test test2", price = 0.11');
		$database->pdo()->exec('INSERT INTO table1 SET id = 3, name = NULL, description = "", price = NULL');
		
		$dumped = $database->dump();

		$expected = <<<DUMPED
INSERT INTO `table1` VALUES ('1','test1','test test','0.32');
INSERT INTO `table1` VALUES ('2','test2','test test2','0.11');
INSERT INTO `table1` VALUES ('3',NULL,'',NULL);

DUMPED;

		$this->assertEquals($expected, $dumped);

		$database->replace(file_get_contents(__DIR__.'/../test_data/replacement.sql'));


		$database = new Fixture();
		$database->pdo(new PDO('mysql:host=localhost;dbname=test-db-fixtures', 'root'));

		$result = $database->pdo()->query('SELECT * FROM table1')->fetchAll(\PDO::FETCH_NUM);

		$expected = array(
			array(3, 'test3', 'test test3', 0.22),
			array(4, 'test4', 'test test4', 231.99),
		);

		$this->assertEquals($expected, $result);

		$database->execute_import_files(array(
			__DIR__.'/../test_data/importfile.php'
		));

		$result = $database->pdo()->query('SELECT * FROM table1')->fetchAll(\PDO::FETCH_NUM);

		$expected = array(
			array(3, 'test3', 'test test3', 0.22),
			array(4, 'test4', 'test test4', 231.99),
			array(8, 'test8', 'test test8', 8.32),
			array(9, 'test9', 'test test9', 9.32),
		);

		$this->assertEquals($expected, $result);


	}
}

