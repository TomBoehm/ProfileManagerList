#!/bin/bash
#

# Version to produce lagre json file, including "library_item_metadata" 

psqlPath="/Applications/Server.app/Contents/ServerRoot/usr/bin/psql"
dbPath="/Library/Server/ProfileManager/Config/var/PostgreSQL"
queryPath="/Users/Shared/PM-SQL/query_json_large.sql"
jsonPath="/Library/Server/Web/Data/Sites/iXpert.at/pm/devices_large.json"

sudo -u _devicemgr $psqlPath -A -t -F ',' -U _devicemgr -h $dbPath -d devicemgr_v2m0 -f $queryPath > $jsonPath
#$psqlPath -A -F ',' -U _devicemgr -h $dbPath -d devicemgr_v2m0 -f $queryPath > $jsonPath

exit 0
