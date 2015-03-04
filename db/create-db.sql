CREATE TABLE ships
(
	ship_name varchar(64) PRIMARY KEY,
	ship_base_value INT
);

CREATE TABLE pilots
(
	pilot_name VARCHAR(32) PRIMARY KEY,
	pilot_password VARCHAR(16),
	pilot_corp VARCHAR(64),
	FOREIGN KEY(pilot_corp) REFERENCES corporations(corporation_name)
);

CREATE TABLE activities
(
	activity VARCHAR(32) PRIMARY KEY
);

CREATE TABLE corporations
(
	corporation_name VARCHAR(64) PRIMARY KEY		
);

CREATE TABLE ransoms
(
	ransom_id INT AUTO_INCREMENT PRIMARY KEY,
	ransom_amount BIGINT,
	pilot_name VARCHAR(32),
	system_name VARCHAR(16),
	ship_name VARCHAR(64),
	ransomee_activity VARCHAR(32),
	date TIMESTAMP,
	comments VARCHAR(2048),
	FOREIGN KEY(pilot_name) REFERENCES pilots(pilot_name),
	FOREIGN KEY(ship_name) REFERENCES ships(ship_name),
	FOREIGN KEY(ransomee_activity) REFERENCES activities(activity)	
);

CREATE TABLE ransoms_pilots
(
	pilot_name VARCHAR(32),
	ransom_id INT,
	FOREIGN KEY(pilot_name) REFERENCES pilots(pilot_name),
	FOREIGN KEY(ransom_id) REFERENCES ransoms(ransom_id)
);