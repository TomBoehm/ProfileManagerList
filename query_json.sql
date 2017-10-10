with 
  base_request as (

	SELECT a.id, 
		a."DeviceName", 
		a."SerialNumber", 
		a."OSVersion", 
		a.last_checkin_time,
		a.is_dep_device, 
		a."IsSupervised", 
		b.short_name
	FROM   devices a
	JOIN users b
	ON a.user_id = b.id

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
