all.install: wordpress.install;

wordpress.install: 
	docker-compose up -d
	# curl -O https://pub-700a4e829cfd49f6bd37598326fa2eb0.r2.dev/backup/html.tgz  \
	# 	-O https://pub-700a4e829cfd49f6bd37598326fa2eb0.r2.dev/backup/mysql.tgz \
	docker cp - mlops-wp-web:/var/www < ./data/mlops-web.tgz
	docker cp - mlops-wp-db:/var/lib < .data/mlops-db.tgz
	# rm -rf ./data/mlops-web.tgz
	# rm -rf .data/mlops-db.tgz
	docker-compose stop
	docker-compose start

wordpress.update: 
	docker-compose stop
	docker-compose up -d
	# curl -O https://pub-700a4e829cfd49f6bd37598326fa2eb0.r2.dev/backup/html.tgz  \
	# 	-O https://pub-700a4e829cfd49f6bd37598326fa2eb0.r2.dev/backup/mysql.tgz
	# docker cp - pachyderm-wp-web:/var/www < html.tgz
	# docker cp - pachyderm-wp-db:/var/lib < mysql.tgz
	# rm -rf html.tgz
	# rm -rf mysql.tgz

wordpress.start: 
	docker-compose up -d 
	echo "Site: http://localhost:8140"

wordpress.stop:
	docker-compose stop 

wordpress.restart:
	docker-compose restart

wordpress.remove:
	docker-compose rm -f && docker volume rm -f $(docker volume list)

wordpress.backup: 
	mkdir -p .data
	rm -rf .data/mlops-db.tgz
	rm -rf .data/mlops-web.tgz
	docker cp mlops-wp-db:/var/lib/mysql/ mlops-db
	docker cp mlops-wp-web:/var/www/html/ mlops-web
	tar -czf .data/mlops-db.tgz mlops-db 
	tar -czf .data/mlops-web.tgz mlops-web
	rm -rf mlops-web
	rm -rf mlops-db
	# docker run --rm \
    # --volume ${PWD}/rclone.conf:/config/rclone/rclone.conf \
    # --volume ${PWD}/.data:/data \exit
    # --user $(id -u):$(id -g) \
    # rclone/rclone \
    # sync /data r2:/backup -P
	# rm -rf .data