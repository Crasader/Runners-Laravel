update runs set planned_at = date_add(planned_at, interval 55 day);
update runs set status = 'finished' where planned_at < DATE_SUB(NOW(), INTERVAL 1 hour);
update runs set status = 'gone' where status <> 'finished' and planned_at < DATE_ADD(NOW(), INTERVAL 30 minute);