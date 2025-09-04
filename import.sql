-- Table person
CREATE TABLE person (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    alamat VARCHAR(100)
);

-- Table hobi
CREATE TABLE hobi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    person_id INT,
    hobi VARCHAR(100),
    FOREIGN KEY (person_id) REFERENCES person(id) ON DELETE CASCADE
);

-- Insert data ke person
INSERT INTO person (id, nama, alamat) VALUES
(1, 'sentot', 'bandung'),
(2, 'ali', 'jakarta'),
(3, 'mahmud', 'bali'),
(4, 'shena', 'USA');

-- Insert data ke hobi
INSERT INTO hobi (id, person_id, hobi) VALUES
(1, 1, 'membaca'),
(2, 1, 'menulis'),
(3, 2, 'renang'),
(4, 3, 'futsal'),
(5, 3, 'renang'),
(6, 3, 'membaca'),
(7, 4, 'renang');
