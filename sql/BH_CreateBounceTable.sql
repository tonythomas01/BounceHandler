-- MySQL version of the database schema for the BounceHandler extension.
-- Licence: GNU GPL v2+
-- Author: Tony Thomas, Legoktm, Jeff Green

CREATE TABLE IF NOT EXISTS /*_*/bounce_records (
	br_id 		INT unsigned        NOT NULL PRIMARY KEY auto_increment,
	br_user		VARCHAR(255)	NOT NULL, -- Email Id of failing recieptent
	br_timestamp   	varbinary(14)   NOT NULL,
	br_reason	VARCHAR(255)	NOT NULL  -- Failure  reasons
)/*$wgDBTableOptions*/;