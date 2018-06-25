DELETE from run_drivers;
DELETE from artist_run;
DELETE from run_waypoint;
DELETE from runs;

SELECT min(planned_at) as De, max(planned_at) as A from runs;
