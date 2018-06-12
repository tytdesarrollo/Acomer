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
      (SERVICE_NAME=orcl.talentos)
    )
  );charset=AL32UTF8;', // Oracle
    'username' => 'USR_WEBPRU',   //USR_AWA      //USR_SAIC      //USR_WEBPRU
    'password' => 'WEBPRU123', //0RCAWASYST   //SAIC123WEB    //WEBPRU123
	'charset' => 'utf8',
		
];