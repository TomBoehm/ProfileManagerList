with 
  base_request as (

	SELECT d.id, 
		d."DeviceName", 
		d."SerialNumber", 
		d."OSVersion", 
		d.last_checkin_time,
		d.is_dep_device, 
		d."IsSupervised", 
		u.short_name,
		l.dynamic_attributes
	FROM   devices d
    JOIN users u ON d.user_id = u.id
	JOIN library_item_metadata l ON d.id = l.id
  )
select row_to_json(t) from ( 
  select 1 as draw, 
  (select count(*) from base_request) as recordsTotal,
  (select count(*) from base_request limit 5) as recordsFiltered,
  ( 
    select array_to_json(array_agg(row_to_json(u)))
    from (
       select * from base_request offset 0 limit 5
    ) u
  ) as data
) t;
