-- file for database updates.  This will be included in the create.sql file too

ALTER TABLE goal ADD COLUMN `progress` TEXT NOT NULL AFTER goal_email;
ALTER TABLE goal ADD COLUMN `report` TEXT NOT NULL AFTER progress;
