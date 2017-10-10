# ProfileManagerList
List view for Profile Manager

##get_devices.sh uses query_json.sql to create a file devices.json

get_devices.sh has to run as root. - A LaunchDaemon can be used to trigger it

##Put index.html somewhere in your web directory and make sure devices.json is in that same folder.

Access to the .html and .json files should be protected - they contain sensible data about the devices like the unlock token)

![Alt text](/../master/img/Screenshot.jpg?raw=true "List View")

Modify column tiles and content in index.html to match your language. 
