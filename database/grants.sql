-- 1. Give the user "user" the ability to see and create things in the schema
GRANT ALL ON SCHEMA public TO "user";

-- 2. Give the user "user" permission to read/write all existing tables
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO "user";

-- 3. Give the user "user" permission to use ID sequences (for inserts)
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO "user";

-- 4. Verify it works
SELECT * FROM test_logs;
