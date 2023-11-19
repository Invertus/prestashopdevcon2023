ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

run-ps:
	docker network create prestashop-net-${ps_instance}
	docker run -ti --name some-mysql-${ps_instance} --network prestashop-net-${ps_instance} -e MYSQL_ROOT_PASSWORD=admin -e MYSQL_DATABASE=prestashop -p 3307:3306 -d mysql:5.7
	docker run -ti -v $(ROOT_DIR):/var/www/html/modules/prestashopdevcon --name some-prestashop-${ps_instance} --network prestashop-net-${ps_instance} -e DB_SERVER=some-mysql-${ps_instance} -e PS_INSTALL_AUTO=1 -e DB_NAME=prestashop -e PS_DOMAIN=localhost:8080 -e PS_FOLDER_ADMIN=admin1 -p 8080:80 -d prestashop/prestashop:${ps_instance}

run-wiremock:
	docker run -d -ti --rm --name wiremock-${ps_instance} --network prestashop-net-${ps_instance} -v $(ROOT_DIR)/wiremock:/home/wiremock -p 8443:8080 wiremock/wiremock