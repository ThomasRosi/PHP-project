/*Initialisation de l'admin*/
TRUNCATE TABLE users;
INSERT INTO users (lastname, firstname, email, password, level) VALUES (
'Rosi', 'Thomas', 'thomas.rosi@skynet.be', SHA1('root6'), 3);

/*Initialisation des valeurs*/
TRUNCATE TABLE tracks;
INSERT INTO tracks (title, artist, album, genre) VALUES
    ('In The End', 'Linkin Park', 'Hybrid Theory', 'Rock'),
    ('Crawling', 'Linkin Park', 'Hybrid Theory', 'Rock'),
    ('Faint', 'Linkin Park', 'Meteora', 'Rock'),
    ('From The Inside', 'Linkin Park', 'Meteora', 'Rock'),
    ('Numb', 'Linkin Park', 'Meteora', 'Rock'),
    ('Hysteria', 'Muse', 'Absolution', 'Rock'),
    ('Sing for Absolution', 'Muse', 'Absolution', 'Rock'),
    ('Time Is Running Out', 'Muse', 'Absolution', 'Rock'),
    ('Stockholm Syndrome', 'Muse', 'Absolution', 'Rock'),
    ('Hoodoo', 'Muse', 'Black Holes and Revelations', 'Rock'),
    ('Starlight', 'Muse', 'Black Holes and Revelations', 'Rock'),
    ('Knight Of Cydonia', 'Muse', 'Black Holes and Revelations', 'Rock'),
    ('Soldier\'s Poem', 'Muse', 'Black Holes and Revelations', 'Rock'),
    ('B.Y.O.B.', 'System Of A Down', 'Mezmerize', 'Metal'),
    ('Nightmare', 'Avenged Sevenfold', 'Nightmare', 'Metal'),
    ('Welcome To The Family', 'Avenged Sevenfold', 'Nightmare', 'Metal'),
    ('Buried Alive', 'Avenged Sevenfold', 'Nightmare', 'Metal'),
    ('So Far Away', 'Avenged Sevenfold', 'Nightmare', 'Metal'),
    ('Danger Line', 'Avenged Sevenfold', 'Nightmare', 'Metal'),
    ('Around The World', 'Daft Punk', 'Homework', 'Electro'),
    ('Lollipop', 'Mika', 'Life In Cartoon Motion', 'Pop'),
    ('Relax, Take It Easy', 'Mika', 'Life In Cartoon Motion', 'Pop'),
    ('Stay The Night', 'Green Day', 'Uno!', 'Punk'),
    ('Let Yourself Go', 'Green Day', 'Uno!', 'Punk'),
    ('Loss Of Control', 'Green Day', 'Uno!', 'Punk'),
    ('Oh Love', 'Green Day', 'Uno!', 'Punk'),
    ('Boulevard Of Broken Dreams', 'Green Day', 'American Idiot', 'Punk'),
    ('American Idiot', 'Green Day', 'American Idiot', 'Punk'),
    ('Parce qu\'on ne sait jamais', 'Christophe Mae', 'Mon Paradis', 'Variete'),
    ('Comme Des Enfants', 'Coeur De Pirate', 'Coeur De Pirate', 'Variete'),
    ('Pour Un Infidele', 'Coeur De Pirate', 'Coeur De Pirate', 'Variete');
