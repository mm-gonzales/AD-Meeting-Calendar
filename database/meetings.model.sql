CREATE TABLE IF NOT EXISTS meetings (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    scheduled_at TIMESTAMP NOT NULL,
    created_by INTEGER REFERENCES users(id) ON DELETE SET NULL
);