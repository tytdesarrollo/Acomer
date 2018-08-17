<?php

//conexion para procedimiento que retornen cursores

$this->models->params['awadb'] = '(DESCRIPTION=
			    (ADDRESS=
			      (PROTOCOL=TCP)
			      (HOST=192.168.0.195)
			      (PORT=1521)
			      (Presentation=HTTP)
			    )
			    (CONNECT_DATA=
			      (SERVER=dedicated)
			      (SERVICE_NAME=orcl.talentos)
			    )
	  		)';