CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pg_trgm";

SET timezone = 'America/Bogota';

DO $$
BEGIN
    RAISE NOTICE 'Base de datos inicializada correctamente para FileManager';
END $$;