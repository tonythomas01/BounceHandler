-- MySQL version of the database schema for the BounceHandler extension.
-- Licence: GNU GPL v2+
-- Author: Tony Thomas, Legoktm, Jeff Green

CREATE TABLE IF NOT EXISTS /*_*/bounce_records (
	email_id		VARCHAR(255)	NOT NULL PRIMARY KEY, -- Email Id of failing recieptent
	message_timestamp   	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	failure_reason	VARCHAR(255)	NOT NULL  -- Failure  reasons
)