# DB Fixtures [![Build Status](https://travis-ci.org/OpenBuildings/db-fixtures.png?branch=master)](https://travis-ci.org/OpenBuildings/db-fixtures) [![Coverage Status](https://coveralls.io/repos/OpenBuildings/db-fixtures/badge.png?branch=master)](https://coveralls.io/r/OpenBuildings/db-fixtures?branch=master)

This package gives you an abilitiy to keep database fixtures in plain php files and then store a snapshot of the database's content as raw sql queries. This allaws for readable fixture files (as opposed to xml or yml dumps) and you could use your ORM of choise and take advantage of all of your associations.

Here's an example usage:

```php

use Openbuildings\DBFixtures\Fixture;

$fixture = new Fixture;
$fixture->connect('mysql:db_name=mydatabase', 'root');

if (file_exists('cache_file.sql'))
{
	$fixture->load(file_get_contents('cache_file.sql'));
}
else
{
	$fixture
		->truncate_all()
		->execute_import_files(array('file1.php', 'file2.php'));

	file_put_contents('cache_file.sql', $fixture->dump());
}
```

``file1.php`` and ``file2.php`` are simple php scripts where you do whatever you want to put data inside your database, then ``dump()`` will return it as raw SQL inserts. 

It does not use mysqldump so it is more portable.

If you want you could pass the actual Pdo connection object and reuse it from your own configuration like this:

```php

use Openbuildings\DBFixtures\Fixture;

$fixture = new Fixture;
$fixture->pdo($pdo_object);
```

The actual file caching is not part of this package as most frameworks have their own cache functionality and it would be better to use that instead of rolling out our own.

## License

Copyright (c) 2012-2013, OpenBuildings Ltd. Developed by Ivan Kerin as part of [clippings.com](http://clippings.com)

Under BSD-3-Clause license, read LICENSE file.