#!/bin/bash
#

# Path to file containing SQL query
queryPath="/Users/Shared/PM-SQL/query_json.sql"
# Path to put json data
jsonPath="/Library/Server/Web/Data/Sites/iXpert.at/pm/devices.json"

# you should not have to change that
psqlPath="/Applications/Server.app/Contents/ServerRoot/usr/bin/psql"
dbPath="/Library/Server/ProfileManager/Config/var/PostgreSQL"

sudo -u _devicemgr $psqlPath -A -t -F ',' -U _devicemgr -h $dbPath -d devicemgr_v2m0 -f $queryPath > $jsonPath

exit 0
