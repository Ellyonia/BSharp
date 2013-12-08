Use BSharp;

-- -----------------------------------------------------
-- Inserting Dummy Users into Database
-- -----------------------------------------------------

INSERT INTO Users VALUES ("Kryss", "Linstromberg", 1, "csulosson@gmail.com", "testpassword");
INSERT INTO Users VALUES ("Nick", "Morris", 2, "nmorris@smu.edu", "Herpderp");
INSERT INTO Users VALUES ("Scooby", "Doo", 3, "ruhroh@hotmail.com", "RAAGYROHSTS");
INSERT INTO Users VALUES ("Lara", "Croft", 4, "lcroft@gmail.eu", "archaeology");
INSERT INTO Users VALUES ("John", "Doe", 5, "anon@anon.anon", "WhoamI?");
INSERT INTO Users VALUES ("Robert", "Stewart", 6, "rcstewart@smu.edu", "H3llyeah");
INSERT INTO Users VALUES ("Ryan", "Tanner", 7, "mithranor@gmail.com", "password");
INSERT INTO Users VALUES ("Cameron", "Keith", 8, "ckeith@smu.edu", "hpcrew09");
INSERT INTO Users VALUES ("Guy", "Cockrum", 9, "gcockrum@smu.edu", "cockrum");
INSERT INTO Users VALUES ("Professor", "Fontenot", 10, "professor@fontenot.com", "12345Test");
INSERT INTO Users VALUES ("Professor", "Raley", 11, "professor@raley.com", "Test12345");


-- -----------------------------------------------------
-- Inserting Dummy Bands into Band Table
-- -----------------------------------------------------

INSERT INTO Band VALUES (1, "Bagpipes Galore", "123-456-7890", "This used to be weird, but not anymore", " ");
INSERT INTO Band VALUES (2, "Mustang Band", "456-798-5198", "NOTHING STOPS THE MUSTANG BAND", " ");


-- -----------------------------------------------------
-- Inserting Dummy Bands into Band Table
-- -----------------------------------------------------

INSERT INTO BandsIn VALUES (2, 8, "Tenor\ Sax", 2, 0);
INSERT INTO BandsIn VALUES (2, 2, "Trombone", 2, 1);
INSERT INTO BandsIn VALUES (1, 2, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 3, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 4, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 5, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 6, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 7, "Bagpipe", 1, 0);
INSERT INTO BandsIn VALUES (1, 8, "Bagpipe", 1, 1);
INSERT INTO BandsIn VALUES (1, 9, "Snare\ Drum", 1, 0);


-- -----------------------------------------------------
-- Inserting Dummy Sheet Music into the Pieces Table
-- -----------------------------------------------------

INSERT INTO Pieces VALUES (1,"Varsity(2008 Stuckey)", 2);
INSERT INTO Pieces VALUES (2,"Western Peruna", 2);
INSERT INTO Pieces VALUES (3,"National Anthem(Armed Forces Edition)", 2);
INSERT INTO Pieces VALUES (4,"Quickie Sheet(2010 Edition)", 2);
INSERT INTO Pieces VALUES (5,"Shanty Town", 2);
INSERT INTO Pieces VALUES (6, "Scotland the Brave", 1);


