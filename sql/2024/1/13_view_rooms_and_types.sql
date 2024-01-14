CREATE OR REPLACE VIEW view_rooms_and_types AS
SELECT 
    r.id as room_id,
    t.id as type_id,
    r.name as name_room,
    t.name as name_type
FROM rooms AS r
INNER JOIN types t ON t.id = r.type_id