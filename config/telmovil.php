<?php

return [
  
    'class' => 'yii\db\Connection',
	'dsn' => 'oci:dbname=(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=192.168.0.195)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVER=dedicated)
      (SERVICE_NAME=ORCL)
    )
  );charset=AL32UTF8;', // Oracle
    'username' => 'TELEPRU',
    'password' => 'tytcali',
	'charset' => 'utf8',
		
];