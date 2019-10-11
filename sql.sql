CREATE OR REPLACE FUNCTION deleteTables() 
  RETURNS trigger
AS $$
DECLARE
   t_curs cursor for 
      SELECT * FROM "users" WHERE "last_accessed" < NOW() - INTERVAL '1 day';
BEGIN
    FOR t_row in t_curs LOOP
        EXECUTE 'DROP TABLE IF EXISTS "' || t_row."cookie_name" || '"';
    END LOOP; 
    DELETE FROM "users" WHERE "last_accessed" < NOW() - INTERVAL '1 day';
    RETURN NULL;
END;
$$ 
LANGUAGE plpgsql;


CREATE TRIGGER trigger_delete_old_rows_tables
    AFTER INSERT ON "users"
    EXECUTE PROCEDURE deletetables();