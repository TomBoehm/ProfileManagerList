#!/bin/bash
#

psqlPath="/Applications/Server.app/Contents/ServerRoot/usr/bin/psql"
dbPath="/Library/Server/ProfileManager/Config/var/PostgreSQL"
metaPath="/Library/Server/Web/Data/Sites/iXpert.at/pm/update.txt"
echo $( date '+%Y-%m-%d %H:%M:%S' ) > $metaPath

queryPath="/Users/Shared/PM-SQL/query_json2.sql"
jsonPath="/Library/Server/Web/Data/Sites/iXpert.at/pm/devices.json"
sudo -u _devicemgr $psqlPath -A -t -F ',' -U _devicemgr -h $dbPath -d devicemgr_v2m0 -f $queryPath > $jsonPath

queryPath="/Users/Shared/PM-SQL/query_json_large.sql"
jsonPath="/Library/Server/Web/Data/Sites/iXpert.at/pm/devices_large.json"
sudo -u _devicemgr $psqlPath -A -t -F ',' -U _devicemgr -h $dbPath -d devicemgr_v2m0 -f $queryPath > $jsonPath


exit 0
