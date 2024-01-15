CREATE VIEW view_price_rooms AS
SELECT pr.id AS price_room_id,
       t.name AS type_name,
       r.name AS room_name,
       pr.price_high,
       pr.price_low
FROM price_rooms pr
JOIN types t ON pr.type_id = t.id
JOIN rooms r ON pr.room_id = r.id;